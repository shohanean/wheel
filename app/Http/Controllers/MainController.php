<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wheel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;

class MainController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function verification()
    {
        return view('verification');
    }
    public function verification_post(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'code' => 'required'
        ], [
            'phone_number.required' => 'ফোন নাম্বার ফাঁকা রাখা যাবে না',
            'code.required' => 'কোড ফাঁকা রাখা যাবে না'
        ]);
        if(Wheel::where([
            'phone_number' => $request->phone_number,
            'code' => $request->code
        ])->exists()){
            return redirect('career/wheel');
        }else{
            return back()->with('error', 'ফোন নাম্বারের সাথে কোড মিলে নাই');
        }
    }
    public function career_wheel()
    {
        return view('career_wheel');
    }
    public function career_wheel_post(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|unique:wheels,phone_number'
        ], [
            'phone_number.required' => 'ফোন নাম্বার ফাঁকা রাখা যাবে না',
            'phone_number.unique' => 'একই ফোন নাম্বার দুইবার ব্যবহার করা যাবে না'
        ]);
        $random_code = Str::upper(Str::random(5));
        Wheel::insert([
            'phone_number' => $request->phone_number,
            'code' => $random_code,
            'created_at' => Carbon::now()
        ]);
        return redirect('verification')->with([
            's_phone_number' => $request->phone_number,
            'success' => 'আপনার ফোন নাম্বারে কোড পাঠানো হয়েছে। '.$random_code
        ]);
        die();
        //sms send start
        $url = "http://66.45.237.70/api.php";
        $number="$request->phone_number";
        $text="Please use this: $random_code";
        $data= array(
        'username'=>"01834833973",
        'password'=>"TE47RSDM",
        'number'=>"$number",
        'message'=>"$text"
        );

        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
        //sms send end
        if($sendstatus == "1101"){
            Wheel::insert([
                'phone_number' => $request->phone_number,
                'code' => $random_code,
                'created_at' => Carbon::now()
            ]);
            echo $random_code;
        }else{
            echo "Try again";
        }
    }
}
