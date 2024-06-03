<?php

namespace App\Http\Controllers\Charity;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class WelcomeController extends Controller
{
    public function index()
    {
        $charity = auth('charity')->user();
        $currentMonthMembersCount = $charity->members()->whereMonth('created_at', Carbon::now()->month)->count();
        $previousMonthMembersCount = $charity->members()->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();

        if ($previousMonthMembersCount > 0) {
            $percentageIncrease = (($currentMonthMembersCount - $previousMonthMembersCount) / $previousMonthMembersCount) * 100;
        } else {
            // Handle division by zero if there were no members in the previous month
            $percentageIncrease = $currentMonthMembersCount > 0 ? 100 : 0;
        }

        $currentMonthDonationsCount = $charity->donations()->whereMonth('created_at', Carbon::now()->month)->count();
        $previousMonthDonationsCount = $charity->donations()->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();

        if ($previousMonthDonationsCount > 0) {
            $percentageIncreaseDonation = (($currentMonthDonationsCount - $previousMonthDonationsCount) / $previousMonthDonationsCount) * 100;
        } else {
            // Handle division by zero if there were no Donations in the previous month
            $percentageIncreaseDonation = $currentMonthDonationsCount > 0 ? 100 : 0;
        }

        $chart1 = $this->donationChart();
        $chart2 = $this->storeChart();



        return view('charity.welcome', compact('currentMonthMembersCount', 'percentageIncrease'  , 'currentMonthDonationsCount' , 'chart1' , 'chart2' , 'percentageIncreaseDonation'));
    }
    private function donationChart()
    {
        $authCharityId = auth('charity')->id();

        $chart_options = [
            'chart_title' => 'احصائيات التبرعات',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Donation',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at', // still need this for date grouping
            'filter_days' => 365, // to limit data to the past year, if needed
            'where_raw' => "charity_id = $authCharityId", // Raw where clause for filtering by charity
        ];

        $chart1 = new LaravelChart($chart_options);
        return $chart1;
    }
    private function storeChart()
    {
        $authCharityId = auth('charity')->id();

        $chart_options = [
            'chart_title' => 'احصائيات الاعضاء',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\CharityMember',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'filter_field' => 'created_at', // still need this for date grouping
            'filter_days' => 365, // to limit data to the past year, if needed
            'where_raw' => "charity_id = $authCharityId", // Raw where clause for filtering by charity
        ];
        $chart2 = new LaravelChart($chart_options);
        return $chart2;

    }
}
