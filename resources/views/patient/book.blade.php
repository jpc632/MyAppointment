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
            <div class="card-header">
                <h5>Date</h5>
            </div>
            @if(isset($timesArr))
                <form method="POST" action="{{ route('patient.viewDoctors') }}">
                    @csrf
                    <div class="card-body">
                        <input type="date" class="form-control" id="name" name="date"  >
                    </div>
                    
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="d-flex btn-group-toggle flex-wrap" data-toggle="buttons">
                                @foreach($timesArr as $times)
                                    <label onclick="registerChecked()" class="btn btn-light" id="check" style="width:33%">
                                        <input type="checkbox" id="allTimes" name="time[]" 
                                            value="{{ $times->time }}"  >&nbsp;
                                            {{ $times->time }}
                                    </label>
                                @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <input type="submit" class="btn btn-primary" value="submit">
                </form>
            @endif
                <div class="card-header d-flex justify-content-between">
                    <h5>@if(isset($date)) Your Appointments for:  {{ $date }} @endif</h5>
                </div>
                @if(isset($doc_info_arr))
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('patient.update') }}">
                            @csrf
                            @method('PUT')
                            @foreach($doc_info_arr as $doc_id => $doc_name)
                                <label onclick="registerChecked()" class="btn btn-light" id="check" style="width:33%">
                                    <input type="checkbox" name="doctor" 
                                        value="{{ $doc_id }}"  >&nbsp;
                                        {{ $doc_name}}
                                </label>
                            @endforeach
                            <input type="hidden" value="{{ $timeChosen }}" name="time">
                            <input type="hidden" value="{{ $dateChosen }}" name="date">
                            <input type="submit" class="btn btn-primary"  value="submit">
                        </form>
                    </div>
                @endif 
        </div>
    </div>
@endsection