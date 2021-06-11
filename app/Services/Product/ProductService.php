<?php

namespace App\Services\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\Auth;

class ProductService {

    private $model;
    private $user;

    public function __construct(Product $product)
    {
        $this->model = $product;
        $this->user = Auth::user();
    }

    public function store($request)
    {
        $data = $request->only([
            'name',
            'price',
            'quantity',
        ]);

        return $this->user->products()->create($data);
    }

    public function update($product, $request)
    {
        $data = $request->only([
            'name',
            'price',
            'quantity',
        ]);

        $product->fill($data);
        $product->save();
        return $product;
    }

    public function search($request)
    {
        $data = $request->only([
            'name',
        ]);
        return $this->user->products()->where('name', 'like', '%'.$data['name'].'%')->get();
    }

}
