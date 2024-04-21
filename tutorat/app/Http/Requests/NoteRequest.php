<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'idMatiere' => 'required',
            'idCompte' => 'required',
            'Note' => 'required',
            //
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'idMatiere.required' => 'Le champ nom de la matière lié est requis.',
            'idCompte.required' => 'Le champ nom du compte lié est requis.',
            'Note.required' => 'Le champ de la note   est requis.',
        ];
    }
}
