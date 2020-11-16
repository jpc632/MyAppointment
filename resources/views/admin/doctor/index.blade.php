@extends('admin.layouts.master')

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-inbox bg-blue"></i>
                    <div class="d-inline">
                        <h5>Doctors</h5>
                        <span>View all doctor's</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">Doctors</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>View Doctor's</h3>
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
                                <th class="nosort">&nbsp;</th>
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
                                            <div style="margin-top: -5px">
                                                <img src="{{ asset('images') }}/{{ $doctor->image }}" class="table-user-thumb " alt=""> 
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $doctor->department }}</td>
                                    <td>{{ $doctor->email }}</td>
                                    <td>{{ $doctor->address }}</td>
                                    <td>{{ $doctor->phone_number }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="#" data-toggle="modal" data-target="#exampleModal{{ $doctor->id }}"><i class="ik ik-eye"></i></a>
                                            <a href="{{ route('doctor.edit', $doctor->id) }}"><i class="ik ik-edit-2"></i></a>
                                            <a href="{{ route('doctor.show', $doctor->id) }}"><i class="ik ik-trash-2"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @include('admin.doctor.modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

