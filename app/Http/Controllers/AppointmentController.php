<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Time;

class AppointmentController extends Controller
{
    public function show(Request $request)
    {
        $appointments = Appointment::where('user_id', Auth::user()->id)
                                        ->where('date', $request->date)
                                        ->first();
        if (!$appointments)
            return redirect()->back()->with('message', 'No shifts for this date.');

        $timesArr = Time::where('appointment_id', $appointments->id)
                            ->where('patient_id', '!=', NULL)
                            ->get(); 

        return view('admin.appointment.view', ['timesArr' => $timesArr, 
                                                'date' => $request->date, 
                                                'appointment_id' => $appointments->id]);
    }

    public function view()
    {
        return view('admin.appointment.view');
    }
}
