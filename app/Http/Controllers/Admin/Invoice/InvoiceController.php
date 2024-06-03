<?php

namespace App\Http\Controllers\Admin\Invoice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoces.index');
    }
    public function getall(Request $request)
    {
        $query = Invoice::with('order')->whereRelation('order' , 'deleted_at' , '=' , null)->latest();



        if ($request->has('date') && !empty($request->date)) {
            $date = $request->date;
            $query->whereDate('created_at', $date);
        }

        $invoices = $query;
        return DataTables::of($invoices)
            ->addColumn('action', function ($row) {
                return '<a href="'.Route('admin.invoices.show' , $row->id).'"  style="color:black;" >عرض<i class="fa fa-eye"></i></a>';
            })
            ->addColumn('invoice_num' , function($row){
                return '1000'. $row->id;
            })

            ->addColumn('invoice_status', function ($row) {
                return $row->payment_status=="paid" ? 'مدفوعه':'غير مدفوعه';
            })

            ->addColumn('shapping_status', function ($row) {
                return $row->order->shapping == 1 ?'شحن':'استلام شخصي';
            })
            ->addColumn('customer_name', function ($row) {
                return $row->order->name;
            })
            ->addColumn('total_price', function ($row) {
                return round($row->order->total_price);
            })
            ->addColumn('customer_phone', function ($row) {
                return $row->order->phone;
            })
            ->addColumn('payment_method', function ($row) {
                return $row->order->payment_method;
            })
            ->addColumn('created', function ($row) {
                return $row->created_at->format('Y-m-d h:m');
            })

            ->filterColumn('customer_name', function($query, $keyword) {
                $query->whereHas('order', function($q) use($keyword) {
                    $q->where('name', 'like', "%{$keyword}%");
                });
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show($id)
    {
        $invoice = Invoice::with('order')->findOrFail($id);
        return view('admin.invoces.show' , compact('invoice'));
    }

}
