<?php

namespace Project\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
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
            'name' => 'required|max:191|unique:expenses,name,' . $this->input('id') . ',id',
            'slug' => 'required|max:191|unique:expenses,slug,' . $this->input('id') . ',id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tiêu đề',
        ];
    }
}
