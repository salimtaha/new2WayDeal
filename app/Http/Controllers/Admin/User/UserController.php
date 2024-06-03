<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Utils\ImageUpload;
use App\Http\Requests\User\StoreUserRequest;

class UserController extends Controller
{

    public function index()
    {
        return view('admin.pages.users.index');
    } //End of index

    public function getall(Request $request)
    {

        $query = User::with(['governorate', 'city'])->where('status', 'active')->select('*');


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
                  <a class="dropdown-item "  href="' . Route('admin.users.show', $row->id) . '">العرض   <i class="fa fa-eye"></i></a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item"  href="' . Route('admin.users.blocked.block', $row->id) . '">تقيد الحساب   <i class="fa fa-stop"></i></a>
                </div>
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
    } // End of getall
    public function create()
    {
        return view('admin.pages.users.create');
    } // End of create

    public function store(StoreUserRequest $request)
    {
        $request->validated();
        $request['password'] = bcrypt($request->password);
        $user = User::create($request->except(['image', 'password_confirmation']));
        if ($request->hasFile('image')) {
            $user->update([
                'image' => ImageUpload::uploadImage($request->image, 'users'),
            ]);
        }
        return redirect()->route('admin.users.index');
    } //End of store


    public function show($id)
    {
        $user = User::with('orders')->findOrFail($id);
        return view('admin.pages.users.show', compact('user'));
    } //end of show


    public function edit($id)
    {
        try {
            $user = User::findOrFail($id);
            return view('admin.pages.users.edit', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //End of Edit

    public function delete(Request $request)
    {
        try {
            $user = User::findOrFail($request->id);
            if($user->orders()->where('deleted_at' , null)->exists()){
                session()->flash('failed', 'لا يمكن حذف هذا المستخدم  لديه طلبات قم بحذفها اولا');
                return redirect()->back();
            }
            $user->delete();
            session()->flash('success', 'تم حذف المستخدم بنجاح');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //End of delete

    public function trashed()
    {
        return view('admin.pages.users.trashed');
    }
    public function getAllTrashed(Request $request)
    {

        $query = User::onlyTrashed()->with(['governorate', 'city'])->select('*');
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
                data-original-title="test" data-bs-target="#deletemodal">  الحذف نهائياً  <i class="fa fa-trash"></i></a>
                  <a class="dropdown-item "  href="' . Route('admin.users.restore', $row->id) . '">استرجاع   <i class="fa fa-repeat" aria-hidden="true"></i></a>
                </div>
              </div>';
            })
            ->addColumn('governorate', function ($row) {
                return $row->governorate->name;
            })
            ->addColumn('city', function ($row) {
                return $row->city->name;
            })
            ->addColumn('deleted', function ($row) {
                return $row->deleted_at->format('Y-m-d h:m');
            })

            ->rawColumns(['image', 'action', 'governorate', 'deleted'])
            ->Make(true);
    } // End of getall trashed
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        session()->flash('success', 'تم استعاده المستخدم بنجاح');
        return redirect()->back();
    } //End of restore

    public function forceDelete(Request $request)
    {
        try {
            $user = User::onlyTrashed()->findOrFail($request->id);
            $user->forceDelete();

            session()->flash('success', 'تم حذف المستخدم من النظام نهائياً بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    } //End of Force delete

}
