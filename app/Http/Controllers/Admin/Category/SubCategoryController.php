<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SubCategoryController extends Controller
{
    public function index()
    {
        $mainCategories = Category::where('parent_id', null)->get();
        return view('admin.pages.categories.subindex' , compact('mainCategories'));
    }

    public function getAll()
    {
        $categories = Category::where('parent_id' , '!=' , null)->select('*')->latest();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '"class="img-thumbnail  img-fluid">';
            })
            ->addColumn('action', function ($row) {
                return $btn = '
            <a href="' . Route('admin.categories.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>

            <button type="button" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-danger mt-md-0  btn-sm mt-2" data-bs-toggle="modal"
            data-original-title="test" data-bs-target="#deletemodal"><i class="fa fa-trash"></i></button>';
            })
            ->addColumn('products_count' , function($row){
                return $row->products->count();
            })
            ->addColumn('parent', function ($row) {
                return $row->parent_id ? $row->parent->name : 'قسم رئيسي';
            })
            ->addColumn('created' , function($row){
                return $row->created_at->format('Y-m-d H:m');
            })
            ->filterColumn('parent', function($query, $keyword) {
                $query->whereHas('parent', function($q) use($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })

            ->rawColumns(['image', 'parent' ,'created', 'action' , 'products_count'])

            ->Make(true);
    }
}
