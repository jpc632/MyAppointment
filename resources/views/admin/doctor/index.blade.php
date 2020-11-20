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
                            @foreach($staff as $member)
                                <tr>
                                    <td>
                                        <div class="d-flex  justify-content-between">
                                            <div class="">
                                                {{ $member->name }}
                                            </div>
                                            
                                        </div>
                                    </td>
                                    <td>{{ $member->department }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->address }}</td>
                                    <td>{{ $member->phone_number }}</td>
                                    <td>{{ ucfirst($member->role->name) }}</td>
                                    <td>
                                        <div class="table-actions d-flex justify-content-around">
                                            <a href="{{ route('doctor.edit', $member->id) }}"><i class="material-icons">create</i></a>
                                            <a href="{{ route('doctor.show', $member->id) }}"><i class="material-icons">delete</i></a>
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

