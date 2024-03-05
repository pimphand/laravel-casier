<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use function PHPSTORM_META\map;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::with('category', 'skus')->isStore()->whereLike(['name'], $request->search)->paginate(10);

        $products->getCollection()->transform(function ($product) {
            $product->minPrice = $product->skus->min('price');
            $product->maxPrice = $product->skus->max('price');
            return $product;
        });

        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'description' => 'required|string',

            'price.*' => 'required|numeric',
            'stock.*' => 'required|numeric',
            'image' => 'nullable|mimes:jpg,jpeg,png',
            'image.*' => 'nullable|mimes:jpg,jpeg,png',
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 422);
        }

        return DB::transaction(function () use ($request) {
            $product = Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
            ]);

            foreach ($request->stock as $key => $stock) {
                $product->skus()->create([
                    'price' => $request->price[$key],
                    'stock' => $stock,
                    'propreties' => $stock,
                    // 'image' => isset($request->image[$key]) ? $request->image[$key]->store('products') : null,
                    'code' => $product->id . '-' . Str::random(6) . Str::random(4),
                ]);
            }

            return new ProductResource($product);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id)->load('skus', 'category');
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json(['data' => $request->all()], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
