<?php

namespace App\Http\Controllers\Admin\Store;

use App\Models\Store;
use App\Models\StoreRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class StoreController extends Controller
{

    public function index()
    {
        return view('admin.pages.stores.index');
    }

    public function getallApproved()
    {
        $users = Store::with(['governorate', 'city'])->where('status', 'approved')->select('*');

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button type="button" class="btn btn-secondary btn-sm  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   العمليات
                </button>
                <div class="dropdown-menu ">
                <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item"   data-bs-toggle="modal"
                data-original-title="test" data-bs-target="#deletemodal">  الحذف  <i class="fa fa-trash"></i></a>
                  <a class="dropdown-item "  href="' . Route('admin.stores.show', $row->id) . '">العرض   <i class="fa fa-eye"></i></a>
                  <a class="dropdown-item "  href="'.Route('admin.stores.alerts.show', $row->id).'">اخطار المتجر<i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>


              </div>';
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . asset('default.jpg') . '" width="50px">';
            })
            ->addColumn('governorate', function ($row) {
                return $row->governorate->name;
            })
            ->addColumn('city', function ($row) {
                return $row->city->name;
            })


            ->rawColumns(['image', 'action', 'governorate', 'city'])
            ->Make(true);

    }
    public function wating()
    {
        $stores = Store::where('status' , 'pending')->get();
        return view('admin.pages.stores.wating' , compact('stores'));
    }

    public function getallPending()
    {

        $users = Store::with(['governorate', 'city'])->where('status', 'pending')->select('*');

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button type="button" class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   العمليات
                </button>
                <div class="dropdown-menu ">
                <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item"   data-bs-toggle="modal"
                data-original-title="test" data-bs-target="#deletemodal">  الحذف  <i class="fa fa-trash"></i></a>
                  <a class="dropdown-item "  href="' . Route('admin.stores.show', $row->id) . '">العرض   <i class="fa fa-eye"></i></a>

              </div>';
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . asset('default.jpg') . '" width="50px">';
            })
            ->addColumn('governorate', function ($row) {
                return $row->governorate->name;
            })
            ->addColumn('city', function ($row) {
                return $row->city->name;
            })

            ->rawColumns(['action','image', 'governorate', 'city'])
            ->Make(true);
    } // End of getall

    public function trashed(Request $request)
    {
        $stores = Store::onlyTrashed()->when($request->search , function($query) use($request){
            $query->where('name',  'LIKE' ,  '%'.$request->search.'%');
            $query->orWhereRelation('governorate',  'name' ,  'LIKE', '%'.$request->search.'%')->where('deleted_at' , '!=' , null);
            $query->orWhereRelation('city',  'name' ,  'LIKE', '%'.$request->search.'%')->where('deleted_at' , '!=' , null);

        })->paginate(5);
        return view('admin.pages.stores.trashed' , compact('stores'));
    }
    public function blocked(Request $request)
    {
        $stores = Store::where('status' , 'blocked')->when($request->search , function($query) use($request){
            $query->where('name',  'LIKE' ,  '%'.$request->search.'%');
            $query->orWhereRelation('governorate',  'name' ,  'LIKE', '%'.$request->search.'%')->where('deleted_at' , '!=' , null)->where('status' ,  'blocked');
            $query->orWhereRelation('city',  'name' ,  'LIKE', '%'.$request->search.'%')->where('deleted_at' , '!=' , null)->where('status' ,  'blocked');

        })->paginate(5);
        return view('admin.pages.stores.blocked' , compact('stores'));
    }
    public function restore($id)
    {
        try {
            $store = Store::onlyTrashed()->findOrFail($id);
            $store = $store->restore();

            session()->flash('success', 'تم استرجاح المؤسسه بنجاح ');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        $store = Store::withTrashed()->with('account' , 'rates' , 'products')->findOrFail($id);

        //Store Rate
        $store_rate = StoreRate::where('store_id' , $store->id)->select(DB::raw('AVG(value) as rate' ))->get();
        $store_rate = $store_rate[0]->rate;

        $store['rate'] = $store_rate;
        return view('admin.pages.stores.show' , compact('store'));
    }
    public function accept($id)
    {
        $store = Store::findOrFail($id);
        $store->update(['status' => 'approved']);
        session()->flash('success' , 'تم قبول المؤسسه  بعد رؤيه بيانات الاعتماد بنجاح ');
        return redirect()->back();
    }
    public function block($id)
    {
        $store = Store::withTrashed()->findOrFail($id);
        $store->update(['status' => 'blocked']);
        session()->flash('success' , 'تم حظر المؤسسه بنجاح ');
        return redirect()->back();
    }
    public function active($id)
    {
        $store = Store::withTrashed()->findOrFail($id);
        $store->update(['status' => 'approved']);
        session()->flash('success' , 'تم فك حظر المتجر بنجاح ');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        try{

            $store = Store::findOrFail($request->id);
            if($store->status == "pending"){
                $store->forceDelete();
                session()->flash('success' , 'تم حذف المتجر من قائمه الانتظار بنجاح');
                return redirect()->back();

            }else{
                $store->delete();
                session()->flash('success' , 'تم حذف المتجر بنجاح');
                return redirect()->back();
            }

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }
    public function forceDelete( $id)
    {

        try {
            $store = Store::onlyTrashed()->findOrFail($id);

            if($store->health_approval_certificate != 'default.jpg'){
                File::delete(public_path($store->health_certificate));
            }
            if($store->commercial_resturant_license != 'default.jpg'){
                File::delete(public_path($store->health_certificate));
            }
            if($store->image != 'default.jpg'){
                File::delete(public_path($store->image));
            }

            $store = $store->forceDelete();

            session()->flash('success', 'تم حذف المتجر نهائياً ');
            return redirect()->route('admin.stores.trashed');

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
