@extends('patient.layout.master')
//TODO: Add modal for times
@section('content')
    <div class="container">
        @if (Session::has('message'))
            <div class="alert alert-success">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="card m-5 p-5">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Book Appointments</h4>
                <p class="card-category">Book an appointment for the specified date</p>
            </div>
            @if(!isset($dateChosen))
                <div class="card-header">
                    <h5>Date</h5>
                </div>
                <form method="POST" action="{{ route('patient.show') }}">
                    @csrf
                    <div class="card-body">
                        <input type="date" class="form-control  @error('date') is-invalid @enderror" name="date">
                        @error('date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary" value="submit">
                </form>
            @endif
            @if(isset($timesArr)) 
                <form method="POST" action="{{ route('patient.viewDoctors') }}">
                    @csrf
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="d-flex btn-group-toggle flex-wrap" data-toggle="buttons">
                                @foreach($timesArr as $times)
                                    <label onclick="registerChecked()" class="btn btn-light" id="check" style="width:33%">
                                        <input type="checkbox" id="allTimes" name="time[]" 
                                            value="{{ $times->time }}">
                                            {{ $times->time }}
                                    </label>
                                @endforeach
                                </td>
                            </tr>
                            <input type="hidden" value="{{ $dateChosen }}" name="date">
                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-primary" value="submit">
                </form>
            @endif
            
            @if(isset($availableDoctors))
                <div class="card-body">
                    @foreach($availableDoctors as $doctor)
                        <form class="forms-sample" method="POST" action="{{ route('patient.update') }}">
                        @csrf
                        @method('PUT')
                            <div class="card text-dark bg-light">
                                <p class="border-bottom border-top p-3">
                                    <input type="hidden" name="id" value="{{ $doctor->id }}">
                                    <strong class="d-block text-gray-dark">Name: {{ $doctor->name }}</strong>
                                    <p class="pl-3">Email: {{ $doctor->email }} </p>
                                    <p class="pl-3">Gender: {{ $doctor->gender }} </p>
                                    <p class="pl-3">Specialisation: {{ $doctor->department }} </p>
                                    <input type="submit" class="btn btn-primary"  value="Book">
                                </p>
                            </div>
                            <input type="hidden" value="{{ $timeChosen }}" name="time">
                            <input type="hidden" value="{{ $dateChosen }}" name="date">
                        </form>
                    @endforeach
                </div>
            @endif 
        </div>
    </div>
@endsection