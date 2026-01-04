@extends('cms.layout.main-cms', ['title' => 'Add Medicine'])

@section('content')
	<div class="main-content">
		<!--breadcrumb-->
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
			<div class="h4">Add Medicine</div>
		</div>
		<!--end breadcrumb-->

		<div class="col-8 col-xl-8 mx-auto">
			<div class="card">
				<div class="card-body p-4">
					<form class="row g-3" action="{{ route('medicines.store') }}" method="POST">
						@csrf
						<div class="col-md-6">
							<label for="code" class="form-label">Code</label>
							<input type="text" class="form-control" id="code" name="code" placeholder="Code" required>
						</div>

						<div class="col-md-6">
							<label for="name" class="form-label">Name</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
						</div>
						
						<div class="col-md-6">
							<label for="type" class="form-label">Type</label>
							<input type="text" class="form-control" id="type" name="type" placeholder="Ex. Tablet, Syrup, Capsule, Ointment" required>
						</div>
						
						<div class="col-md-6">
							<label for="stock" class="form-label">Stock</label>
							<input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" required>
						</div>
						
						<div class="col-md-6">
							<label for="unit" class="form-label">Unit</label>
							<input type="text" class="form-control" id="unit" name="unit" placeholder="Ex. Bottles, Strips, Pcs" required>
						</div>
						
						<div class="col-md-6">
							<label for="price" class="form-label">Price</label>
							<input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
						</div>

						<div class="col-md-6">
							<label for="expiry_date" class="form-label">Expiry Date</label>
							<input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
						</div>
						<div class="col-md-6">
							<label for="description" class="form-label">Description</label>
							<textarea class="form-control" id="description" name="description" placeholder="Description ..." rows="3"></textarea>
						</div>

						<div class="col-md-12">
							<div class="d-md-flex d-grid align-items-center gap-3">
								<button type="submit" class="btn btn-primary px-4">Submit</button>
								<a href="{{ route('medicines.index') }}" class="btn btn-secondary px-4">Back</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection