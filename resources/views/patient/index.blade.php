@extends('patient.layout.master')

@section('content')

    <div class="row d-flex justify-content-center m-5 p-5">
        <div class="col-md-8">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Appointments</h4>
                    <p class="card-category">View your appointments</p>
                </div>
                <div class="card-body">
                    <table id="data_table" class="table container-fluid">
                        <thead>
                            <tr class="">
                                <th>Doctor</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Cancel</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($timesArr as $time)
                                <tr class="">
                                    <td>{{ $time['doctor_name'] }}</td>
                                    <td>{{ $time['date'] }}</td>
                                    <td>{{ $time['time'] }}</td>
                                    <td>
                                        <div class="table-actions ">
                                            <a href="{{ route('staff.show', $time['id']) }}">
                                                <button class="btn btn-primary btn-link btn-sm" rel="tooltip" data-original-title="Delete">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

