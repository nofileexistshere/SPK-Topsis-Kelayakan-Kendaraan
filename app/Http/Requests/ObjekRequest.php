<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObjekRequest extends FormRequest
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
            'nama'           => 'required|string|max:255',
            'kendaraan'      => 'required|string|max:255',
            'nomor_polisi'   => 'required|string|max:20|regex:/^[A-Z]{1,2}\s?[0-9]{1,4}\s?[A-Z]{1,3}$/',
            'nama_kendaraan' => 'required|string|max:255',
        ];
    }
}
