@extends('cms.layout.main-cms', ['title' => 'Add Schedule Doctor'])

@section('content')
	<div class="main-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="h4">Add Schedule Doctor</div>
		</div>
		<!--end breadcrumb-->

		<div class="col-8 col-xl-8 mx-auto">
			<div class="card">
				<div class="card-body p-4">
					<form class="row g-3" action="{{ route('doctors.schedule.store') }}" method="POST">
						@csrf
						<div class="col-md-6">
							<label for="user_id" class="form-label">Doctor</label>
							<select class="form-select mb-3" aria-label="Default select example" id="user_id" name="user_id">
								<option selected disabled>--- Select Doctor ---</option>
								@foreach ($doctors as $doctor)
									<option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="col-md-6">
							<label for="day" class="form-label">Day</label>
							<input type="text" class="form-control" id="day" name="day" placeholder="Day" required>
						</div>

						<div class="col-md-6">
							<label for="start_time" class="form-label">Start Time</label>
							<input type="time" class="form-control" id="start_time" name="start_time" placeholder="Start Time"
								required>
						</div>

						<div class="col-md-6">
							<label for="end_time" class="form-label">End Time</label>
							<input type="time" class="form-control" id="end_time" name="end_time" placeholder="End Time"
								required>
						</div>

						<div class="col-md-12">
							<label for="notes" class="form-label">Notes</label>
							<textarea class="form-control" id="notes" name="notes" placeholder="Notes ..." rows="3"></textarea>
						</div>

						<div class="col-md-12">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4">Submit</button>
								<a href="{{ route('doctors.schedule') }}" class="btn btn-secondary px-4">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection