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
        $timesArr = DB::table('appointments')
                        ->join('times', function ($join) {
                            $join->on('appointments.id', '=', 'times.appointment_id')
                            ->where('appointments.date', '>=', date('Y-m-d'))
                            ->where('times.patient_id', '=', Auth::user()->id);
                        })
                        ->join('users', function($join){
                            $join->on('users.id', '=', 'appointments.user_id');
                        })
                        ->get();
        
        
        return view('patient.index', ['timesArr' => $timesArr]);
    }

    public function book()
    {   
        return view('patient.book');
    }

    private function unique_multidim_array($array)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array(
                $val->time,
                $key_array
            )) {
                $key_array[$i] = $val->time;
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    } 

    public function show(Request $request)
    {
        $dateToday = date('Y-m-d');
        $request->validate([
            'date' => ['date', 'required', 'date_format:Y-m-d', 'after_or_equal:' . $dateToday],
        ]);
        //Query available times for appointment based on the date chosen
        $date = $request->date;
        $timesArr = DB::table('times')
                        ->join('appointments', function($join) use ($date){
                            $join->on('appointments.id', '=', 'times.appointment_id')
                                ->where('appointments.date', '=', $date)
                                ->where('times.patient_id', '=', NULL);
                        })
                        ->get();
        
        $timesArr = $this->unique_multidim_array($timesArr);
        
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

        return redirect()->route('patient.book')->with('message', 'Appointment booked successfully!');
    }
}