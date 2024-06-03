<?php

namespace App\Http\Controllers\Charity\Member;

use Illuminate\Http\Request;
use App\Models\CharityMember;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class TrashedMemberController extends Controller
{
    public function index()
    {
        return view('charity.members.trashed');
    }

    public function getAll()
    {

        $authCharity = Auth::guard('charity')->user()->id;
        $charities = CharityMember::onlyTrashed()->with(['governorate', 'city'])->where('charity_id' , $authCharity)->select('*')->latest();

        return DataTables::of($charities)

            ->addIndexColumn()
            // ->addColumn('image', function ($row) {
            //     return '<img src="' . $row->image . '" class="image" >';
            // })
            ->addColumn('standard' , function($row){
                return $row->living_standard != 'medium' ?  "منخفض":  "متوسط";
            })
            ->addColumn('governorate', function ($row) {
                return $row->governorate->name;
            })
            ->addColumn('city', function ($row) {
                return $row->city->name;
            })
            ->addColumn('action' , function($row){
                return '<div class="dropdown">
                <button title="btn" type="button" class="btn p-0 dropdown-toggle hide-arrow"
                    data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="'.Route('charities.members.trashed.restore' , $row->id).'"><i
                            class="bx bx-edit-alt me-1"></i> استرجاع</a>
                    <a class="dropdown-item" href="'.Route('charities.members.trashed.delete' , $row->id).'"><i
                            class="bx bx-trash me-1"></i> حذف نهائياً</a>
                </div>
            </div>';
           })

           ->rawColumns(['action'  , 'governorate' , 'city','standard'])


            ->Make(true);
    }


    public function delete($id)
    {

        $charity_member = CharityMember::onlyTrashed()->findOrFail($id);

        if($charity_member->image != "default.jpg"){
            File::delete(public_path($charity_member->image));
        }
        $charity_member->forceDelete();

        session()->flash('success' , 'تم حذف العضو نهائياً بنجاح');

        return redirect()->route('charities.members.trashed.index');
    }

    public function restore($id)
    {

        $charity_member = CharityMember::onlyTrashed()->findOrFail($id);
        $charity_member->restore();
        session()->flash('success' , 'تم استرجاع العضو  بنجاح');
        return redirect()->route('charities.members.trashed.index');
    }
}
