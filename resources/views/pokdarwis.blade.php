<x-app-layout>
    <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <h2>Pokdarwis</h2>
        </h2>
  </x-slot>

  <div class="py-12">
        {{-- disini edit konten dashboard --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Welcome to Pokdarwis Dashboard") }}

                    <form action="{{ route('pokdarwis.destinasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Destinasi</label>
                        <input type="text" name="name_destinasi" required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 bg-white dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Lokasi</label>
                        <input type="text" name="lokasi" required
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 bg-white dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                        <textarea name="deskripsi" rows="3"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 bg-white dark:bg-gray-700 dark:text-gray-100"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Fasilitas</label>
                        <textarea name="fasilitas" rows="3"
                            class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 bg-white dark:bg-gray-700 dark:text-gray-100"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Gambar</label>
                        <input type="file" name="img"
                            class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                            dark:file:bg-gray-600 dark:file:text-gray-100">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Foto Tambahan</label>
                        <input type="file" name="media[]" multiple
                            class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100
                            dark:file:bg-gray-600 dark:file:text-gray-100">
                    </div>

                    {{-- ==== AI Generatif: Teks Promosi Otomatis ==== --}}
                    {{-- <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-3">AI Generatif: Teks Promosi Otomatis</h3>

                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Masukan Prompt Promosi</label>
                    <textarea id="ai_prompt" rows="3"
                        class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 bg-white dark:bg-gray-700 dark:text-gray-100"
                        placeholder="Contoh: tonjolkan suasana sunrise, spot foto instagramable, cocok untuk keluarga"></textarea>

                    <button type="button" id="btn-ai"
                        class="mt-3 inline-flex items-center bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded-lg shadow">
                        Generate
                    </button>
                    <span id="ai-status" class="ml-2 text-sm text-gray-500"></span>

                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mt-6">Teks Promosi (Editable)</label>
                    <textarea id="ai_result" rows="6"
                        class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-2 bg-white dark:bg-gray-700 dark:text-gray-100"
                        placeholder="Hasil AI akan muncul di sini, dan otomatis menimpa field Deskripsi di atas."></textarea>
                    </div> --}}

                    {{-- JS minimal, tanpa @push --}}
                    <script>
                    document.addEventListener('DOMContentLoaded', function () {
                    const btn = document.getElementById('btn-ai');
                    const status = document.getElementById('ai-status');

                    btn.addEventListener('click', async () => {
                        // ambil nilai dari form destinasi yang sudah ada
                        const name = document.querySelector('input[name="name_destinasi"]').value || '';
                        const location = document.querySelector('input[name="lokasi"]').value || '';
                        const features = document.querySelector('textarea[name="fasilitas"]').value || '';
                        const extra = document.getElementById('ai_prompt').value || '';

                        if (!name) { alert('Isi "Nama Destinasi" dulu ya.'); return; }

                        btn.disabled = true;
                        status.textContent = 'Menulis promomu...';

                        const payload = {
                        _token: '{{ csrf_token() }}',
                        type: 'wisata',          // ini khusus form destinasi
                        name: name,
                        location: location,
                        price: '',               // tidak dipakai di destinasi
                        features: features,
                        tone: 'ramah',
                        extra_prompt: extra,
                        language: 'id'
                        };

                        try {
                        const res = await fetch('{{ route('pokdarwis.destinasi.store') }}', {
                            method: 'POST',
                            headers: { 'Accept':'application/json', 'X-Requested-With':'XMLHttpRequest' },
                            body: new URLSearchParams(payload)
                        });
                        const json = await res.json();

                        if (!res.ok || !json.ok) {
                            status.textContent = 'Gagal generate';
                            console.error(json);
                        } else {
                            const d = json.data;
                            const benefits = (d.benefits || []).map(b => `• ${b}`).join('\n');

                            const finalText =
                    `# ${d.headline}

                    _${d.tagline || ''}_

                    ${d.long_description}

                    Keunggulan:
                    ${benefits}

                    ${(d.hashtags || []).join(' ')}
                    `;

                            // taruh ke textarea hasil & ke field Deskripsi utama
                            document.getElementById('ai_result').value = finalText;
                            const deskripsiField = document.querySelector('textarea[name="deskripsi"]');
                            if (deskripsiField) deskripsiField.value = finalText;

                            status.textContent = '✔ Siap! Bisa kamu edit sebelum disimpan.';
                        }
                        } catch (e) {
                        status.textContent = 'Error jaringan';
                        console.error(e);
                        } finally {
                        btn.disabled = false;
                        }
                    });
                    });
                    </script>

                    <div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Simpan
                        </button>
                    </div>
                </form>


                    {{-- Destinasi --}}
                    {{-- <form action="{{ route('pokdarwis.destinasi.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Nama Destinasi</label>
                            <input type="text" name="name_destinasi" required>

                            <label>Lokasi</label>
                            <input type="text" name="lokasi" required>

                            <label>Deskripsi</label>
                            <textarea name="deskripsi"></textarea>

                            <label>Fasilitas</label>
                            <textarea name="fasilitas"></textarea>

                            <label>Gambar</label>
                            <input type="file" name="img">

                            <label>Foto Tambahan</label>
                            <input type="file" name="media[]" multiple>

                            <button type="submit">Simpan</button>
                        </form> --}}
                    
                        {{-- Product --}}
                        {{-- <form action="{{ route('pokdarwis.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Nama Product</label>
                            <input type="text" name="name_product" required>

                            <label>Harga</label>
                            <input type="text" name="harga_product" required>

                            <label>Deskripsi</label>
                            <textarea name="deskripsi"></textarea>

                            <label>Detail Tambahan</label>
                            <textarea name="detail_tambahan"></textarea>

                            <label>Gambar</label>
                            <input type="file" name="img">

                            <button type="submit">Simpan</button>
                        </form> --}}

                        {{-- Produk Fix --}}

                        {{-- <form action="{{ route('pokdarwis.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Nama Product</label>
                            <input type="text" name="name_product" required>
                            <label>Harga</label>
                            <input type="text" name="harga_product" required>
                            <label>Deskripsi</label>
                            <textarea name="deskripsi"></textarea>
                            <label>Detail Tambahan</label>
                            <textarea name="detail_tambahan"></textarea>

                            <label>Cover Produk</label>
                            <input type="file" name="img" required>

                            <label>Foto Tambahan</label>
                            <input type="file" name="media[]" multiple>
                            <button type="submit">Simpan</button>
                        </form> --}}

                        {{-- Produk Fix --}}

                        <form action="{{ route('pokdarwis.product.store') }}" method="POST" enctype="multipart/form-data" 
                        class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nama Produk</label>
                            <input type="text" name="name_product" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 
                                    shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                    p-2 bg-white dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Harga</label>
                            <input type="text" name="harga_product" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 
                                    shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                    p-2 bg-white dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Deskripsi</label>
                            <textarea name="deskripsi" rows="3"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 
                                    shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                    p-2 bg-white dark:bg-gray-700 dark:text-gray-100"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Detail Tambahan</label>
                            <textarea name="detail_tambahan" rows="3"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 
                                    shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                    p-2 bg-white dark:bg-gray-700 dark:text-gray-100"></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Cover Produk</label>
                            <input type="file" name="img" required
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    dark:file:bg-gray-600 dark:file:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Foto Tambahan</label>
                            <input type="file" name="media[]" multiple
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    dark:file:bg-gray-600 dark:file:text-gray-100">
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold 
                                    py-2 px-4 rounded-lg shadow-md 
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan
                            </button>
                        </div>
                    </form>

                    {{-- Gallery Fix --}}

                    <form action="{{ route('pokdarwis.gallery.store') }}" method="POST" enctype="multipart/form-data"
                        class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg space-y-6">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Judul Konten</label>
                            <input type="text" name="judul_konten" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 
                                    shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                    p-2 bg-white dark:bg-gray-700 dark:text-gray-100">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipe Konten</label>
                            <select name="tipe_konten" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 
                                    shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm 
                                    p-2 bg-white dark:bg-gray-700 dark:text-gray-100">
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">File</label>
                            <input type="file" name="file" required
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-semibold
                                    file:bg-blue-50 file:text-blue-700
                                    hover:file:bg-blue-100
                                    dark:file:bg-gray-600 dark:file:text-gray-100">
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold 
                                    py-2 px-4 rounded-lg shadow-md 
                                    focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Upload
                            </button>
                        </div>
                    </form>


                        {{-- Gallery --}}
                        {{-- <form action="{{ route('pokdarwis.gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label>Judul Konten</label>
                            <input type="text" name="judul_konten" required>

                            <label>Tipe Konten</label>
                            <select name="tipe_konten" required>
                                <option value="foto">Foto</option>
                                <option value="video">Video</option>
                            </select>

                            <label>File</label>
                            <input type="file" name="file" required>

                            <button type="submit">Upload</button>
                        </form> --}}

                        {{-- AI Promosi Generate --}}
                        {{-- resources/views/ai/promo.blade.php --}}
                        {{-- resources/views/ai/promo.blade.php --}}
                        <div class="max-w-3xl mx-auto p-6">
                            <h1 class="text-2xl font-semibold mb-4">AI Promosi</h1>

                            @error('prompt')
                            <div class="mb-3 p-3 rounded bg-red-50 text-red-700 text-sm">{{ $message }}</div>
                            @enderror
                            @if(session('ok'))
                            <div class="mb-3 p-3 rounded bg-green-50 text-green-700 text-sm">
                                ✔ Teks promosi berhasil dibuat
                                @isset($saved_id) (ID #{{ $saved_id }}) @endisset
                            </div>
                            @endif

                            <form action="{{ route('ai.promo') }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium mb-1">Masukan Prompt Promosi</label>
                                <textarea name="prompt" rows="4" required
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 bg-white dark:bg-gray-700 dark:text-gray-100"
                                placeholder='Contoh: "Buatkan teks promosi untuk produk Madu Lebah Asli, sorot manfaat kesehatan & keaslian, cocok untuk keluarga."'>{{ old('prompt') }}</textarea>
                            </div>

                            <input type="hidden" name="language" value="id">

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                                Generate
                            </button>
                            </form>

                            <div class="mt-6">
                            <label class="block text-sm font-medium mb-1">Teks Promosi (Editable)</label>
                            <textarea rows="12"
                                class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm p-3 bg-white dark:bg-gray-700 dark:text-gray-100"
                                placeholder="Hasil AI akan muncul di sini.">@if(!empty($result)){{ $result }}@endif</textarea>
                            </div>
                        </div>


                        {{-- ======= AI GENERATE PROMO ======= --}}
                        {{-- <div class="mt-10 p-4 border rounded bg-white dark:bg-gray-800">
                        <h3 class="font-semibold mb-2">AI Generate Promo</h3>

                        <div class="grid md:grid-cols-2 gap-3">
                            <label class="block">
                            <span>Nama</span>
                            <input class="mt-1 w-full border rounded p-2" id="ai_name" placeholder="Nama wisata/produk">
                            </label>

                            <label class="block">
                            <span>Tipe</span>
                            <select class="mt-1 w-full border rounded p-2" id="ai_type">
                                <option value="wisata">Wisata</option>
                                <option value="produk">Produk</option>
                            </select>
                            </label>

                            <label class="block">
                            <span>Lokasi</span>
                            <input class="mt-1 w-full border rounded p-2" id="ai_location" placeholder="Batam, Kepulauan Riau">
                            </label>

                            <label class="block">
                            <span>Harga (opsional)</span>
                            <input class="mt-1 w-full border rounded p-2" id="ai_price" type="number" min="0" placeholder="0">
                            </label>
                        </div>

                        <label class="block mt-3">
                            <span>Fitur/Highlight</span>
                            <textarea class="mt-1 w-full border rounded p-2" id="ai_features" rows="3"
                            placeholder="Contoh: spot sunrise, perahu kayu, pemandu lokal, parkir luas"></textarea>
                        </label>

                        <div class="flex gap-2 mt-3">
                            <select id="ai_tone" class="border rounded p-2">
                            <option value="ramah">Ramah</option>
                            <option value="santai">Santai</option>
                            <option value="formal">Formal</option>
                            <option value="inspiratif">Inspiratif</option>
                            </select>
                            <textarea id="ai_extra" class="flex-1 border rounded p-2" rows="1"
                            placeholder="Prompt opsional, mis: tekankan spot foto instagramable"></textarea>
                            <button type="button" id="btn-ai" class="px-3 py-2 bg-indigo-600 text-white rounded">Generate</button>
                            <span id="ai-status" class="text-sm text-gray-500"></span>
                        </div>

                        <label class="block mt-3">
                            <span>Deskripsi (hasil AI, bisa diedit)</span>
                            <textarea class="mt-1 w-full border rounded p-2" id="description" rows="8"></textarea>
                        </label>

                        <input type="hidden" id="seo_title" name="seo_title">
                        <input type="hidden" id="seo_keywords" name="seo_keywords">
                        </div>

                        @push('scripts')
                        <script>
                        document.getElementById('btn-ai').addEventListener('click', async () => {
                        const status = document.getElementById('ai-status');
                        status.textContent = 'Menulis promomu...';

                        const payload = {
                            _token: '{{ csrf_token() }}',
                            type: document.getElementById('ai_type').value,
                            name: document.getElementById('ai_name').value,
                            location: document.getElementById('ai_location').value,
                            price: document.getElementById('ai_price').value,
                            features: document.getElementById('ai_features').value,
                            tone: document.getElementById('ai_tone').value,
                            extra_prompt: document.getElementById('ai_extra').value,
                            language: 'id'
                        };

                        try {
                            const res = await fetch('{{ route('pokdarwis.ai.generate.history') }}', {
                            method: 'POST',
                            headers: {'Accept':'application/json','X-Requested-With':'XMLHttpRequest'},
                            body: new URLSearchParams(payload)
                            });
                            const json = await res.json();

                            if (!res.ok || !json.ok) { status.textContent = 'Gagal generate.'; console.error(json); return; }

                            const d = json.data;
                            const benefits = (d.benefits || []).map(b => `• ${b}`).join('\n');
                            const finalDesc = `# ${d.headline}

                        _${d.tagline || ''}_

                        ${d.long_description}

                        Keunggulan:
                        ${benefits}

                        ${(d.hashtags || []).join(' ')}
                        `;
                            document.getElementById('description').value = finalDesc;
                            document.getElementById('seo_title').value = d.headline || '';
                            document.getElementById('seo_keywords').value = (d.seo_keywords || []).join(', ');
                            status.textContent = '✔ Siap! Silakan review.';
                        } catch (e) {
                            status.textContent = 'Error jaringan.';
                            console.error(e);
                        }
                        });
                        </script>
                        @endpush --}}


                </div>
            </div>
        </div>
    </div>
</x-app-layout>