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
                    <h4 class="card-title">Staff</h4>
                    <p class="card-category">Manage Doctors or Administrators</p>
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
                                        <div class="table-actions ">
                                            <a href="{{ route('staff.edit', $member->id) }}" >
                                                <button class="btn btn-primary btn-link btn-sm" rel="tooltip" data-original-title="Edit">
                                                    <i class="material-icons">create</i>
                                                </button>
                                            </a>
                                            <a href="{{ route('staff.show', $member->id) }}">
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

