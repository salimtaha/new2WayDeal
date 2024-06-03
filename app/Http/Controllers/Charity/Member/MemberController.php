<?php

namespace App\Http\Controllers\Charity\Member;

use App\Models\Charity;
use Illuminate\Http\Request;
use App\Models\CharityMember;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Utils\ImageUpload;

class MemberController extends Controller
{
    public function index()
    {
        return view('charity.members.index');
    }

    public function getAll()
    {
        $authCharity = Auth::guard('charity')->user()->id;
        $charities = CharityMember::with(['governorate', 'city'])->where('charity_id' , $authCharity)->select('*')->latest();

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
                    <a class="dropdown-item" href="'.Route('charities.members.edit' , $row->id).'"><i
                            class="bx bx-edit-alt me-1"></i> تعديل</a>
                    <a class="dropdown-item" href="'.Route('charities.members.delete' , $row->id).'"><i
                            class="bx bx-trash me-1"></i> حذف</a>
                </div>
            </div>';
           })

           ->rawColumns(['action'  , 'governorate' , 'city','standard'])


            ->Make(true);
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(),[
            'name'=>'required|string|min:3|max:50',
            'email'=>'required|unique:charity_members,email',
            'address'=>'required|string|max:70',
            'governorate_id'=>'required|exists:governorates,id',
            'city_id'=>'required|exists:cities,id',
            // 'living_standard'=>'requred|in:low,medium',
            'image'=>'nullable',
        ]);

        if($validated->fails()){
            session()->flash('failed' , 'فشل عمليه اضافه العضو انقر لرؤيه الخطا 🤷‍♂️ ');
            return redirect()->back()->withErrors($validated);
        }


        $request['charity_id'] =  $request->user('charity')->id;

        $charity_member = CharityMember::create($request->except(['image']));

        if($request->hasFile('image')){
            $charity_member->update([
                'image'=>ImageUpload::uploadImage($request->image , 'charities/members'),
            ]);
        }

        session()->flash('success' , 'تم اضافه العضو بنجاح');
        return redirect()->back();

    }

    public function edit($id)
    {
        $member = CharityMember::findOrFail($id);
        return view('charity.members.edit' , compact('member'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|string|min:3',
            'email'=>'required|email|unique:charity_members,email,'.$request->id,
            'address'=>'required|string|max:100',
            'phone'=>'required|numeric',
            'governorate_id'=>'exists:governorates,id',
            'city_id'=>'exists:cities,id',
            'living_standard'=>'in:low,medium',
        ]);
        $member = CharityMember::findOrFail($request->id);

        if($request->governorate_id == null){
            $request['governorate_id'] = $member->governorate_id;
            $request['city_id'] = $member->city_id;
        }

        $member->update($request->all());

        session()->flash('success' , 'تم تحديث بيانات العضو بنجاح');
        return redirect()->route('charities.members.index');
    }

    public function delete($id)
    {

        $charity_member = CharityMember::findOrFail($id);
        $charity_member->delete();

        session()->flash('success' , 'تم حذف العضو بنجاح');

        return redirect()->route('charities.members.index');
    }
}
