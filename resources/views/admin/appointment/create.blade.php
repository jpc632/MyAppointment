@extends('admin.layouts.master')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Appointment</h4>
                <p class="card-category">blahblah bblah</p>
            </div>
            <div class="card-body">
                <input type="date" class="form-control " id="datepicker" >
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
                            @for($hour = 8; $hour < 21; $hour++)
                                <td class="d-flex btn-group-toggle" data-toggle="buttons">
                                    @for($minute = 0; $minute < 6; $minute+=2)
                                        <label class="btn btn-light" id="check" style="width:100%">
                                            <input type="checkbox" name="time[]" value="{{ $hour }}:{{ $minute }}0" >&nbsp;
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