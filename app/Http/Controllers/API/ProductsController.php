<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
        {
            $query = Product::query();

            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }

            if ($request->filled('category_id')) {
                $query->where('category_id', $request->category_id);
            }

            if ($request->filled('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }

            if ($request->filled('max_price')) {
                $query->where('price', '<=', $request->max_price);
            }

            if ($request->filled('sort_order') &&
                $request->filled('sort_by') &&
                in_array($request->sort_by, ['price', 'created_at']) &&
                in_array($request->sort_order, ['asc', 'desc'])
                ) {
                $query->orderBy($request->sort_by, $request->sort_order);
            }else{
                $query->orderBy('created_at', 'desc');
            }

            $products = $query->paginate(20);

            return SendResponse(200, 'Products from ' . $products->firstItem() . ' to ' . $products->lastItem() . ' fetched successfully',
            [
                'products_count' => $products->total(),
                'products' => ProductsResource::collection($products),
                'pagination' =>[
                    'next_page_url' => $products->nextPageUrl(),
                    'prev_page_url' => $products->previousPageUrl(),
                    'last_page_url' => $products->url($products->lastPage()),
                    'first_page_url' => $products->url(1),
                    'per_page' => $products->perPage(),
                    'current_page' => $products->currentPage(),
                    'last_page' => $products->lastPage(),
                    'from' => $products->firstItem(),
                    'to' => $products->lastItem()
                ]
            ]);
        }

    public function show($product)
    {
        $product = Product::find($product);

        if(!$product)
        {
            return SendResponse(404, 'Product not found');
        }

        $similar_products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return SendResponse(200, 'Product fetched successfully',
        [
            'product' => new ProductsResource($product),
            'similar_products' => ProductsResource::collection($similar_products)
        ]);
    }

    public function sellerProducts($seller)
    {
        $products = Product::where('store_id', $seller)->paginate(20);

        return SendResponse(200, 'Products from ' . $products->firstItem() . ' to ' . $products->lastItem() . ' fetched successfully',
        [
            'products_count' => $products->total(),
            'products' => ProductsResource::collection($products),
            'pagination' =>[
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
                'last_page_url' => $products->url($products->lastPage()),
                'first_page_url' => $products->url(1),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'from' => $products->firstItem(),
                'to' => $products->lastItem()
            ]
        ]);
    }

}
