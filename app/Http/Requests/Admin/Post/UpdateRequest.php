<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|file',
            'main_image' => 'nullable|file',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'integer|exists:tags,id'
        ]; 
    }


    
    public function messages()
    {
        return [
            'title.required' => 'Это поле необходимо для заполнения',
            'title.string' => 'Данные должны быть строкового типа',
            'content.required' => 'Это поле необходимо для заполнения',
            'content.string' => 'Данные должны быть строкового типа',
            'preview_image.required' => 'Это поле необходимо для заполнения',
            'preview_image.file' => 'Данные должны быть файлом',
            'main_image.required' => 'Это поле необходимо для заполнения',
            'main_image.file' => 'Данные должны быть файлом',
            'category_id.required' => 'Это поле необходимо для заполнения',
            'category_id.integer' => 'Данные должны быть числом',
            'category_id.exists' => 'Выбранная категория не существует',
            'tag_ids.array' => 'Данные должны быть массивом',
            'tag_ids.*.integer' => 'Данные должны быть числом',
            'tag_ids.*.exists' => 'Выбранный тег не существует',
        ];
    }
}
