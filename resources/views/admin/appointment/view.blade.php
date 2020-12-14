@extends('admin.layouts.master')
//TODO: Add modal for times
@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert alert-danger">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">View Appointments</h4>
                <p class="card-category">View bookings for selected date</p>
            </div>
            <div class="card-header">
                <h5>Date</h5>
            </div>
            <form class="forms-sample" method="POST" action="{{ route('appointment.show') }}">
                @csrf
                <div class="card-body">
                    <input type="date" class="form-control" id="name" name="date"  >
                </div>
                <div class="card-body d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">View</button>
                </div>
            </form>
            @if(Route::is('appointment.show'))
                <div class="card-header d-flex justify-content-between">
                    <h5>@if(isset($date)) Your Appointments for:  {{ $date }} @endif</h5>
                </div>
                <div class="card-body d-flex flex-wrap justify-content-around">
                    @foreach($timesArr as $times)
                        <div class="card text-dark bg-light" style="width:45%">
                            <p class="border-bottom border-top p-3 ">
                                <strong class="d-block text-gray-dark">Time: {{ $times->time }}</strong>
                                <p class="pl-3">Patient: {{ $times->name }} </p>
                                <p class="pl-3">Email: {{ $times->email }} </p>
                            </p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection