<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'=>'min:5',
            'price'=>'integer|min:10|max:1000',
            'stock'=>'integer|max:1000',
            'discount'=>'max:1000|integer',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'name.min'=>'نام وارد شده کوتاه است حداقل باید 5 کارکتر باشد',
            'name.unique'=>'نام این محصول قبلا ثبت گردیده است',

            'price.integer'=>'قیمت را فقط عددی وارد نمایید',
            'price.min'=>'قیمت وارد شده بسیار کوتاه است قیمت باید حداقل 10 باشد',
            'price.max'=>'قیمت وارد شده بسیار طولانی و بزرگ است حداکثر 10000  باشد',

            'stock.integer'=>'تعداد باید فقط عددی وارد شود',
            'stock.max'=>'تعداد محصول بسیار زیاد است حداکثر 1000  باشد',

            'discount.max'=>'تخفیف وارد شده بسیار زیاد است حداکثر 100 درصد باشد',
            'discount.integer'=>'تخفیف را فقط عددی وارد نمایید'
        ];
    }
}
