@extends('cms.layout.main-cms', ['title' => 'Edit Users Patient'])

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="h4">Edit Users Patient</div>
        </div>
        <!--end breadcrumb-->

        <div class="col-8 col-xl-8 mx-auto">
            <div class="card">
							<div class="card-body p-4">
								<form class="row g-3" action="{{ route('users.admin.update', $user->id) }}" method="POST">
									@csrf
                                    @method('PUT')
									<div class="col-md-6">
										<label for="name" class="form-label">Full Name</label>
										<input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Jhon Doe" required>
									</div>

									<div class="col-md-6">
										<label for="username" class="form-label">Username</label>
										<input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" placeholder="jhondoe" required>
									</div>

									<div class="col-md-6">
										<label for="email" class="form-label">Email</label>
										<input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="mail@example.com" required>
									</div>

									<div class="col-md-6">
										<label for="role" class="form-label">Position</label>
										<select class="form-select mb-3" aria-label="Default select example" id="role" name="role">
											<option selected disabled>--- Select Position ---</option>
											@foreach ($roles as $role)
												<option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
											@endforeach
										</select>
									</div>
                                    
									<div class="col-md-12">
										<div class="d-md-flex d-grid align-items-center gap-3">
											<button type="submit" class="btn btn-warning px-4">Update</button>
											<a href="{{ route('users.patient') }}" class="btn btn-secondary px-4">Back</a>
										</div>
									</div>
								</form>
							</div>
						</div>
          </div>
    </div>
@endsection