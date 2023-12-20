<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with(['prices', 'category', 'quantityUnit', 'provider', 'brand'])
                            ->paginate(5);
        return ProductResource::collection($products);
    }


    public function show($id){
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        return ProductResource::make($product);
    }
    

    public function store(Request $request){
        $request->validate([
            'cod' => 'required|string|max:50|unique:porducts',
            'description' => 'required|string|max:255',
            'quantity' => 'required|numeric',
        ]);

        $product = Product::create($request->all());
        return ProductResource::make($product);
    }


    public function update(Request $request, Product $product){
        $request->validate([
            'cod' => 'required|string|max:50|unique:porducts',
            'description' => 'required|string|max:255',
            'quantity' => 'required|numeric',
        ]);

        $product->update($request->all());
        return ProductResource::make($product);
    }


    public function destroy($id){
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found!'], 404);
        }

        $product->delete();
        return response()->json(['message' => 'Product deleted!'], 200);
    }


}
