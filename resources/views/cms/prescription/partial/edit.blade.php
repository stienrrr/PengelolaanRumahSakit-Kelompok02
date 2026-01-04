@extends('cms.layout.main-cms', ['title' => 'Edit Medicine'])

@section('content')
	<div class="main-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="h4">Edit Medical Record</div>
		</div>
		<!--end breadcrumb-->

		<div class="col-8 col-xl-8 mx-auto">
			<div class="card">
				<div class="card-body p-4">
					<form class="row g-3" action="{{ route('prescriptions.update', $data->id) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="col-md-12">
							<label for="medical_record_id" class="form-label">Medical Record</label>
							<select class="form-select mb-3" aria-label="Default select example" id="medical_record_id" name="medical_record_id">
								<option selected disabled>--- Select Medical Record ---</option>
								@foreach ($medicalRecords as $md)
									<option value="{{ $md->id }}" {{ $md->id == $data->medical_record_id ? 'selected' : '' }}>{{ $md->patient->name }} - {{ $md->doctor->name }} - {{ $md->registration->registration_code }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="col-md-12">
							<label for="date" class="form-label">Visit Date</label>
							<input type="date" class="form-control" id="date" name="date" value="{{ $data->date }}" placeholder="date" required>
						</div>

						<div class="col-md-12">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-warning px-4">Update</button>
								<a href="{{ route('prescriptions.index') }}" class="btn btn-secondary px-4">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection