<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentContent extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;  // ここでは認証処理しないよ
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'inquiries.comment'  => ['required', 'max:4000'],
        ];
    }
}
