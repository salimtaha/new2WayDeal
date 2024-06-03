<?php

namespace App\Http\Controllers\Admin\Mediator;

use App\Models\Mediator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class MediatorTrashedController extends Controller
{
    //
    public function index()
    {
        return view('admin.pages.mediators.trashed');
    }

    public function getAll()
    {
        $mediators = Mediator::onlyTrashed()->select('*')->latest();

        return DataTables::of($mediators)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<div class="btn-group">
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                   العمليات
                </button>
                <div class="dropdown-menu ">
                <a id="deleteBtn" data-id="' . $row->id . '"class="dropdown-item"   data-bs-toggle="modal"
                data-original-title="test" data-bs-target="#deletemodal">  الحذف  النهائي  <i class="fa fa-trash"></i></a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item"  href="' . Route('admin.mediators.trashed.restore', $row->id) . '">استرجاع المسئول    <i class="fa fa-undo" aria-hidden="true"></i>
                  </a>
                </div>
              </div>';
            })
            ->addColumn('image', function ($row) {
                return '<img src="' . asset($row->image) . '" width="50px" class="img-thumbnail">';
            })
            ->addColumn('created', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->addColumn('deleted', function ($row) {
                return $row->created_at->format('Y-m-d');
            })

            ->rawColumns(['image','created' , 'action' , 'deleted'])
            ->Make(true);


    }

    public function restore($id)
    {
        try {
            $mediator = Mediator::onlyTrashed()->findOrFail($id);
            $mediator = $mediator->restore();

            session()->flash('success', 'تم استرجاح مسئول السحب بنجاح ');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function forceDelete(Request $request)
    {
        try {
            $mediator = Mediator::onlyTrashed()->findOrFail($request->id);

            if($mediator->image != 'default.jpg'){
                File::delete(public_path($mediator->image));
            }

            $mediator = $mediator->forceDelete();

            session()->flash('success', 'تم حذف مسئول السحب نهائياً ');
            return redirect()->back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
