<?php

namespace Project\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required|max:191|unique:projects,name,' . $this->input('id') . ',id',
            'slug' => 'required|max:191|unique:projects,slug,' . $this->input('id') . ',id',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tiêu đề',
        ];
    }
}
