<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dteJson' => 'required',
            'id_sistema' => 'required|uuid',
        ];
    }


    // public function messages(): array
    // {
    //     return [
    //         'description.required' => 'La descripción es necesaria',
    //         'quantity.required' => 'El campo cantidad es necesario',
    //         'cash_accounts_id.required' => 'El campo cuenta es necesario',
    //     ];
    // }

}
