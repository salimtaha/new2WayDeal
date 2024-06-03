<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BlockUserController extends Controller
{
    public function index()
    {
        return view('admin.pages.users.blocked');
    }
    public function getall(Request $request)
    {

        $query = User::with(['governorate', 'city'])->where('status' , 'blocked')->select('*');
        if ($request->has('date') && !empty($request->date)) {
            $date = $request->date;
            $query->whereDate('created_at', $date);
        }

          $users = $query;

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   العمليات
                </button>
                <div class="dropdown-menu ">
                <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item"   data-bs-toggle="modal"
                data-original-title="test" data-bs-target="#deletemodal">  الحذف  <i class="fa fa-trash"></i></a>
                  <a class="dropdown-item "  href="'.Route('admin.users.show' , $row->id).'">العرض   <i class="fa fa-eye"></i></a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item"  href="'.Route('admin.users.blocked.retrieve' , $row->id).'">استرجاع الحساب   <i class="fa fa-undo" aria-hidden="true"></i></a>
                </div>
              </div>';
            })
            ->addColumn('image',function($row){
                return '<img src="'.asset('default.jpg').'" width="50px">';
            })
            ->addColumn('governorate', function ($row) {
                return $row->governorate->name;
            })
            ->addColumn('city', function ($row) {
                return $row->city->name;
            })

            ->rawColumns(['image','action', 'governorate', 'city'])
            ->Make(true);
    }

    public function block($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->update(['status'=>'blocked']);
            session()->flash('success' , 'تم حظر المستخدم بنجاح');
            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

    public function retrieve($id)
    {
        try{
            $user = User::findOrFail($id);
            $user->update(['status'=>'active']);
            session()->flash('success' , 'تم فك حظر المستخدم بنجاح');
            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
        }
    }

}
