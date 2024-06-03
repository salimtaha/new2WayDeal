<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index()
    {
        return view('admin.pages.products.index');
    }

    public function getAll(Request $request)
    {
        $query = Product::with('store')->latest();

        if ($request->has('date') && !empty($request->date)) {
            $date = $request->date;
            $query->whereDate('created_at', $date);
        }

        $products = $query->get();

        return DataTables::of($products)
            ->addIndexColumn()
            ->addColumn('store_name', function($row) {
                return '<a style="text-decoration: none; color: black;" href="'.route('admin.stores.show', $row->store->id).'">'.$row->store->name.' <i class="fa fa-eye"></i></a>';
            })
            ->addColumn('created', function($row) {
                return $row->created_at->format('Y-m-d h:m');
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                       العمليات
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="' . route('admin.products.show', $row->id) . '">العرض <i class="fa fa-eye"></i></a>
                        <div class="dropdown-divider"></div>
                        <a id="deleteBtn" data-id="' . $row->id . '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletemodal">الحذف <i class="fa fa-trash"></i></a>
                    </div>
                  </div>';
            })
            ->rawColumns(['action', 'store_name', 'created'])
            ->make(true);
    }




    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $product = Product::withTrashed()->with('store')->findOrFail($id);
        return view('admin.pages.products.show' , compact('product'));

    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        try{
            $product = Product::find($request->id);
            $product->delete();
            session()->flash('success' , 'تم حذف المنتج بنجاح');
            return redirect()->route('admin.products.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }
}
