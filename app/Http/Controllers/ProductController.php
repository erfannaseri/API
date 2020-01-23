<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Model\product;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store','destroy','update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        //return Product::all();
        //return ProductResource::collection(Product::paginate(10));
        return ProductCollection::collection(Product::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(CreateProductRequest $request)
    {
        $validated = $request->validated();
        $product=Product::create([
            'name'=>$request->input('name'),
            'detail'=>$request->input('detail'),
            'price'=>$request->input('price'),
            'stock'=>$request->input('stock'),
            'discount'=>$request->input('discount'),
        ]);
        if ($product)
        {
            return response()->json(['data'=>$product],Response::HTTP_CREATED);
        }
        return  response()->json(['error'=>'ثبت محصول انجام نشد'],Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(product $product)
    {

        $result= new ProductResource($product);
        return response()->json($result,200);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\product  $product
     * @return array
     */
    public function update(UpdateProductRequest $request, product $product)
    {
      $result=$product->update($request->all());
        if ($result) {
            return response()->json(['نتیجه'=>'بروز رسانی محصول مورد نظر با موفقیت انجام شد','data'=>new ProductResource($product)],Response::HTTP_OK);
        }
        return response()->json(['error'=>'بروز رسانی با مشکل روبرو گردید'],Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();

        return  response()->json(['محصول مورد نظر حذف شد'],Response::HTTP_NO_CONTENT);
    }
}
