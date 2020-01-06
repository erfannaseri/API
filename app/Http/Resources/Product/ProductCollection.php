<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;
use PhpParser\Node\Stmt\Return_;

class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        Return [
            'code'=>$this->id,
            'name'=>$this->name,
            'total_price'=>$this->reviews->count()>0 ?round($this->reviews->sum('star')/$this->reviews->count('star')):'no rate yet',
            'href'=>[
                'link'=>route('products.show',$this->id),
            ]
        ];
    }
}
