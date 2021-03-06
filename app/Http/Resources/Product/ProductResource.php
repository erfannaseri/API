<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'کد'=>$this->id,
            'نام'=>$this->name,
            'توصیفات'=>$this->detail,
            'تعداد موجود'=>$this->stock > 0?$this->stock : 'با عرض پوزش موجودی صفر میباشد',
            'قیمت اصلی'=>$this->price,
            'تخفیف'=>$this->discount.'درصد ',
            'قیمت با تخفیف'=>round((1-$this->discount/100)*$this->price,2),
            'امتیاز محصول'=>$this->reviews->count()>0 ?
                round($this->reviews->sum('star')/$this->reviews->count('star'),1):'امتیازی داده نشده است ',
            'href'=>[
                'reviews'=>route('review.index',$this->id),
            ]
        ];
    }
}
