<?php

namespace App\Http\Controllers\Admin\Profits;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ProfitController extends Controller
{
    public function index()
    {

        return view('admin.pages.profits.index');
    }
    public function indexMonthly ()
    {
        return view('admin.pages.profits.monthly');
    }
    public function getAllDaily()
    {
        $profits = $this->calculateProfits();

        return DataTables::of($profits)
            ->addIndexColumn()
            ->Make(true);
    }
    public function getAllMonthly()
    {
        $profits = $this->calculateProfitsMonthly();

        return DataTables::of($profits)
            ->addIndexColumn()
            ->Make(true);
    }


    public function calculateProfits()
    {
        $dates = Order::latest()->pluck('created_at');
        $dates = array_values(array_unique($dates->toArray()));

        $pro = [];
        $i = 0;
        foreach ($dates as $date) {
            // profits to all order
            $amount = Order::where('created_at', $date)->sum('total_price');
            $profit_day = Order::where('created_at', $date)->sum('total_price') / 10;
            $count_orders =  Order::where('created_at', $date)->count();

            // profits to paid order
            $actual_amount  = Order::where('status', 'paid')->where('created_at', $date)->sum('total_price');
            $actual_profit_day = Order::where('status', 'paid')->where('created_at', $date)->sum('total_price') / 10;
            $actual_count_orders =  Order::where('status', 'paid')->where('created_at', $date)->count();

            $data[$i] = [
                'date_day' => $date->format('Y-m-d'),
                'amount' => round($amount),
                'profit_day' => round($profit_day),
                'count_orders' => $count_orders,

                'actual_amount' => round($actual_amount),
                'actual_profit_day' => round($actual_profit_day),
                'actual_count_orders' => $actual_count_orders,
            ];
            $i++;
        }

        return $data;
    }


    public function calculateProfitsMonthly()
    {
        $dates = Order::latest()->pluck('created_at');
        $dates = array_values(array_unique($dates->toArray()));


        foreach ($dates as $date) {
            $date = $date->format('Y-m');
            $date_monthly[] = [$date];
        }
        $date_monthly = array_unique(array_reduce($date_monthly , 'array_merge' , []));

        $i = 0;
        foreach ($date_monthly as $date) {

            $amount = Order::where('created_at', 'LIKE' , $date.'%')->sum('total_price');

            $profit_monthly = Order::where('created_at', 'LIKE' , $date.'%')->sum('total_price') / 10;
            $count_orders =  Order::where('created_at', 'LIKE' , $date.'%')->count();

            // profits to paid order monthly
            $actual_amount  = Order::where('status', 'paid')->where('created_at', 'LIKE' , $date.'%')->sum('total_price');

            $actual_profit_monthly = Order::where('status', 'paid')->where('created_at', 'LIKE' , $date.'%')->sum('total_price') / 10;
            $actual_count_orders =  Order::where('status', 'paid')->where('created_at', 'LIKE' , $date.'%')->count();

            $data[$i] = [
                'date_monthly' => $date,
                'amount' => round($amount),
                'profit_monthly' => round($profit_monthly),
                'count_orders' => $count_orders,

                'actual_amount' => round($actual_amount),
                'actual_profit_monthly' => round($actual_profit_monthly),
                'actual_count_orders' => $actual_count_orders,
            ];
            $i++;
        }

        return $data;
    }
}
