<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.pages.orders.index');
    }

    public function getall(Request $request)
    {
        $query = Order::with('user')->latest();

        if ($request->has('date') && !empty($request->date)) {
            $date = $request->date;
            $query->whereDate('created_at', $date);
        }

        $orders = $query;

        return DataTables::of($orders)
            ->addColumn('action', function ($row) {
                return '<a href="' . Route('admin.users.orders.detail', $row->id) . '"  style="color:black;" >عرض<i class="fa fa-eye"></i></a>';
            })
            ->addColumn('user_name', function ($row) {
                return $row->user->name ?? 'المستخدم محذوف';
            })
            ->addColumn('created', function ($row) {
                return $row->created_at->format('Y-m-d h:m');
            })
            // ->addColumn('order_status', function ($row) {
            //     if ($row->status == 'paid') {
            //         $x = "مدفوع";
            //     } elseif ($row->status == 'completed') {
            //         $x = "مستلم";
            //     } elseif ($row->status == 'pending') {
            //         $x = "انتظار";
            //     } elseif ($row->status == "not_recevied") {
            //         $x = "غير مستلم";
            //     } else {
            //         $x = "ملغي";
            //     }
            //     return $x;
            // })




            ->filterColumn('user_name', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action'])
            ->make(true);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
