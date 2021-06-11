<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product\Product;
use App\Services\Product\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $service;
    private $user;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
        $this->middleware('auth:api');
        $this->user = Auth::user();
    }

    public function index()
    {
        $products = ProductResource::collection($this->user->products);
        return $this->responseSuccess($products);
    }

    public function store(ProductRequest $request)
    {
        $product = new ProductResource($this->service->store($request));
        return $this->responseSuccess($product);
    }

    public function update(Product $product, ProductRequest $request)
    {
        $product = new ProductResource($this->service->update($product, $request));
        return $this->responseSuccess($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return $this->responseSuccess();
    }

    public function search(Request $request)
    {
        $products = ProductResource::collection($this->service->search($request));
        return $this->responseSuccess($products);
    }

}
