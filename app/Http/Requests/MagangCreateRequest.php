<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MagangCreateRequest extends FormRequest
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
            'title' => 'required|max:200',
            'user_id' => 'required|numeric',
            'jenis_magang' => 'required|in:Magang,PKL,Prakerin',
            'description' => 'required|min:10',
            'rentang_waktu_mulai' => 'required|date|after_or_equal:today',
            'rentang_waktu_selesai' => 'required|date|after_or_equal:rentang_waktu_mulai',
            'mulai_pendaftaran' => 'required|date|before_or_equal:rentang_waktu_mulai',
            'tutup_pendaftaran' => 'required|date|before_or_equal:rentang_waktu_mulai|after_or_equal:mulai_pendaftaran',
            'image' => 'required|file|mimes:png,jpg,jpeg'
        ];

    }
}
