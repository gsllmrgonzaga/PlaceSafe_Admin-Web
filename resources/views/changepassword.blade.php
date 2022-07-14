@extends('layouts.app')
@section('content')
<form action="{{ route('changepassword') }}" method="POST">
    @csrf
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @isset($message)
                {!! $message !!}
            @endisset
            <div class="modal-body" style="background-color:#f6f6e9;">
                <p id="saveform_errList" class="d-none alert alert-danger"></p>
                <div class="form-group mb-3">
                    <label for="" class="fw-bold">Old Password</label>
                    <input type="password" name="password" class="password form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="fw-bold">New Password</label>
                    <input type="password" name="new_password" class="new_password form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="" class="fw-bold">Confirm Password</label>
                    <input type="password" name="confirm_password" class="confirm_password form-control">
                </div>
                <br>
            </div>
            <div class="modal-footer" style="background-color:#f6f6e9;">
                <button type="submit" class="btn btn-info">Change Password</button>
            </div>
        </div>
    </div> 
</form>
@endsection
