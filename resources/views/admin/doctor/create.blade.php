@extends('admin.layouts.master')

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-edit bg-blue"></i>
                    <div class="d-inline">
                        <h5>Doctors</h5>
                        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
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

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3>Add Doctor</h3>
                </div>
                <div class="card-body">
                    <form class="forms-sample " method="POST" action="">
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <label for="education">Degree</label>
                                <input type="text" name="education" class="form-control" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="address">Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-6">
                                <label for="phone_number">Phone Number</label>
                                <input type="tel" name="phone_number" class="form-control" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="specialisation">Specialisation</label>
                                <select class="form-control" name="specialisation" required>
                                    <option value="GP">General Practitioner</option>
                                    <option value="PCP">Primary Care Practitioner</option>
                                    <option value="Physician">Physician</option>
                                    <option value="Nurse">Nurse</option>
                                </select>
                            </div>
                        </div>
                        <div class="row p-2">
                            
                            <div class="col-lg-10">
                                <label for="description">About</label>
                                <textarea class="form-control" id="description" rows="4"></textarea>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Profile Photo</label>
                                <input type="file" name="img[]" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" style="border-radius: 8%" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row p-2">
                            <div class="col-lg-2">
                                <button class="btn btn-light mr-2">Cancel</button>
                            </div>
                            <div class="col-lg-8"></div>
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>    
                            </div> 
                        </div>  
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
