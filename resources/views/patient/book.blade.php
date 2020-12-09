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
            
            @if(isset($doc_info_arr))
                <div class="card-body">
                    <form class="forms-sample" method="POST" action="{{ route('patient.update') }}">
                        @csrf
                        @method('PUT')
                        @foreach($doc_info_arr as $doc_id => $doc_name)
                            <label onclick="registerChecked()" class="btn btn-light" id="check" style="width:33%">
                                <input type="checkbox" name="doctor" 
                                    value="{{ $doc_id }}">
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