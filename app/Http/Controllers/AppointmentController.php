<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Time;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function show(Request $request)
    {
        $date = $request->date;

        $timesArr = DB::table('times')
                        ->join('appointments', function ($join) use ($date) {
                            $join->on('appointments.id', '=', 'times.appointment_id')
                                ->where('appointments.date', '=', $date)
                                ->where('appointments.user_id', '=', Auth::user()->id);
                        })
                        ->join('users', function ($join) {
                            $join->on('users.id', '=', 'times.patient_id');
                        })
                        ->orderBy('time')
                        ->get();

        return view('admin.appointment.view', ['timesArr' => $timesArr, 'date' => $date]);
    }

    public function view()
    {
        return view('admin.appointment.view');
    }
}
