@extends('admin.layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">View</h4>
                    <p class="card-category">View all Doctors or Administrators</p>
                </div>
                <div class="card-body">
                    <table id="data_table" class="table container-fluid">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctors as $doctor)
                                <tr>
                                    <td>
                                        <div class="d-flex  justify-content-between">
                                            <div class="">
                                                {{ $doctor->name }}
                                            </div>
                                            
                                        </div>
                                    </td>
                                    <td>{{ $doctor->department }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->address }}</td>
                                    <td>{{ $doctor->phone_number }}</td>
                                    <td>{{ ucfirst($doctor->role->name) }}</td>
                                    <td>
                                        <div class="table-actions d-flex justify-content-around">
                                            <a href="{{ route('doctor.edit', $doctor->id) }}"><i class="material-icons">create</i></a>
                                            <a href="{{ route('doctor.show', $doctor->id) }}"><i class="material-icons">delete</i></a>
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

