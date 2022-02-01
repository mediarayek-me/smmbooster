<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Helpers\Helper;
use App\Models\Service;
use App\Events\NotifyEvent;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Artisan;

class DashboardController extends Controller
{
    public function dashboardAdmin()
    {

        $users_count = User::where('status',1)->get()->count();
        $ordrs_count = Order::get()->count();
        $services_count = Service::where('status',1)->get()->count();
        $total_earnings = Transaction::where('status','paid')->sum('profit');
        return view('admin.dashboard_admin',compact('users_count','ordrs_count','services_count','total_earnings'));
    }
    
    public function dashboardUser()
    {
        $user = Auth()->user();
        $ordrs_count = Order::where('user_id',$user->id)->get()->count();
        $transactions_count = Transaction::where('user_id',$user->id)->count();
        $total_spent = Order::where('status','completed')->where('user_id',$user->id)->sum('total');
        $balance = $user->funds;
        return view('admin.dashboard_user',compact('balance','ordrs_count','total_spent','transactions_count'));
    }

    public function getChartProfit()
    {

        if(Helper::env('APP_ENV') === 'demo')
        {
        $weekProfit = [500, 750, 650, 570, 582, 480, 580];
        $yearProfit =  [500, 750, 650, 570, 582, 480, 680, 750, 650, 570, 582, 480, 680];
        return response()->json(['weekProfit'=>$weekProfit,'yearProfit'=>$yearProfit], 200);
        }
        $week = ["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
        $months = array_reverse(['December', 'November', 'October', 'September', 'August', 'July', 'June', 'May', 'April', 'March', 'February', 'January']);
        $data_week = Transaction::select(DB::raw('DAYNAME(created_at) as day, SUM(profit) as profit'))
        ->whereBetween('created_at', [
            Carbon::parse('monday')->startOfDay(),
            Carbon::parse('Sunday')->endOfDay(),
        ])->groupBy('day')->get()->pluck('profit','day');
        $data_year = Transaction::select(DB::raw('MONTHNAME(created_at) as month, SUM(profit) as profit'))
        ->whereYear('created_at',date('Y'))
        ->groupBy('month')->get()->pluck('profit','month');
        $weekProfit = [];
        $yearProfit = [];
        foreach ($week as $day) {
            if(isset($data_week[$day]))
            array_push($weekProfit,$data_week[$day]);
            else
            array_push($weekProfit,0);
        }
        foreach ($months as $month) {
            if(isset($data_year[$month]))
            array_push($yearProfit,$data_year[$month]);
            else
            array_push($yearProfit,0);
        }
        return response()->json(['weekProfit'=>$weekProfit,'yearProfit'=>$yearProfit], 200);
    }
}
