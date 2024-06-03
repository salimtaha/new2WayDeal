<?php

namespace App\Http\Controllers\Admin\Mediator;

use App\Models\Mediator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Utils\ImageUpload;
use App\Http\Requests\Mediator\StoreMediatorRequest;

class MediatorController extends Controller
{

    public function index()
    {
        // $mediators = Mediator::select('*')->paginate(5);
        return view('admin.pages.mediators.index');
    }

    public function getAll()
    {
        $mediators = Mediator::select('*')->latest();

        return DataTables::of($mediators)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   العمليات
                </button>
                <div class="dropdown-menu ">
                <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item"   data-bs-toggle="modal"
                data-original-title="test" data-bs-target="#deletemodal">  الحذف  <i class="fa fa-trash"></i></a>
                  <a class="dropdown-item "  href="' . Route('admin.mediators.withdrawals', $row->id) . '">سحوبات المسئول   <i class="fa fa-eye"></i></a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item"  href="' . Route('admin.mediators.edit', $row->id) . '">تعديل البيانات    <i class="fa fa-edit"></i></a>
                </div>
              </div>';
            })
            ->addColumn('num_withdrawals', function ($row) {
                return $row->withdrawals->count();
            })
            ->addColumn('created', function ($row) {
                return $row->created_at->format('Y-m-d');
            })

            ->rawColumns(['num_withdrawals','created' , 'action'])
            ->Make(true);


    }


    public function create()
    {
        return view('admin.pages.mediators.create');
    }


    public function store(StoreMediatorRequest $request)
    {
        $request->validated();
        $request['password'] = bcrypt($request->password);
        $user = Mediator::create($request->except(['image', 'password_confirmation']));
        if ($request->hasFile('image')) {
            $user->update([
                'image' => ImageUpload::uploadImage($request->image, 'mediators'),
            ]);
        }
        session()->flash('success' , 'تم اضافه مسئول مالي جديد');
        return redirect()->route('admin.mediators.index');
    }


    public function showWithdrawals(Request $request , $id)
    {
        $mediator = Mediator::findOrFail($id);
        $withdrawals = $mediator->withdrawals()->when($request->search , function($query) use($request){
            $query->whereRelation('store' , 'name' , 'LIKE' , '%'. $request->search.'%');
            $query->orWhereRelation('method' , 'name' , 'LIKE' , '%'. $request->search.'%');
        })->where('mediator_id' , $id)->latest()->paginate(2);

        return view('admin.pages.mediators.withdrawals.index' , compact('withdrawals'));
    }

    public function edit($id)
    {
        $mediator = Mediator::findOrFail($id);
        return view('admin.pages.mediators.edit' , compact('mediator'));
    }


    public function update(StoreMediatorRequest $request, $id)
    {
        $request->validated();
        $mediator = Mediator::findOrFail($id);
        $request['password'] = bcrypt($request->password);
        $mediator->update($request->except(['image', 'password_confirmation']));
        if ($request->hasFile('image')) {
            $mediator->update([
                'image' => ImageUpload::uploadImage($request->image, 'mediators' , $mediator->image),
            ]);
        }
        session()->flash('success' , 'تم تحديث بيانات المسئول المالي ');
        return redirect()->route('admin.mediators.index');
    }

    public function destroy(Request $request)
    {
        try {
            $mediator = Mediator::findOrFail($request->id);
            $mediator->delete();

            session()->flash('success', 'تم حذف مسئول السحب بنجاح');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



}
