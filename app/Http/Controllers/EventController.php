<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEvent;
use App\Models\Event;
use App\Models\RegisterEvent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Validator;
use DB;
class EventController extends Controller
{
    public function RegisterEvents($event_id) {
        return view('events.register',compact('event_id'));
    }


    public function RegisterEventsPost(Request  $request, $event_id) {
        try {
            DB::BeginTransaction();

            $register_event = RegisterEvent::where(function ($q) use($request) {
                $q->where( 'email', $request->email)->orWhere('phone',$request->phone);
            })->where('event_id',$event_id)->first();

            if($register_event) {
                toastr()->error('Attendance has been recorded previously at the following time..'.$register_event->created_at, 'Sorry');
                return redirect()->back();
            }
            $code = Str::random(36);

             while (RegisterEvent::where('code', $code)->exists()) {
                 $code = Str::random(36);
             }
            $user =  RegisterEvent::create([
                'code' => $code,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'number_people' => $request->number_people,
                'event_id' => $event_id
            ]);
            $qrCode = QrCode::size(150)->generate(route('event.attend', ['code' => $user->code]));
//            Mail::to($user->email)->send(new WelcomeEvent($qrCode));
            toastr()->success('You have been successfully checked in!', 'Congrats');
            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            return $e;
        }
    }

    public function showAllEvent() {
         $all_events = RegisterEvent::with('event')->get();
        return view('admin.all_events',compact('all_events'));

    }

    public function exportDataPdf(Request $request) {
         $event = RegisterEvent::where('id',$request->register_event_id)->first();
        return view('events.export_pdf',compact('event'));

    }

    public function eventAttend(Request $request, $code) {
        RegisterEvent::where('code',$code)->update([
           'attend_event' => 1
        ]);
        toastr()->success('You have been attended!', 'Congrats');
        return redirect()->back(); //
    }


    public function checkAttendance(Request  $request) {
       $check_attendance = RegisterEvent::where('code',$request->code)->first();
       if($check_attendance->attend_event == 1) {
           return 1;
       } else {
           return 0;
       }
    }

}
