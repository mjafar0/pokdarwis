<?php

namespace App\Http\Controllers;

use App\Models\AiGenerate;
use Illuminate\Http\Request;
use App\Models\Pokdarwis;
use Illuminate\Support\Facades\Http;
use App\Models\Product;

use Illuminate\Validation\Rule;

class AiGenerateController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function generate(Request $req)
    {
        $data = $req->validate([
            'prompt'        => 'required|string|min:5',
            'pokdarwis_id'  => 'nullable|integer',
            'product_id'    => 'nullable|integer',
            'language'      => 'nullable|in:id,en'
        ]);

        $pokdarwisId = $data['pokdarwis_id'] ?? null;

        if (!$pokdarwisId && !empty($data['product_id'])) {
        $pokdarwisId = Product::whereKey($data['product_id'])->value('pokdarwis_id');
        }

        if (!$pokdarwisId && $req->user()) {
        // a) bila users.pokdarwis_id memang ada
        if (isset($req->user()->pokdarwis_id)) {
            $pokdarwisId = $req->user()->pokdarwis_id;
        }
        // b) atau mapping pokdarwis.user_id = users.id
        if (!$pokdarwisId) {
            $pokdarwisId = Pokdarwis::where('user_id', $req->user()->id)->value('id');
        }
    }

        if (!$pokdarwisId) {
            return response()->json([
                'ok' => false,
                'message' => 'pokdarwis_id tidak boleh kosong. Kirimkan product_id yang valid atau pokdarwis_id.'
            ], 422);
        }


        $lang   = $data['language'] ?? 'id';
        $system = $lang === 'id'
            ? 'Kamu copywriter pariwisata/UMKM. Tulis 50–120 kata, persuasif dan jujur, tanpa emoji & tanpa kontak. Satu paragraf.'
            : 'You are a tourism/SME copywriter. Write 50–120 words, persuasive and honest, no emojis or contact info. One paragraph.';

        $apiKey = config('services.openai.key', env('OPENAI_API_KEY'));
        $model  = config('services.openai.model', env('OPENAI_MODEL', 'gpt-4o'));

        try {
            $resp = Http::withToken($apiKey)
                ->timeout(40)
                // jika test di Windows/XAMPP & kena SSL, sementara bisa:
                // ->withOptions(['verify' => false])
                ->post('https://api.openai.com/v1/chat/completions', [
                    'model' => $model,
                    'messages' => [
                        ['role' => 'system', 'content' => $system],
                        ['role' => 'user',   'content' => $data['prompt']],
                    ],
                    'temperature' => 0.7,
                    'max_tokens'  => 300,
                ]);

            if (!$resp->ok()) {
                return response()->json([
                    'ok' => false,
                    'message' => $resp->json('error.message') ?? 'HTTP '.$resp->status(),
                ], 500);
            }

            $text = trim($resp->json('choices.0.message.content') ?? '');

            $row = AiGenerate::create([
                'prompt_text'  => $data['prompt'],
                'result_text'  => $text,
                // 'pokdarwis_id' => $data['pokdarwis_id'] ?? null,
                'pokdarwis_id' => $pokdarwisId,
                'product_id'   => $data['product_id'] ?? null,
            ]);

            return response()->json([
                'ok'       => true,
                'text'     => $text,
                'saved_id' => $row->id,
            ]);
        } catch (\Throwable $e) {
            return response()->json(['ok' => false, 'message' => $e->getMessage()], 500);
        }
    }


    // 

     public function __invoke(Request $req)
    {
        // GET: tampilkan form kosong
        if ($req->isMethod('get')) {
            return view('pokdarwis', ['result' => null, 'saved_id' => null]);
        }

        // POST: generate
        $data = $req->validate([
            'prompt'   => 'required|string|max:1000',
            'language' => 'nullable|in:id,en',
        ]);

        $maxWords = 50;
        $minWords = 10;
        // $maxTokens = (int) ceil($maxWords * 1.6);

        $lang   = $data['language'] ?? 'id';
        $system = $lang === 'id'
            ? "Kamu copywriter pariwisata/UMKM. TULIS MAKSIMUM {$maxWords} kata (ideal {$minWords}–{$maxWords}). Teks persuasif namun jujur, tanpa emoji dan tanpa info kontak. Gunakan 1 paragraf."
            : "You are a tourism/SME copywriter. WRITE AT MOST {$maxWords} words (ideal {$minWords}-{$maxWords}). Persuasive but honest, no emojis, no contact info. Use one paragraph.";

        $payload = [
            'model' => config('services.openai.model', 'gpt-3.5-turbo-0125'),
            'messages' => [
                ['role' => 'system', 'content' => $system],
                ['role' => 'user',   'content' => $data['prompt']],
            ],
            'temperature' => 0.8,
            // 'max_tokens' => $maxTokens
        ];

        $resp = Http::withToken(config('services.openai.key'))
            ->timeout(30)
            ->post('https://api.openai.com/v1/chat/completions', $payload);

        if ($resp->failed()) {
            $err = $resp->json();
            return back()->withInput()->withErrors(['prompt' => 'Gagal generate AI: '.json_encode($err)]);
        }

        $text = $resp->json('choices.0.message.content') ?? '';

        $row = AiGenerate::create([
            'prompt_text'  => $data['prompt'],
            'result_text'  => $text,
            'pokdarwis_id' => $req->user()->id,
        ]);

        return view('pokdarwis', [
            'result'   => $text,
            'saved_id' => $row->id,
        ])->with('ok', true);
    }
    
    public function page()
    {
        return view('ai.generate'); // resources/views/ai/generate.blade.php
    }

    // public function generate(Request $req)
    // {
    //     $data = $req->validate([
    //         'prompt'   => 'required|string|max:1000',
    //         'language' => 'nullable|in:id,en',
    //     ]);

    //     $lang = $data['language'] ?? 'id';
    //     $system = $lang === 'id'
    //         ? 'Kamu copywriter pariwisata. Tulis teks promosi persuasif, jujur, tanpa emoji & tanpa info kontak. Panjang ±120–180 kata.'
    //         : 'You are a tourism copywriter. Write a persuasive but honest promo text, no emojis or contact info. Length ~120–180 words.';

    //     // Panggil OpenAI (boleh ganti model via .env)
    //     $payload = [
    //         'model' => config('services.openai.model', 'gpt-3.5-turbo-0125'),
    //         'messages' => [
    //             ['role' => 'system', 'content' => $system],
    //             ['role' => 'user',   'content' => $data['prompt']],
    //         ],
    //         'temperature' => 0.8,
    //     ];

    //     $resp = Http::withToken(config('services.openai.key'))
    //         ->timeout(30)
    //         ->post('https://api.openai.com/v1/chat/completions', $payload);

    //     if ($resp->failed()) {
    //         return response()->json([
    //             'ok' => false,
    //             'message' => 'Gagal generate',
    //             'error' => $resp->json(),
    //         ], 422);
    //     }

    //     $text = $resp->json('choices.0.message.content') ?? '';

    //     // SIMPAN ke tabel ai_generate (sesuai struktur screenshot)
    //     $row = AiGenerate::create([
    //         'prompt_text'  => $data['prompt'],
    //         'result_text'  => $text,                // simpan teks promosi utuh
    //         'pokdarwis_id' => $req->user()->id,     // id user yg login
    //     ]);

    //     return response()->json([
    //         'ok'   => true,
    //         'id'   => $row->id,
    //         'text' => $text,
    //     ]);
    // }
    
    public function index(Request $req)
    {
        $items = AiGenerate::where('pokdarwis_id', $req->user()->id)
            ->latest()->paginate(15);
        return view('dashboard', compact('destinasi'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(AiGenerate $aiGenerate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AiGenerate $aiGenerate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AiGenerate $aiGenerate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AiGenerate $aiGenerate)
    {
        //
    }
}
