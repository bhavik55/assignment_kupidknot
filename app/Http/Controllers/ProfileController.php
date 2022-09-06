<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PersonalDetail;
use Auth;

class ProfileController extends Controller
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
    public function PersonalDetail()
    {
        $user = Auth::user();
        if ($user->id) {
            $maindata = User::where('id', $user->id)->first();
            $personaldata = PersonalDetail::where('userid', $user->id)->first();
            if (!empty($personaldata)) {
                $maindata['gender'] = $personaldata->gender;
                $maindata['income'] = $personaldata->income;
                $maindata['dob'] = $personaldata->dob;
                $maindata['occupation'] = $personaldata->occupation;
                $maindata['family'] = $personaldata->family;
                $maindata['manglik'] = $personaldata->manglik;
                $maindata['p_income'] = $personaldata->p_income;
                $maindata['p_occupation'] = json_decode($personaldata->p_occupation);
                $maindata['p_family']  = json_decode($personaldata->p_family);
                $maindata['p_manglik'] = $personaldata->p_manglik;
            } else {
                $maindata['gender'] = '';
                $maindata['income'] = '';
                $maindata['dob'] = '';
                $maindata['occupation'] = '';
                $maindata['family'] = '';
                $maindata['manglik'] = '';
                $maindata['p_income'] = '';
                $maindata['p_occupation'] = '';
                $maindata['p_family']  = '';
                $maindata['p_manglik'] = '';
            }
            return view('personaldetail', compact('maindata'));
        } else {
            return redirect('/login');
        }
        
    }

    public function savePersonalDetail(Request $request) {
        
        $user = Auth::user();
        $personaldetail = PersonalDetail::where('userid', $user->id)->first();
        if (empty($personaldetail)) {
            $personaldetail = new PersonalDetail();
            $personaldetail->userid = $user->id;
            $personaldetail->dob = $request->input('dob');
            $personaldetail->gender = $request->input('gender');
            $personaldetail->income = $request->input('annualincome');
            $personaldetail->occupation = $request->input('occupation');
            $personaldetail->family = $request->input('family');
            $personaldetail->manglik = $request->input('manglik');
            $personaldetail->p_income = $request->input('p_expectedincome');
            $personaldetail->p_occupation = json_encode($request->input('p_occupation'));
            $personaldetail->p_family = json_encode($request->input('p_family'));
            $personaldetail->p_manglik = $request->input('p_manglik');
            $personaldetail->save();
        } else {
            $personaldetail = PersonalDetail::find($personaldetail->id);
            $personaldetail->dob = $request->input('dob');
            $personaldetail->gender = $request->input('gender');
            $personaldetail->income = $request->input('annualincome');
            $personaldetail->occupation = $request->input('occupation');
            $personaldetail->family = $request->input('family');
            $personaldetail->manglik = $request->input('manglik');
            $personaldetail->p_income = $request->input('p_expectedincome');
            $personaldetail->p_occupation = $request->input('p_occupation');
            $personaldetail->p_family = $request->input('p_family');
            $personaldetail->p_manglik = $request->input('p_manglik');
            $personaldetail->save();
        }
        return redirect('/home');
    }
}
