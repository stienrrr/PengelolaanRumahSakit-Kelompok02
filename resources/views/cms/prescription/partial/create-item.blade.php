@extends('cms.layout.main-cms', ['title' => 'Add Prescription Item'])

@section('content')
	<div class="main-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="h4">Add Prescription Item</div>
		</div>
		<!--end breadcrumb-->

		<div class="col-8 col-xl-8 mx-auto">
			<div class="card">
				<div class="card-body p-4">
					<form class="row g-3" action="{{ route('prescriptions.store-item', $prescription->id) }}" method="POST">
						@csrf
						<div class="col-md-12">
							<label for="medicine_id" class="form-label">Medicine</label>
							<select class="form-select mb-3" aria-label="Default select example" id="medicine_id" name="medicine_id">
								<option selected disabled>--- Select Medicine ---</option>
								@foreach ($medicines as $md)
									<option value="{{ $md->id }}">{{ $md->name }} - {{ 'Rp ' . number_format($md->price, 0, ',', '.') }}</option>
								@endforeach
							</select>
						</div>
						
						<div class="col-md-6">
							<label for="quantity" class="form-label">Qty</label>
							<input type="number" class="form-control" id="quantity" name="quantity" placeholder="Qty" required>
						</div>
						
						<div class="col-md-6">
							<label for="dosage" class="form-label">Dosage</label>
							<textarea class="form-control" id="dosage" name="dosage" placeholder="dosage" required></textarea>
						</div>

						<div class="col-md-12">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4">Submit</button>
								<a href="{{ route('prescriptions.show', $prescription->id) }}" class="btn btn-secondary px-4">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection