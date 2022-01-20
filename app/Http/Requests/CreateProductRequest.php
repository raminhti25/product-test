<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'provider_id' => 'required|integer|exists:providers,id',
            'vote_enabled' => 'boolean',
            'comment_enabled' => 'boolean',
            'edit_by_visitor_enabled' => 'boolean',
        ];
    }
}
