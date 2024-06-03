<?php

namespace App\Http\Controllers\Admin\Event;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.pages.events.index');
    }
    public function getall()
    {
        $events = Event::orderByRaw('ABS(DATEDIFF(start, ?))', [now()->format('Y-m-d')])->select('*');

        return DataTables::of($events)

            ->addColumn('created', function ($row) {
                return $row->created_at->format('Y-m-d');
            })
            ->addColumn('remaining_time', function ($row) {
                $startDate = Carbon::parse(now()->format('Y-m-d'));
                $endDate = Carbon::parse($row->start);

                if($startDate->gt($endDate)){
                    $diff = " الحدث انتهى";
                }else{
                    $diff = $startDate->diffInDays($endDate);
                }
                return $diff;
            })

            ->addColumn('action' , function($row){
                return '<a href="'.Route('admin.events.delete',$row->id).'" class="btn btn-danger btn-sm">حذف<i class="fa fa-trash"></i></a>';
            })
            ->rawColumns([ 'action', 'created', 'remaining_time'])
            ->Make(true);

    }

    public function calendar()
    {
        return view('admin.pages.events.calendar');
    }

    public function delete( $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        session()->flash('success', 'تم حذف الحدث بنجاح');
        return redirect()->back();
    }
}
