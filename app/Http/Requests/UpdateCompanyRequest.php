<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_name' => 'required|string|max:255',
            'legal_representative_name' => 'nullable|string|max:255',
            'legal_representative_lastname' => 'nullable|string|max:255',
            'legal_representative_dni' => 'nullable|string|max:100',
            'nit' => 'nullable|string|max:100',
            'legal_representative_email' => 'nullable|email|max:255',
            'users_iduser' => 'nullable|integer|exists:users,iduser',
        ];
    }
}
