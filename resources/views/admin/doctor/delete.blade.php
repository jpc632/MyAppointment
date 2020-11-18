@extends('admin.layouts.master')

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                    <div class="d-inline">
                        <h5>Doctors</h5>
                        <span>Delete a doctor</span>
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
                        <li class="breadcrumb-item active" aria-current="page">Delete</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="card" style="max-width: 350px">
            <div class="card-header">
                <h3>Delete Doctor</h3>
            </div>
            <div class="card-footer">
                <form class="forms-sample " method="POST" action="{{ route('doctor.destroy', $doctor->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <h6>Do you want to permanantly delete {{ $doctor->name }}?</h6>

                    <div class="row d-flex justify-content-between p-2">
                        <div class="pl-3">
                            <a href="{{ route('doctor.index') }}" class="btn btn-secondary ">Cancel</a>
                        </div>
                        <div class="pr-3">
                            <button type="submit" class="btn btn-danger mr-2">Confirm</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection