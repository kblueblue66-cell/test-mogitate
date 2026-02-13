<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|integer|min:0|max:100000',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
            'seasons' => 'required|array',
            'description' => 'required|max:120'
        ];

        if($this->isMethod('post')){
            $rules['image'] = 'required|image|mimes:jpeg,png';
    } else {
            $rules['image'] = 'nullable|image|mimes:jpeg,png';
    }

    return $rules;
        
    }

    public function messages(): array
    {
        return[
            //商品名
            'name.required' => '商品名を入力してください',

            //価格
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.max' => '0から10000円以内で入力してください',

            //季節
            'seasons.required' => '季節を選択してください',

            //商品説明
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',

            //画像
            'image.required' => '商品画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください'
        ];
    }
}
