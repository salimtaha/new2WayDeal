<?php

namespace App\Http\Controllers\Admin\Charity;

use App\Models\Charity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class CharityTrashedController extends Controller
{

    public function index()
    {
        return view('admin.pages.charities.trashed');
    }

    public function getallTrashed()
    {
        $users = Charity::onlyTrashed()->with(['governorate', 'city'])->select('*');

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   العمليات
                </button>
                <div class="dropdown-menu ">
                <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item"   data-bs-toggle="modal"
                data-original-title="test" data-bs-target="#deletemodal">  الحذف النهائي  <i class="fa fa-trash"></i></a>
                  <a class="dropdown-item "  href="' . Route('admin.charities.trashed.restore', $row->id) . '">استرجاع   <i class="fa fa-undo" aria-hidden="true"></i>
                  </a>

              </div>';
            })
            ->addColumn('governorate', function ($row) {
                return $row->governorate->name;
            })
            ->addColumn('city', function ($row) {
                return $row->city->name;
            })
            ->addColumn('deleted' , function($row){
                return $row->deleted_at->format('Y-m-d h:m:s');
            })

            ->rawColumns(['action', 'governorate', 'city',  'deleted'])
            ->Make(true);

    }
    public function restore($id)
    {
        try {
            $charity = Charity::onlyTrashed()->findOrFail($id);
            $charity = $charity->restore();

            session()->flash('success', 'تم استرجاح المؤسسه بنجاح ');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function forceDelete(Request $request)
    {
        try {
            $charity = Charity::onlyTrashed()->findOrFail($request->id);

            if($charity->health_certificate != 'default.jpg'){
                File::delete(public_path($charity->health_certificate));
            }
            if($charity->image != 'default.jpg'){
                File::delete(public_path($charity->image));
            }

            $charity = $charity->forceDelete();

            session()->flash('success', 'تم حذف المؤسسة نهائياً ');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
