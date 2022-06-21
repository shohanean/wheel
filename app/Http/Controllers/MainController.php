<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Wheel;
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
            $wheel = Wheel::where('phone_number', $request->phone_number)->first();
            if($wheel->used_status){
                return back()->with('error', "এই ফোন নাম্বার এবং কোড ব্যবহার করে আপনি $wheel->discount% ডিস্কাউন্ট পেয়েছেন");
            }else{
                return redirect('career/wheel')->with('status', 'All Good');
            }
        }else{
            return back()->with('error', 'ফোন নাম্বারের সাথে কোড মিলে নাই');
        }
    }
    public function career_wheel()
    {
        if(session('status')){
            return view('career_wheel');
        }else{
            abort(404);
        }
    }
    public function career_wheel_post(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|unique:wheels,phone_number',
            'course_type' => 'required',
        ], [
            'phone_number.required' => 'ফোন নাম্বার ফাঁকা রাখা যাবে না',
            'phone_number.unique' => 'একই ফোন নাম্বার দুইবার ব্যবহার করা যাবে না',
            'course_type.required' => 'কোন ধরনের কোর্স করতে চান, পছন্দ করুন'
        ]);
        $random_code = Str::upper(Str::random(5));
        //sms send metronet start
        $response = Http::get("http://masking.metrotel.com.bd/smsnet/bulk/api?api_key=d5671ddcb22785c4bf647ffdc312dbcc273&mask=Creative IT&recipient=$request->phone_number&message=Your code is: $random_code");
        if(json_decode($response, true)['status'] == 'success'){
            Wheel::insert([
                'phone_number' => $request->phone_number,
                'course_type' => $request->course_type,
                'code' => $random_code,
                'created_at' => Carbon::now()
            ]);
            return redirect('verification')->with([
                's_phone_number' => $request->phone_number,
                'success' => 'আপনার ফোন নাম্বারে কোড পাঠানো হয়েছে।'
            ]);
        }else{
            echo "Try again";
        }
        //sms send metronet end
    }
}
