<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Time;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    //View patients bookings
    public function index()
    {
        $timesArr = Time::where('patient_id', Auth::user()->id)->get();

        foreach($timesArr as $time)
        {
            //select doctor name from users based on appointment_id 
            $doctor_name = User::where('id', $time->appointment_id)
                                    ->first()
                                    ->name;
            //append to time array
            $time['doctor_name'] = $doctor_name;
        }
        return view('patient.index', ['timesArr' => $timesArr]);
    }

    public function book()
    {
        $timesArr = DB::table('times')
                        ->where('patient_id', '=', NULL)
                        ->orderBy('time', 'asc')
                        ->distinct()
                        ->get(); //FIXME: order by 
        
        return view('patient.book', ['timesArr' => $timesArr]);
    }

    public function viewDoctors(Request $request)
    {
        $dateToday = date('Y-m-d');
        $request->validate([
            'date' => ['date', 'required', 'date_format:Y-m-d', 'after_or_equal:' . $dateToday],
            'time' => 'required'
        ]);

        $doctorsAvailable = Time::where('time', $request->time)
                                    ->where('patient_id', '=', NULL)
                                    ->get();
        $doc_info_arr = array();
        //get doctor info based on app_id
        foreach($doctorsAvailable as $d)
        {
            $doc_id = Appointment::where('id', $d->appointment_id)
                                    ->first()
                                    ->user_id;

            $doc_info_arr[$doc_id] = User::where('id', $doc_id)
                                            ->first()
                                            ->name;
        }

        return view('patient.book', ['doc_info_arr' => $doc_info_arr, 
                                    'dateChosen' => $request->date, 
                                    'timeChosen' => $request->time[0]]);
    }

    public function update(Request $request)
    {
        
        $app_id = Appointment::where('date', $request->date)
                                ->where('user_id', $request->doctor)
                                ->first()
                                ->id;

        $booking = Time::where('appointment_id', $app_id)
                            ->where('time', $request->time)
                            ->first();

        $booking->update([
            'patient_id' => Auth::user()->id
        ]);

        return redirect()
                ->back()
                ->with('message', 'Appointment booked successfully!');
    }
}