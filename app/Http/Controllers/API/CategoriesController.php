<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return SendResponse(200, 'Categories fetched successfully', CategoriesResource::collection($categories));
    }

    public function show(Category $category)
    {
        
        return SendResponse(200, 'Category fetched successfully', new CategoriesResource($category));
    }
}
