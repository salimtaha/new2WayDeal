<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Utils\ImageUpload;

use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{

    public function index()
    {
        $mainCategories = Category::where('parent_id', null)->get();
        return view('admin.pages.categories.index' , compact('mainCategories'));
    }

    public function getAll()
    {
        $categories = Category::with('parent')->select('*')->latest();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" class="img-thumbnail  img-fluid">';
            })
            ->addColumn('action', function ($row) {
                return $btn = '
            <a href="' . Route('admin.categories.edit', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>

            <button type="button" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-danger mt-md-0  btn-sm mt-2" data-bs-toggle="modal"
            data-original-title="test" data-bs-target="#deletemodal"><i class="fa fa-trash"></i></button>';
            })
            ->addColumn('parent', function ($row) {
                return $row->parent_id ? $row->parent->name : 'قسم رئيسي';
            })
            ->addColumn('products_count' , function($row){
                return $row->products->count();
            })
            ->addColumn('created' , function($row){
                return $row->created_at->format('Y-m-d H:m');
            })

            ->rawColumns(['image','created', 'parent' , 'action' , 'products_count'])

            ->Make(true);
    }


    public function store(Request $request)
    {
        $category = Category::create($request->except('image'));
        if ($request->hasFile('image')) {
            $category->update([
                'image' => ImageUpload::uploadImage($request->file('image'), 'categories'),
            ]);
        }
        session()->flash('success' , 'تم اضافه القسم بنجاح');
        return back();
    }


    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $mainCategories = Category::where('id' , '!=' ,$id)->where('parent_id' , null)->get();
        // return $mainCategories;
        return view('admin.pages.categories.edit' , compact('category' , 'mainCategories'));
    }


    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
        ]);
        if ($request->hasFile('image')) {
            $category->update([
                'image' => ImageUpload::uploadImage($request->file('image'), 'categories', $category->image),
            ]);
        }
         session()->flash('success' , 'تم تحديث القسم بنجاح ');
        return redirect()->route('admin.categories.index');
    }

    public function delete(Request $request)
    {
        try{
            if(is_numeric($request->id)){

                $category = Category::findOrFail($request->id);

                // return ($category->childrens);
                if (count($category->childrens)>0) {
                    session()->flash('success', 'لا يمكن حذف هذا القسم يحتوي على أقسام فرعية');
                    return redirect()->back();
                }
                if($category->image != 'default.jpg'){
                    File::delete(public_path($category->image));
                }

                $category->delete();
                session()->flash('success' , 'تم حذف القسم بنجاح');
                return redirect()->route('admin.categories.index');
            }

            }catch(\Exception $e){
                return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

    public function trashed()
    {
        return view('admin.pages.categories.trashed');
    }
    public function getAllTrashed()
    {
        $categories = Category::onlyTrashed()->with('parent')->select('*')->latest();

        return DataTables::of($categories)
            ->addIndexColumn()
            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" class="img-thumbnail  img-fluid">';
            })
            ->addColumn('action', function ($row) {
                return $btn = '
            <a href="' . Route('admin.categories.restore', $row->id) . '"  class="edit btn btn-success btn-sm" ><i class="fa fa-undo" aria-hidden="true"></i></a>

            <button type="button" id="deleteBtn"  data-id="' . $row->id . '" class="btn btn-danger mt-md-0  btn-sm mt-2" data-bs-toggle="modal"
            data-original-title="test" data-bs-target="#deletemodal"><i class="fa fa-trash"></i></button>';
            })
            ->addColumn('parent', function ($row) {
                return $row->parent_id ? $row->parent->name : 'قسم رئيسي';
            })
            ->addColumn('deleted' , function($row){
                return $row->deleted_at->format('Y-m-d H:m');
            })
            ->addColumn('products_count' , function($row){
                return $row->products->count();
            })


            ->rawColumns(['image', 'parent' , 'action'])

            ->Make(true);
    }
    public function restore($id)
    {

        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();
        session()->flash('success' , 'تم استرجاع القسم بنجاح');
        return redirect()->back();

    }
    public function forceDelete(Request $request)
    {
        $category = Category::withTrashed()->findOrFail($request->id);
        $category->forceDelete();
        session()->flash('success' , 'تم حذف القسم نهائياً بنجاح');
        return redirect()->back();

    }


}
