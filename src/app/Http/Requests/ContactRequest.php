<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // お名前（姓・名で分ける）
            'last_name'  => ['required', 'string', 'max:8'],
            'first_name' => ['required', 'string', 'max:8'],

            // 性別（1/2/3）
            'gender'     => ['required'],

            // メール
            'email'      => ['required', 'email'],

            // 電話番号（3分割・各5桁まで）
            'tel1'       => ['required', 'regex:/^\d+$/', 'max:5'],
            'tel2'       => ['required', 'regex:/^\d+$/', 'max:5'],
            'tel3'       => ['required', 'regex:/^\d+$/', 'max:5'],

            // 住所
            'address'    => ['required'],

            // 建物名（任意）
            'building'   => ['nullable'],

            // お問い合わせの種類（categories由来）
            // 仕様書のtypoに合わせて categry_id
            'catgry_id' => ['required'],

            // 内容
            'detail'     => ['required', 'max:120'],
        ];
    }

    public function messages(): array
    {
        // 「以上の文言は必ず守ってください。評価項目」なので、ここは固定文言。
        return [
            // お名前
            'last_name.required'  => '姓を入力してください',
            'first_name.required' => '名を入力してください',

            // 性別
            'gender.required'     => '性別を選択してください',

            // メール
            'email.required'      => 'メールアドレスを入力してください',
            'email.email'         => 'メールアドレスはメール形式で入力してください',

            // 電話番号（未入力）
            'tel1.required'       => '電話番号を入力してください',
            'tel2.required'       => '電話番号を入力してください',
            'tel3.required'       => '電話番号を入力してください',

            // 電話番号（全角など＝数字以外）
            'tel1.regex'          => '電話番号は 半角英数字で入力してください',
            'tel2.regex'          => '電話番号は 半角英数字で入力してください',
            'tel3.regex'          => '電話番号は 半角英数字で入力してください',

            // 電話番号（5桁超え）
            'tel1.max'            => '電話番号は 5桁まで数字で入力してください',
            'tel2.max'            => '電話番号は 5桁まで数字で入力してください',
            'tel3.max'            => '電話番号は 5桁まで数字で入力してください',

            // 住所
            'address.required'    => '住所を入力してください',

            // お問い合わせの種類
            'catgry_id.required' => 'お問い合わせの種類を選択してください',

            // お問い合わせ内容
            'detail.required'     => 'お問い合わせ内容を入力してください',
            'detail.max'          => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
