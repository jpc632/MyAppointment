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
        $newArr = array();
        $cnt = 0;
        foreach($timesArr as $time)
        {
            $isValid = Appointment::where('id', $time->appointment_id)->where('date', '>=', date('Y-m-d'))->first();
            if($isValid)
            {
                //select doctor name from users based on appointment_id 
                $doctor_name = User::where('id', $time->appointment_id)
                    ->first()
                    ->name;
                //append to new arr
                $newArr[$cnt]['doctor_name'] = $doctor_name;
                $newArr[$cnt]['id'] = $time->id;
                $newArr[$cnt]['time'] = $time->time;
                $newArr[$cnt]['date'] = $isValid->date;
                $cnt++;
            }
            
        }
        //dd($newArr);
        return view('patient.index', ['timesArr' => $newArr]);
    }

    public function book()
    {   
        return view('patient.book');
    }

    public function show(Request $request)
    {
        $dateToday = date('Y-m-d');
        $request->validate([
            'date' => ['date', 'required', 'date_format:Y-m-d', 'after_or_equal:' . $dateToday],
        ]);
        //Query available times for appointment based on the date chosen
        $date = $request->date;
        $timesArr = DB::table('appointments')
                        ->join('times', function($join) use ($date){
                            $join->on('appointments.id', '=', 'times.appointment_id')
                                ->where('appointments.date', '=', $date)
                                ->distinct();
                        })
                        ->get();

        return view('patient.book', ['timesArr' => $timesArr, 'dateChosen' => $date]);
    }

    public function viewDoctors(Request $request)
    {
        $request->validate([
            'time' => 'required'
        ]);
        $date = $request->date;
        $time = $request->time[0];
        //get records of available slots for time chosen 
        $timeSlots = DB::table('appointments')
                        ->join('times', function($join) use ($date, $time){
                            $join->on('appointments.id', '=', 'times.appointment_id')
                                ->where('appointments.date', '=', $date)
                                ->where('times.patient_id', '=', NULL)
                                ->where('times.time', '=', $time);
                        })
                        ->get();

        $doc_info_arr = array();
        //get doctor info based on app_id
        foreach($timeSlots as $d)
        {
            $doc_id = Appointment::where('id', $d->appointment_id)
                                    ->first()
                                    ->user_id;

            $doc_info_arr[$doc_id] = User::where('id', $doc_id)
                                            ->first()
                                            ->name;
        }

        return view('patient.book', ['doc_info_arr' => $doc_info_arr, 
                                    'dateChosen' => $date, 
                                    'timeChosen' => $time]);
    }

    public function update(Request $request)
    {
        dd($request->all());
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