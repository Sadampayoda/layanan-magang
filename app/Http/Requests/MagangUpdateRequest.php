<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MagangUpdateRequest extends FormRequest
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
            'name' => 'string',
            'user_id' => 'numeric',
            'jenis_magang' => 'in:Magang,PKL,Prakerin',
            'description' => 'min:10',
            'rentang_waktu_mulai' => 'date|after_or_equal:today',
            'rentang_waktu_selesai' => 'date|after_or_equal:rentang_waktu_mulai',
        ];
    }
}
