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
                return back()->with('error', "এই ফোন নাম্বার এবং কোড ব্যবহার করে আপনি পেয়েছেন: $wheel->discount");
            }else{
                return redirect('career/wheel')->with('status', $request->phone_number);
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
            'phone_number' => 'required|size:11|unique:wheels,phone_number',
            'course_type' => 'required',
        ], [
            'phone_number.required' => 'ফোন নাম্বার ফাঁকা রাখা যাবে না',
            'phone_number.unique' => 'একই ফোন নাম্বার দুইবার ব্যবহার করা যাবে না',
            'phone_number.size' => '১১ ডিজিটের ফোন নাম্বার দিন',
            'course_type.required' => 'কোন ধরনের কোর্স করতে চান, পছন্দ করুন'
        ]);
        $random_code = Str::upper(Str::random(5));
        //sms send metronet start
        $response = Http::get("http://masking.metrotel.com.bd/smsnet/bulk/api?api_key=d5671ddcb22785c4bf647ffdc312dbcc273&mask=Creative IT&recipient=$request->phone_number&message=Your Code is: $random_code");
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
    public function final_shot(Request $request)
    {
        $phone_number = $request->session_value;
        $final_result = $request->final_text;
        if(strpos($final_result, "%") !== false){
            $display_message = "অভিনন্দন! আপনি ক্রিয়েটিভ আইটির প্রফেশনাল কোর্সে $final_result স্পেশাল ডিস্কাউন্টটি পেয়েছেন। খুব শীঘ্রই  আপনাকে কল করে বিস্তারিত জানিয়ে দেয়া হবে। আপনি চাইলে আমাদের অফিসিয়াল পেইজে নক করতে পারেন- m.me/creativeITInstitute অফারটি পেতে আপনার ফোনে পাঠানো মেসেজটি সংরক্ষণ করুন। অফারটি ৭ই জুলাই পর্যন্ত প্রযোজ্য।";
            $message_to_send = "Congratulations! You have received $final_result special discount on our professional courses. Soon you will get a call with details. You can also knock us at m.me/creativeITInstitute";
        } else{
            $display_message = "অভিনন্দন! আপনি ক্রিয়েটিভ আইটির প্রফেশনাল কোর্সে রেগুলার ডিস্কাউন্টটি পেয়েছেন। খুব শীঘ্রই  আপনাকে কল করে বিস্তারিত জানিয়ে দেয়া হবে। আপনি চাইলে আমাদের অফিসিয়াল পেইজে নক করতে পারেন- m.me/creativeITInstitute অফারটি পেতে আপনার ফোনে পাঠানো মেসেজটি সংরক্ষণ করুন। অফারটি ৭ই জুলাই পর্যন্ত প্রযোজ্য।";
            $message_to_send = "Congratulations! You have received a regular discount on our professional courses. Soon you will get a call with details. You can also knock us at m.me/creativeITInstitute";
        }
        Wheel::where('phone_number', $phone_number)->update([
            'used_status' => true,
            'discount' => $final_result
        ]);
        $response = Http::get("http://masking.metrotel.com.bd/smsnet/bulk/api?api_key=d5671ddcb22785c4bf647ffdc312dbcc273&mask=Creative IT&recipient=$phone_number&message=$message_to_send");
        echo $display_message;
    }
    public function resend_code($id)
    {
        $wheel = Wheel::find($id);
        $response = Http::get("http://masking.metrotel.com.bd/smsnet/bulk/api?api_key=d5671ddcb22785c4bf647ffdc312dbcc273&mask=Creative IT&recipient=$wheel->phone_number&message=আপনার কোড: $wheel->code");
        if(json_decode($response, true)['status'] == 'success'){
            return back()->with('success', 'Code Send Again to '.$wheel->phone_number);
        }else{
            echo "Something is wrong, contact with developer";
        }

    }
}
