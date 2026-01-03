@extends('cms.layout.main-cms', ['title' => 'Add Users Patient'])

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="h4">Add Users Patient</div>
        </div>
        <!--end breadcrumb-->

        <div class="col-8 col-xl-8 mx-auto">
            <div class="card">
							<div class="card-body p-4">
								<form class="row g-3">
									<div class="col-md-6">
										<label for="name" class="form-label">Full Name</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="Jhon Doe" required>
									</div>

									<div class="col-md-6">
										<label for="username" class="form-label">Username</label>
										<input type="text" class="form-control" id="username" name="username" placeholder="jhondoe" required>
									</div>

									<div class="col-md-6">
										<label for="email" class="form-label">Email</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="mail@example.com" required>
									</div>

									<div class="col-md-6">
										<label for="password" class="form-label">Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="********" required>
									</div>
                                    
									<div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="submit" class="btn btn-primary px-4">Submit</button>
											<a href="{{ route('users.patient') }}" class="btn btn-secondary px-4">Back</a>
										</div>
									</div>
								</form>
							</div>
						</div>
          </div>
    </div>
@endsection