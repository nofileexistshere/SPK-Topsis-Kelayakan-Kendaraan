<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KriteriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "kode" => "required|string|max:255",
            "nama" => "required|string|max:255",
            "bobot" => "required|numeric|min:0.01|max:1",
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'bobot.min' => 'The bobot must be at least :min.',
    //     ];
    // }
}
