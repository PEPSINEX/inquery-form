<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // validationに使用

class StoreInquiry extends FormRequest
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
        $phone_regexp = '/\A(((0(\d{1}[-(]?\d{4}|\d{2}[-(]?\d{3}|\d{3}[-(]?\d{2}|\d{4}[-(]?\d{1}|[5789]0[-(]?\d{4})[-)]?)|\d{1,4}\-?)\d{4}|0120[-(]?\d{3}[-)]?\d{3})\z/';
        return [
            'inquiries.name'          => ['required', 'max:16'],
            'inquiries.email'         => ['required', 'max:200', 'email'],
            'inquiries.phone_number'  => ['required', 'max:13', "regex:$phone_regexp"],
            'inquiries.product_type'  => ['required', 'max:4', Rule::in(config('const.PRODUCT_A'))],
            'inquiries.content'       => ['required', 'max:2000'],
        ];
    }

    /**
     * バリデーションエラーのカスタム属性の取得
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'inquiries.name'          => trans('db.inquiry.name'),
            'inquiries.email'         => trans('db.inquiry.email'),
            'inquiries.phone_number'  => trans('db.inquiry.phone_number'),
            'inquiries.product_type'  => trans('db.inquiry.product_type'),
            'inquiries.content'       => trans('db.inquiry.content'),
        ];
    }
}
