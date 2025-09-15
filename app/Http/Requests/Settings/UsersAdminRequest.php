<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;

class UsersAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $table_name = User::getTableName();

        if ($this->isMethod('post'))
        {
            return [
                'name' => 'required|string|max:255',
                'email' => "required|email:filter|unique:$table_name",                                
                'password' => [
                    'required',        
                    'min:8',        
                ],                
            ];
        }
        else if ($this->isMethod('put'))
        {
            $user_id = $this->route('id');
            
            return [                
                'name' => 'required|string|max:255',
                'email' => "required|string|email:filter|unique:$table_name,email," . $user_id,                
                'password' => [
                    'nullable',        
                    'min:8',        
                ],                
            ];
        }
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama pengguna harus diisi.',
            'name.string' => 'Nama pengguna harus berupa string.',
            'name.max' => 'Nama pengguna harus memiliki maksimal 255 karakter.',
            'email.required' => 'Email pengguna harus diisi.',
            'email.email' => 'Email pengguna harus berupa email yang valid.',
            'email.unique' => 'Email sudah terdaftar.',            
            'password.required' => 'Password pengguna harus diisi.',
            'password.min' => 'Password pengguna harus lebih dari 8 karakter.',
            'password.regex' => 'Password pengguna harus mengandung huruf besar dan angka atau karakter khusus.',            
        ];
    }

    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        \Alert::error('Gagal', 'Data user tidak berhasil diproses. Silahkan cek kembali data yang diisi.')->persistent();
        session()->flash('swal', false);
        return parent::failedValidation($validator);
    }
}
