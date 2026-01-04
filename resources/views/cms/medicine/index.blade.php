@extends('cms.layout.main-cms', ['title' => 'Medicine'])

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="h4">Medicine</div>
            <div class="ms-auto">
                <a href="{{ route('medicines.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-2"></i> Add Medicine</a>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-12 col-xxl-12 d-flex align-items-stretch">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Data Medicine</h6>
                        <hr>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Expiry Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ $data->code }}</td>
                                            <td class="text-center">{{ $data->name }}</td>
                                            <td class="text-center">{{ $data->stock }}</td>
                                            <td class="text-center">{{ 'Rp ' . number_format($data->price, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ Carbon\Carbon::parse($data->expiry_date)->format('d F Y') }}</td>
                                            <td>
                                                <div class="row row-cols-auto g-2 align-items-center justify-content-center">
                                                    <div class="col">
                                                        <a href="{{ route('medicines.edit', $data->id) }}" class="btn btn-sm btn-warning raised d-flex gap-2"><i class="material-icons-outlined">edit</i></a>
                                                    </div>
                                                    <div class="col">
                                                        <button type="button" class="btn btn-sm btn-danger raised d-flex gap-2" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal-{{ $data->id }}"><i class="material-icons-outlined">delete</i></button>
                                                    @include('cms.medicine.partial.delete')
                                                    </div>
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