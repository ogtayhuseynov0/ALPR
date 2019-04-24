<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarPermission;
use App\Charts\CarLogChart;
use App\Log;
use App\Photo;
use App\UserPermission;
use App\Whitelist;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Charts\LogChart;
use Charts;
class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::id() == 29) {
            return redirect("/dashboard/car");
        } else {
            return redirect("/user/" . Auth::id());
        }
    }
    public function deleteWhite($id=null)
    {
        Whitelist::find($id)->delete();
        return redirect('/dashboard/perm');
    }
    public function checkw($plate)
    {
        $data = json_encode(array('allowed' => false),JSON_FORCE_OBJECT);
        $perm = Whitelist::where('licence_plate', '=', $plate);
//        echo $perm;
        if ($perm->count()>0){
            $now= now();
            $start_date = new \DateTime($perm->get()[0]['from']);
            $end_date = new \DateTime($perm->get()[0]['to']);
            $since_start = $start_date->diff($end_date);
            if ($now > $start_date && $now < $end_date)
            {
                $data = json_encode(array('allowed' => true,),JSON_FORCE_OBJECT);;
                return response()->json(
                    collect([
                        'allowed' => true
                    ])
                );
            }else{
                return response()->json(
                    collect([
                        'allowed' => false
                    ])
                );
            }
        }else{
            return response()->json(
                collect([
                    'allowed' => false
                ])
            );
        }
    }

    /**
     * @param null $query
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function log($query = null)
    {
        $datas = collect([]); // Could also be an array
        $dates = collect([]); // Could also be an array
        $lps=DB::table('logs')->select(DB::raw('DISTINCT SUBSTRING(log_info, 1,10) as a'))->orderBy('id', 'desc')->get()->pluck('a');
        $lp_counts=DB::table('logs')->select(DB::raw('COUNT(log_info) as a'))
            ->groupBy(DB::raw('SUBSTRING(log_info, 1,10)'))->orderBy('id', 'desc')->get()->pluck('a');
        for ($days_backwards = 5; $days_backwards >= 0; $days_backwards--) {
            // Could also be an array_push if using an array rather than a collection.
            $datas->push(Log::whereDate('created_at', today()->subDays($days_backwards))->count());
            $dates->push(today()->subDays($days_backwards)->format('m-d'));
        }
        $chart= new LogChart;
        $chart->labels($dates);
        $chart->dataset('Log Count', "line", $datas)->color("black")->backgroundColor("#0165B4");
//        dd($dates);
        $chart2= new CarLogChart;
        $chart2->labels($lps);
        $chart2->loaderColor("#0165B4");
        $chart2->dataset('Car Log Count', "line", $lp_counts)->color("black")->backgroundColor("red");

        $query = Input::get('query');
        if ($query == null) {
            $logs = Log::orderBy('id', 'DESC')->paginate(5);
            return view('dashboard.v2', compact('logs','chart','chart2'));
        } else {
            $logs = Log::orderBy('id', 'DESC')->where('log_info', 'LIKE', '%' . $query . '%')->paginate(5);
            return view('dashboard.v2', compact('logs','chart','chart2'));
        }
    }

    public function upload()
    {
        return view("upload");
    }

    public function saveWhite(Request $request)
    {
        $from = date('Y-m-d H:i:s', strtotime("$request->fdate $request->ftime"));
        $to = date('Y-m-d H:i:s', strtotime("$request->tdate $request->ttime"));
        $request['from']=$from;
        $request['to']=$to;
        $wit = new WhitelistController;
        $wit->store($request);
        return redirect('/dashboard/perm');
    }

//    public function saveWhitee(Request $request)
//    {
////        $wit = new WhitelistController;
////        $wit->store($request);
//        $from = date('Y-m-d H:i:s', strtotime("$request->fdate $request->ftime"));
//        $to = date('Y-m-d H:i:s', strtotime("$request->tdate $request->ttime"));
//        $lp = $request->licence_plate;
//        $sw= new Whitelist;
//        $sw->from=$from;
//        $sw->to=$to;
//        $sw->licence_plate=$lp;
//        $sw->save();
//        return redirect('/dashboard/perm');
//    }

    public function recognise()
    {
        $photos = Photo::orderBy('id', 'desc')->paginate(2);
        return view("recognise")->with("photos", $photos);
    }

    public function run($id)
    {
        $command = escapeshellcmd("python C:\\xampp\htdocs\lp2\public\py\\run2.py " . $id);
        $output = shell_exec($command);
        return $output;
    }
    public function udelete($id)
    {
       User::find($id)->delete();
       return back();
    }

    public function approve($lp)
    {
        $perm = new CarPermission;
        $perm->l_p = $lp;
        $perm->is_allowed = 1;
        $perm->save();
        return redirect('/dashboard/car');
    }

    public function uapprove($id)
    {
        $res = new UserPermission;
        $res->is_allowed = 1;
        $res->user_id = $id;
        $res->save();
        return redirect('/dashboard/user');
    }

    public function user()
    {
        $query = Input::get('query');
        if ($query == null) {
            $logs = User::orderBy('id', 'desc')->paginate(5);
            return view('dashboard.v2', compact("logs"));
        } else {
            $logs = User::where('name', 'LIKE', '%' . $query . '%')->orWhere('surname', 'LIKE', '%' . $query . '%')->orderBy('id', 'desc')->paginate(5);
            return view('dashboard.v2', compact("logs"));
        }
    }

    public function perm()
    {
        $query = Input::get('query');
        if ($query == null) {
            $logs = Whitelist::orderBy('id', 'desc')->paginate(5);
            return view('dashboard.v2', compact("logs"));
        } else {
            $logs = Whitelist::where('licence_plate', 'LIKE', '%' . $query . '%')->orderBy('id', 'desc')->paginate(5);
            return view('dashboard.v2', compact("logs"));
        }
    }

    public function car($query = null)
    {
        $query = Input::get('query');
        if ($query == null) {
            $logs = Car::orderBy('id', 'desc')->paginate(5);
            return view('dashboard.v2', compact("logs"));
        } else {
            $logs = Car::where('licence_plate', 'LIKE', '%' . $query . '%')->orderBy('id', 'desc')->paginate(5);
            return view('dashboard.v2', compact("logs"));
        }

    }

    public function carquery($query)
    {
        $logs = Car::where('licence_plate', 'LIKE', '%' . explode("=", $query)[1] . '%')->paginate(5);
        return $logs;
    }
}
