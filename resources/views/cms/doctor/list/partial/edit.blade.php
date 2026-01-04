@extends('cms.layout.main-cms', ['title' => 'Edit Doctor Title'])

@section('content')
	<div class="main-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="h4">Edit Doctor Title</div>
		</div>
		<!--end breadcrumb-->

		<div class="col-8 col-xl-8 mx-auto">
			<div class="card">
				<div class="card-body p-4">
					<form class="row g-3" action="{{ route('doctors.list.update', $user->id) }}" method="POST">
						@csrf
						@method('PUT')
						<div class="col-md-6">
							<label for="front_title" class="form-label">Front Title</label>
							<input type="text" class="form-control" id="front_title" name="front_title" value="{{ $user->doctorTitle->front_title ?? 'N/A' }}"
								placeholder="Front Title" required>
						</div>

						<div class="col-md-6">
							<label for="back_title" class="form-label">Back Title</label>
							<input type="text" class="form-control" id="back_title" name="back_title"
								value="{{ $user->doctorTitle->back_title ?? 'N/A' }}" placeholder="Back Title" required>
						</div>

						<div class="col-md-6">
							<label for="specialist" class="form-label">Specialist</label>
							<input type="text" class="form-control" id="specialist" name="specialist"
								value="{{ $user->doctorTitle->specialist ?? 'N/A' }}" placeholder="Specialist" required>
						</div>

						<div class="col-md-12">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-warning px-4">Update</button>
								<a href="{{ route('doctors.list') }}" class="btn btn-secondary px-4">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection