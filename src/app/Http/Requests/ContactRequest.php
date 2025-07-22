<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'gender' => ['required'],
            'email' => ['required', 'email', 'max:255'],
            'first_tel' => ['required', 'digits_between:1,5', 'regex:/^[0-9]+$/'],
            'middle_tel' => ['required', 'digits_between:1,5', 'regex:/^[0-9]+$/'],
            'last_tel' => ['required', 'digits_between:1,5', 'regex:/^[0-9]+$/'],
            'address' => ['required', 'string', 'max:255'],
            'content' => ['required'],
            'detail' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'last_name.string' => '姓は文字列で入力してください',
            'last_name.max' => '姓は255文字以内で入力してください',
            'first_name.required' => '名を入力してください',
            'first_name.string' => '名は文字列で入力してください',
            'first_name.max' => '名は255文字以内で入力してください',
            'gender.required' => '性別を選択してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'email.max' => 'メールアドレスは255文字以内で入力してください',
            'first_tel.required' => '電話番号を入力してください',
            'first_tel.digits_between' => '電話番号は5桁までの数字で入力してください',
            'first_tel.regex' => '電話番号は半角数字で入力してください',
            'middle_tel.required' => '電話番号を入力してください',
            'middle_tel.digits_between' => '電話番号は5桁までの数字で入力してください',
            'middle_tel.regex' => '電話番号は半角数字で入力してください',
            'last_tel.required' => '電話番号を入力してください',
            'last_tel.digits_between' => '電話番号は5桁までの数字で入力してください',
            'last_tel.regex' => '電話番号は半角数字で入力してください',
            'address.required' => '住所を入力してください',
            'content.required' => 'お問い合わせの種類を選択してください',
            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.string' => 'お問い合わせ内容は文字列で入力してください',
            'detail.max' => 'お問合せ内容は120文字以内で入力してください',
        ];
    }
}
