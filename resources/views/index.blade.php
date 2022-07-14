<div class="row">
  <div class="col-12">
    @include('importfile')
  </div>
  <div class="col-12 mt-4">
    <form action="{{ route('search-patient') }}" method="GET">
      @csrf
      <div class="input-group">
        <input type="search" name="search" placeholder="Search patient by code" class="form-control">
        <span class="input-group-prepend">
          <button type="submit" class="btn btn-success">Search</button>
        </span>
      </div>
    </form>
    <div class="d-flex justify-content-end mt-3 rounded">
      <a href="{{ route('patient.add') }}" class="btn btn fw-bold" style="background-color:#f6f6e9;" > + Add New Patient</a>
    </div>
  </div>
</div>
<div class="main--container ms-0">
@if(session('message'))
  <div class="alert alert-success fw-bold">{{session('message')}}</div>
@endif
    <div class="container mt-5 overflow-scroll">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="1%">Patient No.</th>
                    <th scope="col" >Patient Code</th>
                    <th scope="col">Case Status</th>
                    <th scope="col" >Age</th>
                    <th scope="col" >City/Municipality</th>
                    <th scope="col">Province</th>
                    <th scope="col" width="3%">Inputted By</th>
                    <th scope="col" width="3%">Updated By</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($patients as $patient)
                    <tr>
                        <th scope="row">{{ $patient->id }}</th>
                        <td>{{ $patient->patient_code }}</td>
                        <td>{{ $patient->case_status }}</td>
                        <td>{{ $patient->age }}</td>
                        <td>{{ $patient->pat_location_name }}</td>
                        <td>{{ $patient->province }}</td>
                        <td>{{ $patient->inputted_by_name ? $patient->inputted_by_name : ($patient->updated_by_name ? $patient->updated_by_name : '-') }}</td>
                        <td>{{ $patient->updated_by_name }}</td>
                        <td>
                           <a href="{{ route('patient.detail', ['id' => $patient->id ]) }}" class="btn btn-info btn-sm">Update</a>
                        </td>
                    </tr>
                 @endforeach
            </tbody>
        </table>
        <div class="py-3">
          {!! $patients->links('pagination::bootstrap-4') !!}
        </div>
    </div>
</div>