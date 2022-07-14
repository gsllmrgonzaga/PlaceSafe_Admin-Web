<div class="float-left">
  <div class="card">
    <div class="card-header font-weight-bold" style="background-color:#7CC1C6;">
      <h5 class="float-left" style="color:black;">Import Patients CSV File</h5>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">Oopss! Please Check this following errors in your file.
            <ol>
            <br>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ol>
        </div>
    @endif
    <div class="card-body">
        <form id="import-csv-form" method="POST"  action="{{ route('upload') }}" accept-charset="utf-8" enctype="multipart/form-data">
          @csrf
          <div class="input-group mb-3">
            <input type="file" name="patient_file" class="form-control" accept=".csv" required>
            <button class="btn btn fw-bold" style="background-color:#7CC1C6;" type="submit">Upload File</button>
          </div>
        </form>
    </div>
  </div>
</div>