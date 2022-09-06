<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use App\Models\PersonalDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role == 'admin') {
            return view('adminhome');
        } else {
            $authuserprefernce = PersonalDetail::where('userid', $user->id)->first();
            if (!empty($authuserprefernce)) {
                $pincome = explode('-', $authuserprefernce->p_income);
                if ($authuserprefernce == 'male') {
                    $gender = 'female'; 
                } else {
                    $gender = 'male'; 
                }
                $maindata = DB::table('users as u')->join('personal_details as pd', 'pd.userid', '=', 'u.id')
                        ->whereNot('u.role', 'admin')
                        ->whereNot('u.id', $user->id)
                        ->whereBetween('pd.income', [$pincome[0],$pincome[1]])
                        ->orWhere('pd.gender', $gender)
                        ->select('u.name', 'u.email', 'pd.*')
                        ->get();
            } else {
                $maindata = DB::table('users as u')->leftJoin('personal_details as pd', 'pd.userid', '=', 'u.id')
                ->whereNot('u.role', 'admin')
                ->whereNot('u.id', $user->id)
                ->select('u.name', 'u.email', 'pd.*')
                ->get();
            }
            
            return view('home', compact('maindata'));
        }
        
    }

    public function userList(Request $request) {
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $columnName_arr = $request->get('columns');
        $userslist = DB::table('users as u')->leftJoin('personal_details as pd', 'pd.userid', '=', 'u.id')
                    ->whereNot('u.role', 'admin')
                    ->select('u.name', 'u.email', 'pd.*');
        if (isset($columnName_arr[1]['search']['value']) && !empty($columnName_arr[1]['search']['value'])) {
            $userslist = $userslist->where('u.name', 'like', '%'.$columnName_arr[1]['search']['value'].'%');
        }
        if (isset($columnName_arr[2]['search']['value']) && !empty($columnName_arr[2]['search']['value'])) {
           
            $userslist = $userslist->where('u.email', 'like', '%'.$columnName_arr[2]['search']['value'].'%');
        }
        if (isset($columnName_arr[3]['search']['value']) && !empty($columnName_arr[3]['search']['value'])) {
            $userslist = $userslist->where('pd.dob', '=', 'like', '%'.$columnName_arr[3]['search']['value'].'%');
        }
        if (isset($columnName_arr[4]['search']['value']) && !empty($columnName_arr[4]['search']['value'])) {
            $userslist = $userslist->where('pd.gender', 'like', '%'.$columnName_arr[4]['search']['value'].'%');
        }
        if (isset($columnName_arr[5]['search']['value']) && !empty($columnName_arr[5]['search']['value'])) {
            $userslist = $userslist->where('pd.income', '>=', $columnName_arr[5]['search']['value']);
        }
        if (isset($columnName_arr[6]['search']['value']) && !empty($columnName_arr[6]['search']['value'])) {
            $userslist = $userslist->where('pd.occupation', 'like', '%'.$columnName_arr[6]['search']['value'].'%');
        }
        if (isset($columnName_arr[7]['search']['value']) && !empty($columnName_arr[7]['search']['value'])) {
            $userslist = $userslist->where('pd.family', 'like', '%'.$columnName_arr[7]['search']['value'].'%');
        }
        $totalRecords = $userslist->get();
        $alldata = $userslist->skip($start)
                    ->take($rowperpage == 'all' ? $totalRecords : $rowperpage)
                    ->get();
        $i = 0;
        $resultdata = [];
        $result = [];
        $i = 1;
        foreach ($alldata as $row) {
            $result['srno'] =  $i++;
            $result['name'] =  $row->name;
            $result['email'] = $row->email;
            $result['dob'] = $row->dob;
            $result['gender'] = $row->gender;
            $result['income'] = $row->income;
            $result['occupation'] = $row->occupation;
            $result['family'] = $row->family;
            array_push($resultdata, $result);
        }

        echo json_encode([
            'draw' => $_GET['draw'],
            'recordsTotal' => count($totalRecords),
            'recordsFiltered' => count($totalRecords),
            'data' => $resultdata,
        ]);
    }
}
