@extends('cms.layout.main-cms', ['title' => 'Registration'])

@section('content')
	<div class="main-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="h4">Registration</div>
		</div>
		<!--end breadcrumb-->

		<div class="col-8 col-xl-8 mx-auto">
			<div class="card">
				<div class="card-body p-4">
					<form class="row g-3" action="{{ route('registrations.store') }}" method="POST">
						@csrf
						<div class="col-md-12">
							<label for="doctor_schedule_id" class="form-label">Doctor</label>
							<select class="form-select mb-3" aria-label="Default select example" id="doctor_schedule_id" name="doctor_schedule_id">
								<option selected disabled>--- Select Doctor ---</option>
								@foreach ($schedules as $schedule)
									<option value="{{ $schedule->id }}">{{ $schedule->doctor->name }} ({{ $schedule->day }}, {{ $schedule->start_time }} - {{ $schedule->end_time }})</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-12">
							<label for="complaint_initial" class="form-label">Complaint Initial</label>
							<textarea class="form-control" id="complaint_initial" name="complaint_initial" placeholder="Complaint Initial ..." rows="3" required></textarea>
						</div>

						<div class="col-md-12">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4">Submit</button>
								<a href="{{ route('registrations.index') }}" class="btn btn-secondary px-4">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection