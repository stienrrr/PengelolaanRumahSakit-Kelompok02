@extends('cms.layout.main-cms', ['title' => 'Registrations'])

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="h4">Registrations</div>
            @hasrole('pasien')
            <div class="ms-auto">
                <a href="{{ route('registrations.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-2"></i> Registration</a>
            </div>
            @endhasrole
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-12 col-xxl-12 d-flex align-items-stretch">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Data Registrations</h6>
                        <hr>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Registration Code</th>
                                        @hasrole('admin|petugas-pendaftaran')
                                        <th>Patient</th>
                                        @endhasrole
                                        <th>Doctor</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Complaint Initial</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ $data->registration_code }}</td>
                                            @hasrole('admin|petugas-pendaftaran')
                                            <td class="text-center">{{ $data->patient->name }}</td>
                                            @endhasrole
                                            <td class="text-center">{{ $data->doctorSchedule->doctor->name }}</td>
                                            <td class="text-center">{{ Carbon\Carbon::parse($data->registration_date)->format('d F Y') }}</td>
                                            <td class="text-center">
                                                <span
                                                    class="badge bg-grd-{{ match ($data->status) {
                                                        'pending' => 'warning',
                                                        'treating' => 'info',
                                                        'completed' => 'success',
                                                        'cancelled' => 'danger',
                                                        default => 'secondary',
                                                    } }}">
                                                    {{ match ($data->status) {
                                                        'pending' => 'Pending',
                                                        'treating' => 'Treating',
                                                        'completed' => 'Completed',
                                                        'cancelled' => 'Canceled',
                                                        default => 'Unknown',
                                                    } }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $data->complaint_initial }}</td>
                                            <td>
                                                <div class="row row-cols-auto g-2 align-items-center justify-content-center">
                                                    <div class="col">
                                                        <a href="{{ route('registrations.edit', $data->id) }}" class="btn btn-sm btn-warning raised d-flex gap-2"><i class="material-icons-outlined">edit</i></a>
                                                    </div>
                                                    
                                                    @hasrole('admin|petugas-pendaftaran')
                                                        <div class="col">
                                                            <button type="button" class="btn btn-sm btn-info raised d-flex gap-2" data-bs-toggle="modal"
                                                        data-bs-target="#statusModal-{{ $data->id }}"><i class="material-icons-outlined">settings</i></button>
                                                        @include('cms.registration.partial.status')
                                                        </div>
                                                    @endhasrole
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('custom-scripts')
    <script src="{{ asset('dashboard/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                responsive: true,
                order: [
                    [1, "asc"]
                ],
                columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }],
                drawCallback: function (settings) {
                    const api = this.api();
                    const start = api.page.info().start;
                    api.column(0, {
                        search: 'applied',
                        order: 'applied'
                    })
                        .nodes()
                        .each(function (cell, i) {
                            cell.innerHTML = start + i + 1;
                        });
                }
            });
        });
    </script>
@endpush