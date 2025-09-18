<?php

namespace App\Http\Requests\System;

use Illuminate\Foundation\Http\FormRequest;

use App\Models\User;

class UsersRequest extends FormRequest
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

    $tableNames = config('permission.table_names');
    
    if ($this->isMethod('post'))
    {
      return [
        'name' => 'required|string|max:255',
        'email' => "required|email:filter|unique:$table_name",
        'nomor_hp' => "required|numeric|unique:$table_name",
        'nomor_hp2' => "nullable|numeric|unique:$table_name",
        'username' => "required|string|unique:$table_name",
        'password' => [
          'required',        
          'min:8',        
          'regex:/^(?=.*[A-Z])(?=.*\d|\W).+$/'
        ],
        'password_confirmation' => 'required|same:password',
        'default_role' => 'required|string|exists:'.$tableNames['roles'].',name',
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
      ];
    }
    else if ($this->isMethod('put'))
    {
      $user_id = $this->route('id');
      
      return [
        'username' => [
          'required',
          "unique:$table_name,username," . $user_id
        ],           
        'name' => 'required|string|max:255',
        'email' => "required|string|email:filter|unique:$table_name,email," . $user_id,
        'nomor_hp' => "required|numeric|unique:$table_name,nomor_hp," . $user_id,  
        'nomor_hp2' => "nullable|numeric|unique:$table_name,nomor_hp," . $user_id,
        'password' => [
          'nullable',        
          'min:8',        
          'regex:/^(?=.*[A-Z])(?=.*\d|\W).+$/'
        ],
        'password_confirmation' => 'nullable|same:password',
        'default_role' => "required|string|exists:{$tableNames['roles']},name",     
        'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
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
      'nomor_hp.required' => 'Nomor HP pengguna harus diisi.',
      'nomor_hp.numeric' => 'Nomor HP pengguna harus berupa angka.',
      'nomor_hp.unique' => 'Nomor HP sudah terdaftar.',
      'nomor_hp2.numeric' => 'Nomor HP pengguna harus berupa angka.',
      'nomor_hp2.unique' => 'Nomor HP sudah terdaftar.',
      'username.required' => 'Username pengguna harus diisi.',
      'username.unique' => 'Username sudah terdaftar.',
      'password.required' => 'Password pengguna harus diisi.',
      'password.min' => 'Password pengguna harus lebih dari 8 karakter.',
      'password.regex' => 'Password pengguna harus mengandung huruf besar dan angka atau karakter khusus.',
      'password_confirmation.required' => 'Konfirmasi password pengguna harus diisi.',
      'password_confirmation.same' => 'Konfirmasi password pengguna tidak sama dengan password pengguna.',
      'default_role.required' => 'Role pengguna harus diisi.',
      'default_role.exists' => 'Role pengguna tidak valid.',
      'avatar.image' => 'File avatar harus berupa gambar.',
      'avatar.mimes' => 'File avatar harus berupa gambar dengan format jpeg, png, jpg.',
      'avatar.max' => 'File avatar harus memiliki ukuran maksimal 2MB.',
    ];
  }

  public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
  {
    \Alert::error('Gagal', 'Data user tidak berhasil diproses. Silahkan cek kembali data yang diisi.')->persistent();
    session()->flash('swal', false);
    return parent::failedValidation($validator);
  }
}
