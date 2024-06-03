<?php

namespace App\Http\Controllers\Admin\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class TrashedProductController extends Controller
{

    public function index()
    {
        return view('admin.pages.products.trashed');
    }

    public function getAll(Request $request)
    {
        $query = Product::onlyTrashed()->with('store')->latest();

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
            ->addColumn('deleted', function($row) {
                return $row->deleted_at->format('Y-m-d h:m');
            })
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                       العمليات
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="' . route('admin.products.show', $row->id) . '">العرض <i class="fa fa-eye"></i></a>
                        <a class="dropdown-item" href="' . route('admin.products.trashed.restore', $row->id) . '">استرجاع <i class="fa fa-undo" aria-hidden="true"></i></a>
                        <a id="deleteBtn" data-id="' . $row->id . '" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#deletemodal">الحذف النهائي <i class="fa fa-trash"></i></a>
                    </div>
                  </div>';
            })
            ->rawColumns(['action', 'store_name', 'created' ,'deleted'])
            ->make(true);
    }
    public function restore($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        session()->flash('success' , 'تم استرجاع المنتج  بنجاح');
        return redirect()->route('admin.products.trashed.index');

    }

    public static function forceDelete(Request $request)
    {
        try{
            $product = Product::onlyTrashed()->findOrFail($request->id);

            DB::beginTransaction();

            foreach($product->images as $image){
                if(!$image->image == 'default.png'){
                    File::delete(public_path($image->image));
                    $image->delete();
                }

            }
            $product->forceDelete();
            DB::commit();

            session()->flash('success' , 'تم حذف المنتج نهائياً بنجاح');
            return redirect()->route('admin.products.trashed.index');
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }

    }

}
