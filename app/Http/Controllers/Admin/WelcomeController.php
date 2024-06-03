<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Store;
use App\Models\Charity;
use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class WelcomeController extends Controller
{
    public function index()
    {
        $counts = $this->counts();
        $chart1 = $this->userChart();
        $chart2 = $this->storeChart();
        $chart3 = $this->charityChart();
        $chart4 = $this->orderStatusChart();
        $chart5 = $this->withdrawalChart();
        $chart6 = $this->orderNumChart();


        return view('admin.pages.welcome', compact('counts' ,  'chart1', 'chart2' ,'chart3' , 'chart4' ,'chart5' , 'chart6'));
    }

    private function userChart()
    {
        $chart_options = [
            'chart_title' => 'احصائيات المستخدمين',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',

        ];
        $chart1 = new LaravelChart($chart_options);
        return $chart1;

    }
    private function storeChart()
    {
        $chart_options = [
            'chart_title' => 'احصائيات المتاجر',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Store',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];

        $chart2 = new LaravelChart($chart_options);
        return $chart2;

    }

    private function charityChart()
    {
        $chart_options = [
            'chart_title' => 'احصائيات المؤسسات',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Charity',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];

        $chart3 = new LaravelChart($chart_options);
        return $chart3;

    }

    private function orderStatusChart()
    {
        $chart_options = [
            'chart_title' => 'احصائيات حاله الطلبات',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Order',
            'group_by_field' => 'status',
            'chart_type' => 'pie',
        ];

        $chart4 = new LaravelChart($chart_options);
        return $chart4;

    }
    private function withdrawalChart()
    {
        $chart_options = [
            'chart_title' => 'احصائيات طلبات السحب',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Withdrawal',
            'group_by_field' => 'status',
            'chart_type' => 'line',
        ];

        $chart5 = new LaravelChart($chart_options);
        return $chart5;

    }
    private function orderNumChart()
    {
        $chart_options = [
            'chart_title' => 'احصائيات عدد الطلبات',
            'report_type' => 'group_by_string',
            'model' => 'App\Models\Order',
            'group_by_field' => 'created_at',
            'chart_type' => 'line',
        ];

        $chart6 = new LaravelChart($chart_options);
        return $chart6;

    }

    public function counts()
    {

        $startOfMonth = now()->startOfMonth()->format('Y-m-d h:m:s');
        $endOfMonth = now()->endOfMonth()->format('Y-m-d h:m:s');

        return  [
            'vendors' => Store::where('status', 'approved')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            'charities' => Charity::where('status', 'approved')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            'orders' => Order::where('status', 'paid')->whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
            'users' => User::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count(),
        ];
    }
}
