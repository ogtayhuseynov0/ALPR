<?php

namespace App\Http\Controllers;

use App\Car;
use App\CarPermission;
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
        if (Auth::id() == 21) {
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

    public function log($query = null)
    {
        $loggo = DB::table('logs')
            ->select(DB::raw('COUNT(id), CONCAT(DAY(created_at),\'-\',MONTH(created_at))as time'))
            ->groupBy(DB::raw('DAY(created_at)'))
            ->get()->map(function ($item) {
                // Return the number of persons with that age
                return count($item);
            });;
        $yesterday_users = Log::whereDate('created_at', today()->subDays(1))->count();
        $users_2_days_ago = Log::whereDate('created_at', today()->subDays(2))->count();
        $chart= new LogChart;
        $chart->labels($loggo->keys());
        $chart->dataset('Enter Count', 'line', $loggo->keys());
        $query = Input::get('query');
        if ($query == null) {
            $logs = Log::orderBy('id', 'DESC')->paginate(5);
            return view('dashboard.v2', compact('logs','chart'));
        } else {
            $logs = Log::orderBy('id', 'DESC')->where('log_info', 'LIKE', '%' . $query . '%')->paginate(5);
            return view('dashboard.v2', compact('logs','chart'));
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
