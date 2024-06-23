<?php

namespace App\Http\Controllers\API\Seller;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function index()
    {
        return SendResponse(200, 'Your products fetched successfully.', ProductsResource::collection(auth()->user()->products()->with('category')->orderBy('created_at', 'desc')->get()));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'description' => 'required|string',
            'available_for' => 'required|date',
            'expire_date' => 'required|date',
            'price' => 'required|numeric',
            'descount' => 'required|numeric',
            'quantity' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $product = auth()->user()->products()->create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'available_for' => $request->available_for,
            'expire_date' => $request->expire_date,
            'price' => $request->price,
            'descount' => $request->descount,
            'quantity' => $request->quantity,
        ]);

        foreach ($request->images as $image) {
            $product->images()->create([
                'image' => uploadImage($image,'products')
            ]);
        }

        return SendResponse(201,'Product created successfully.',new ProductsResource($product->load('category')));
    }

    public function show($product)
    {
        $product = auth()->user()->products()->find($product);

        if (!$product) {
            return SendResponse(404,'Product not found.');
        }

        return SendResponse(200,'Product fetched successfully.',new ProductsResource($product->load('category')));
    }

    public function update(Request $request, $product)
    {
        $product = auth()->user()->products()->find($product);

        if (!$product) {
            return SendResponse(404,'Product not found.');
        }

        $rules = [];
        $rules['category_id'] = 'required|exists:categories,id';
        $rules['name'] = 'required|string';
        $rules['description'] = 'required|string';
        $rules['available_for'] = 'required|date';
        $rules['expire_date'] = 'required|date';
        $rules['price'] = 'required|numeric';
        $rules['descount'] = 'required|numeric';
        $rules['quantity'] = 'required|numeric';

        if (request()->has('images')) {
            $rules['images'] = 'required|array';
            $rules['images.*'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        $request->validate($rules);


        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'available_for' => $request->available_for,
            'expire_date' => $request->expire_date,
            'price' => $request->price,
            'descount' => $request->descount,
            'quantity' => $request->quantity,
        ]);

        if ($request->has('images')) {

            $old_images = ProductImage::where('product_id',$product->id)->get();
            foreach ($old_images as $old_image) {
                File::delete(base_path('public_html/uploads/' . $old_image->image));
                $old_image->delete();
            }

            foreach ($request->images as $image) {
                $product->images()->create([
                    'image' => uploadImage($image,'products')
                ]);
            }
        }

        return SendResponse(200,'Product updated successfully.',new ProductsResource($product->load('category')));
    }

    public function destroy($product)
    {
        $product = auth()->user()->products()->find($product);

        if (!$product) {
            return SendResponse(404,'Product not found.');
        }

        foreach ($product->images as $image) {
            File::delete(base_path('public_html/uploads/' . $image->image));
            $image->delete();
        }

        $product->images()->delete();

        $product->delete();

        return SendResponse(200,'Product deleted successfully.');
    }

    public function bestSellers()
    {
        return SendResponse(200,'Best sellers fetched successfully.',ProductsResource::collection(auth()->user()->products()->withCount('orders')->orderBy('orders_count','desc')->get(4)));
    }
}
