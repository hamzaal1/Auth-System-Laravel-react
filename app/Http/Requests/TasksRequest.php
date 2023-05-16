<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class TasksRequest extends FormRequest
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
            'name'=> ['required','string','max:255','unique:tasks'],
            'description'=> ['required','string','max:255'],
            'done'=> ['required','boolean'],
            'user_id'=> ['required','integer']
        ];
    }
}
