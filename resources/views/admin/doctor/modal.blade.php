<div class="modal fade" id="exampleModal{{ $doctor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Doctor Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <img src="{{ asset('images') }}/{{ $doctor->image }}" width="150" style="border-radius: 5%">
                    </div>
                    <div class="col-lg-8 pl-3">
                        <p>Name: {{ $doctor->name }}</p>
                        <p>Department: {{ $doctor->department }}</p>
                        <p>E-mail: {{ $doctor->email }}</p>
                        <p>Phone: {{ $doctor->phone_number }}</p>
                        <p>Address: {{ $doctor->address }}</p>
                        <p>Education: {{ $doctor->education }}</p>
                        <p>Bio: {{ $doctor->description }}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
