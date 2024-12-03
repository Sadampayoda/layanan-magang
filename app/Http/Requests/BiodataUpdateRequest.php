<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BiodataUpdateRequest extends FormRequest
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
        return [
            'user_id' => 'sometimes|exists:users,id',
            'tempat_lahir' => 'sometimes|string|max:255',
            'tanggal_lahir' => 'sometimes|date',
            'jenis_kelamin' => 'sometimes|in:L,P',
            'nama_sekolah' => 'sometimes|string|max:255',
            'alamat_sekolah' => 'sometimes|string|max:255',
            'jurusan' => 'sometimes|string|max:255',
            'jenis_magang' => 'sometimes|in:PKL,Prakerin,Magang',
            'waktu_magang' => 'sometimes|string|max:255',
        ];
    }
}
