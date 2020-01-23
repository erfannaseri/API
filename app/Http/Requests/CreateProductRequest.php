<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name'=>'required|min:5|unique:products',
            'detail'=>'required',
            'price'=>'required|integer|min:10|max:1000',
            'stock'=>'required|integer|max:1000',
            'discount'=>'required|max:1000|integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'لطفا نام محصول را وارد نمایید',
            'name.min'=>'نام وارد شده کوتاه است حداقل باید 5 کارکتر باشد',
            'name.unique'=>'نام این محصول قبلا ثبت گردیده است',
            'detail.required'=>'توضیحات درباره محصول الزامی است',
            'price.required'=>'قیمت را ذکر نکرده اید',
            'price.integer'=>'قیمت را فقط عددی وارد نمایید',
            'price.min'=>'قیمت وارد شده بسیار کوتاه است قیمت باید حداقل 10 باشد',
            'price.max'=>'قیمت وارد شده بسیار طولانی و بزرگ است حداکثر 10000  باشد',
            'stock.required'=>'تعداد محصول را وارد نمایید',
            'stock.integer'=>'تعداد باید فقط عددی وارد شود',
            'stock.max'=>'تعداد محصول بسیار زیاد است حداکثر 1000  باشد',
            'discount.required'=>'تخفیف را وارد نمایید',
            'discount.max'=>'تخفیف وارد شده بسیار زیاد است حداکثر 100 درصد باشد',
            'discount.integer'=>'تخفیف را فقط عددی وارد نمایید'
        ];
    }


}
