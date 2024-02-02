<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupStoreRequest extends FormRequest
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
            'group_name' => 'required',
            'group_description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'group_name.required'    => 'グループ名を入力してください',
            'group_description.required'    => 'グループ情報を入力してください',
        ];
    }
}
