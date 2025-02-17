<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBiayaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|unique:biayas,nama' . $this->biaya,
            'jumlah' => 'required|numeric',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'jumlah' => str_replace('.','', $this->jumlah)
        ]);
    }
}
