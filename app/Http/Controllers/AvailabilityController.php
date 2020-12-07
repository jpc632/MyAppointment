<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Time;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.availability.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.availability.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dateToday = date('Y-m-d');

        $request->validate([
            'date' => ['date', 'required', 'unique:appointments,date,NULL,id,user_id,' . Auth::id(), 'date_format:Y-m-d', 'after_or_equal:' . $dateToday],
            'time' => 'required'
        ]);

        $appointment = Appointment::create([
            'user_id' => Auth::user()->id,
            'date' => $request->date
        ]);

        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointment->id,
                'time' => $time
            ]);
        }

        return redirect()->back()->with('message', 'Shift create for' . $request->date);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    //Display Availability based on date
    public function show(Request $request, $id)
    {
        $availability = Appointment::where('date', $request->date)->where('user_id', $id)->first();
        if (!$availability)
            return redirect()->to('appointment')->with('message', 'No shifts for this date.');

        $timesArr = Time::where('appointment_id', $availability->id)->get();
        $date = $request->date;

        return view('admin.availability.index', [
            'timesArr' => $timesArr,
            'date' => $date,
            'appointment_id' => $availability->id
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $appointment_id = $request->appointment_id;
        Time::where('appointment_id', $appointment_id)
            ->delete();
        Appointment::where('id', $appointment_id)
            ->delete();

        return redirect()->route('availability.index')->with('message', 'Record deleted successfully!');
    }
}
