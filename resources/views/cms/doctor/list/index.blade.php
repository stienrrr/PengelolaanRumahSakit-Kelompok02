@extends('cms.layout.main-cms', ['title' => 'List Doctor'])

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="h4">List Doctor</div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-lg-12 col-xxl-12 d-flex align-items-stretch">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <h6 class="mb-0 text-uppercase">Data List Doctor</h6>
                        <hr>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Full Name</th>
                                        <th>Front Title</th>
                                        <th>Back Title</th>
                                        <th>Specialist</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td class="text-center"></td>
                                            <td>{{ $data->name }}</td>
                                            <td class="text-center">{{ $data->doctorTitle->front_title ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $data->doctorTitle->back_title ?? 'N/A' }}</td>
                                            <td class="text-center">{{ $data->doctorTitle->specialist ?? 'N/A' }}</td>
                                            <td>
                                                <div class="row row-cols-auto g-2 align-items-center justify-content-center">
                                                    <div class="col">
                                                        <a href="{{ route('doctors.list.edit', $data->id) }}" class="btn btn-sm btn-warning raised d-flex gap-2"><i class="material-icons-outlined">edit</i></a>
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