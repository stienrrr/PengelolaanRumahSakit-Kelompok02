@extends('cms.layout.main-cms', ['title' => 'Add Medical Record'])

@section('content')
	<div class="main-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="h4">Add Medical Record</div>
		</div>
		<!--end breadcrumb-->

		<div class="col-8 col-xl-8 mx-auto">
			<div class="card">
				<div class="card-body p-4">
					<form class="row g-3" action="{{ route('medicalrecords.store') }}" method="POST">
						@csrf
						<div class="col-md-12">
							<label for="registration_id" class="form-label">Registration Number</label>
							<select class="form-select mb-3" aria-label="Default select example" id="registration_id" name="registration_id">
								<option selected disabled>--- Select Registration Number ---</option>
								@foreach ($registrations as $registration)
									<option value="{{ $registration->id }}">{{ $registration->patient->name }} - {{ $registration->doctorSchedule->doctor->name }} - {{ $registration->registration_code }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="col-md-6">
							<label for="date" class="form-label">Visit Date</label>
							<input type="date" class="form-control" id="date" name="date" placeholder="date" required>
						</div>
						
						<div class="col-md-6">
							<label for="complaint" class="form-label">Complaint</label>
							<textarea class="form-control" id="complaint" name="complaint" placeholder="complaint" required></textarea>
						</div>
						
						<div class="col-md-6">
							<label for="diagnosis" class="form-label">Diagnosis</label>
							<textarea class="form-control" id="diagnosis" name="diagnosis" placeholder="diagnosis" required></textarea>
						</div>

						<div class="col-md-6">
							<label for="treatment" class="form-label">Treatment</label>
							<textarea class="form-control" id="treatment" name="treatment" placeholder="treatment" required></textarea>
						</div>

						<div class="col-md-6">
							<label for="blood_pressure" class="form-label">Blood Pressure</label>
							<input type="text" class="form-control" id="blood_pressure" name="blood_pressure" placeholder="Blood Pressure" required>
						</div>

						<div class="col-md-6">
							<label for="weight" class="form-label">Weight</label>
							<input type="number" class="form-control" id="weight" name="weight" placeholder="Weight" required>
						</div>

						<div class="col-md-12">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4">Submit</button>
								<a href="{{ route('medicalrecords.index') }}" class="btn btn-secondary px-4">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection