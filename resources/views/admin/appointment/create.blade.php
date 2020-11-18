@extends('admin.layouts.master')

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                    <div class="d-inline">
                        <h5>Doctors</h5>
                        <span>Create an appointment</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.html"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h5>Choose date</h5>
            </div>
            <div class="card-body">
                <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker">
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Choose time</h5>
                <div >
                    <div class="btn btn-secondary">
                        <label for="checkAll" style="font-size: 120%">
                        <input type="checkbox" id="checkAll" name="checkAll" class="form-input p-2" >
                        Check All
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            @for($hour = 6; $hour < 21; $hour++)
                                <td class="d-flex btn-group-toggle" data-toggle="buttons">
                                    @for($minute = 0; $minute < 6; $minute++)
                                        <label class="btn btn-light flex-fill" id="check">
                                            <input type="checkbox" name="time[]" value="{{ $hour }}:{{ $minute }}0">&nbsp;
                                            {{ $hour }}:{{ $minute }}0
                                        </label>
                                    @endfor
                                </td>
                            @endfor
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
@endsection