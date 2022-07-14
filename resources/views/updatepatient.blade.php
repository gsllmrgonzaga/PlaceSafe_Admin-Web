@extends('layouts.app')

@section('content')

<form action="{{ route('patient.detail', ['id' => $detail->id ]) }}" method="POST">

    @csrf

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header" style="background-color:#F9CBAD;">

                <h5 class="modal-title-centered">Edit Patient Form.</h5>

            </div>

            <div class="modal-body" style="background-color:#f6f6e9;">

                <p id="saveform_errList" class="d-none alert alert-danger"></p>
                <div class="form-group mb-3">
                    @if(session('message'))
                        {!! session('message') !!}
                    @endif
                </div>

                <div class="form-group mb-3">

                    <label for="" class="fw-bold">Patient Code.</label>

                    <input type="text" name="id" id="id" value="{{ $detail->id }}" class="id form-control" readOnly>

                </div>

                <div class="form-group mb-3">

                    <label for="" class="fw-bold">Name</label>

                    <input type="text" name="patient_code" id="patient_code"  value="{{ $detail->patient_code }}" class="patient_code form-control" readOnly>
                </div>
                
                <div class="col">
                    <label for="" class="fw-bold">Date</label>
                    <input type="date" name="updated_at" class="updated_at form-control">
                </div>

                <div class="form-group mb-3">
                    <label for="" class="fw-bold">Case Status</label>
                    <select class="form-select" name="case_status" aria-label="Default select example">
                        <option disabled selected>---select option---</option>
                        <option value="ACTIVE" {{ $detail->case_status == 'ACTIVE' ? 'selected' : '' }}>ACTIVE</option>
                        <option value="DIED" {{ $detail->case_status == 'DIED' ? 'selected' : '' }}>DIED</option>
                        <option value="RECOVERED" {{ $detail->case_status == 'RECOVERED' ? 'selected' : '' }}>RECOVERED</option>
                    </select>
                </div>

                <div class="form-group mb-3">

                    <label for="" class="fw-bold">Updated By</label>

                    <div class="form-control">{{ $detail->inputted_by_name ? $detail->inputted_by_name : ($detail->updated_by_name ? $detail->updated_by_name : '-') }}</div>

                    <input type="hidden" readonly name="updated_by" id="updated_by" value="{{ Auth::user()->id }}" class="updated_by form-control">

                </div>

            </div>



            <div class="modal-footer" style="background-color:#f6f6e9;">

                <button type="submit" class="btn btn-info">Update</button>
                <a href="{{ route('patients') }}" class="btn btn-danger">Cancel</a>
            </div>

        </div>

    </div>

</form>

@endsection

