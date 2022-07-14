@extends('layouts.app')
@section('content')

<form action="{{ route('patient.add') }}" method="POST">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header" style="background-color:#F9CBAD;">
                <h5 class="modal-title-centered">Add Patient Form.</h5>
            </div>
            <h6 class="p-3 mb-0">Please input accurate information below.</h6>
            <h7 class="fw-bold px-3 mb-3" style="color:red;">NOTE: Before submitting,please review first the information. 
                        Some information will not be editable.</h7>

            <div class="modal-body" style="background-color:#f6f6e9;">
                <p id="saveform_errList" class="d-none alert alert-danger"></p>
                <div class="form-group mb-3">
                    @if(session('message'))
                        {!! session('message') !!}
                    @endif
                </div>
                <div class="row">
                    <div class="col">
                        <label for="" class="fw-bold">Code</label>
                        <input type="text" name="patient_code" class="patient_code form-control">
                    </div>
                    <div class="col">
                        <label for="" class="fw-bold">Date</label>
                        <input type="date" name="created_at" class="created_at form-control">
                    </div>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="" class="fw-bold">Case Status</label> 
                    <select class="form-select" name="case_status" aria-label="Default select example">
                        <option disabled selected>---select option---</option>
                        
                        <option value="ACTIVE">ACTIVE</option>
                        <option value="DIED">DIED</option>
                        <option value="RECOVERED">RECOVERED</option>
                    </select>

                </div>
                <div class="form-group mb-3">
                    <label for="" class="fw-bold">Age</label>
                    <input type="text" name="age" class="age form-control">
                </div>
                <div class="row">
                    <div class="col">
                        <label for="" class="fw-bold">Province</label>
                        <select class="form-control" id="province">
                            <option value="0">Select Province</option>
                            @foreach($provinces as $province => $value)
                                <option value="{{ $value->id }}">{{ $value->province }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="province" />
                    </div>
                    <div class="col">
                        <label for="" class="fw-bold">City/Municipality</label>
                        <select name="pat_location_name" class="form-control" id="location">
                            <option value="">Select Municipality</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group mb-3">
                    <label for="" class="fw-bold">Inputted By</label>
                    <div class="form-control">{{ Auth::user()->firstname }}</div>
                    <input type="hidden" readonly name="inputted_by" class="inputted_by form-control" value="{{ Auth::user()->id }}">
                </div>
                <div class="form-group mb-3">
                    <p id="addPatientMessage" class="d-none alert alert-success"></p>
                </div>
            </div>

            <div class="modal-footer" style="background-color:#f6f6e9;">
                <button type="submit" class="btn btn-info">Save</button>
                <a href="{{ route('patients') }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </div> 
</form>
<script type="text/javascript">
    $( document ).ready(function() {
        $('#province').change(function() {
            const BASE_URL = "{{Config('app.url')}}";
            var url = BASE_URL+'psAdmin/locations/'+$(this).val();
            $("[name=province]").val($("#province option:selected").text());
            axios.get(url).then((res) => {
                $('#location').find('option').remove().end();
                $('#location').append('<option value="">Select Municipality</option>');
                $.each(res.data, function(index, value) {
                    $('#location').append('<option value="'+value.locations_name+'">'+value.locations_name+'</option>');
                });
            });
        });
    });
</script>
@endsection

