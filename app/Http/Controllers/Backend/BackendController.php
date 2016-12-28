<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Carbon\Carbon;
use App\User;

class BackendController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Show the application backend dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // start date today -7 days
        $startDate = new \DateTime();
        $startDate = $startDate->sub(new \DateInterval('P7D'));
        
        // end date today +1 days to fix bug with interval
        $endDate = new \DateTime();
        $endDate = $endDate->add(new \DateInterval('P1D'));

        // interval
        $interval = new \DateInterval('P1D'); 

        // date range
        $dateRange = new \DatePeriod($startDate, $interval, $endDate);

        // get all users by date
        $users = User::orderBy('created_at')->get();
        
        // per date count number user signups
        foreach($dateRange as $k => $date)
        { 
            $countUser = 0;
            foreach($users as $user)
            {
                if($date->format('m-d-Y') == $user->created_at->format('m-d-Y'))
                {
                    $countUser++;
                }                
            }
            // stock all count values of User
            $signups[] = $countUser;

            // stock timestamp and nb user
            $userCharts[] = array(strtotime($date->format('Y-m-d'))* 1000, $countUser);
        }

        // get max user
        $signups = max($signups);

        // encode data for signups chart
        $userCharts = json_encode($userCharts);

        // count total users
        $users = User::all()->count();
        
        return view('backend.home')->with(array('users' => $users, 'signups' => $signups, 'userCharts' => $userCharts));
    }

    /**
     * Get stats period
     *
     * @param  int  $startdate
     * @param  int  $enddate
     * @return Response
     */
  public function getStats(Request $request, $startdate, $enddate)
  { 

    //check if request is Ajax
    if($request->ajax()){

        // retrieve signups for given period
        $signups = User::whereBetween('created_at', [Carbon::createFromFormat('m-d-Y', $startdate)->toDateTimeString(), Carbon::createFromFormat('m-d-Y', $enddate)->toDateTimeString()])->count();

        // start date today -7 days
        $startDate = Carbon::createFromFormat('m-d-Y', $startdate);
        $startDate = $startDate->sub(new \DateInterval('P7D'));
        
        // end date today +1 days to fix bug with interval
        $endDate = Carbon::createFromFormat('m-d-Y', $enddate);
        $endDate = $endDate->add(new \DateInterval('P1D'));

        // interval
        $interval = new \DateInterval('P1D'); 

        // date range
        $dateRange = new \DatePeriod($startDate, $interval, $endDate);

        // get all users by date
        $users = User::orderBy('created_at')->get();

        // per date count number user signups
        foreach($dateRange as $k => $date)
        { 
            $countUser = 0;
            foreach($users as $user)
            {
                if($date->format('m-d-Y') == $user->created_at->format('m-d-Y'))
                {
                    $countUser++;
                }                
            }

            // stock timestamp and nb user
            $userCharts[] = array(strtotime($date->format('Y-m-d'))* 1000, $countUser);
        }

        // stock all statistiques in array
        $stats = array('signups' => $signups, 'userCharts' => $userCharts);

        // return datacenters from provider
        return $stats;

    }
    abort('404');
  }

}
