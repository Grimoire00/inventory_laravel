@extends('Master.Layouts.app', ['title' => $title])

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW 1 OPEN -->
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/jenisbarang') }}" class="card bg-primary img-card box-primary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $jenis }}</h2>
                            <p class="text-white mb-0">Jenis Barang </p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-package text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/satuan') }}" class="card bg-secondary img-card box-secondary-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $satuan }}</h2>
                            <p class="text-white mb-0">Satuan Barang</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-package text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/merk') }}" class="card  bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $merk }}</h2>
                            <p class="text-white mb-0">Merk Barang</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-package text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/barang') }}" class="card bg-info img-card box-info-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $barang }}</h2>
                            <p class="text-white mb-0">Barang</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-package text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/barang-masuk') }}" class="card bg-success img-card box-success-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $bm }}</h2>
                            <p class="text-white mb-0">Barang Masuk</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-repeat text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/barang-keluar') }}" class="card bg-danger img-card box-danger-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $bk }}</h2>
                            <p class="text-white mb-0">Barang Keluar</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-repeat text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/customer') }}" class="card bg-purple img-card box-purple-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $customer }}</h2>
                            <p class="text-white mb-0">Customers</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-user text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- COL END -->
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/user') }}" class="card bg-warning img-card box-warning-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $user }}</h2>
                            <p class="text-white mb-0">User</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-user text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
            <a href="{{ url('admin/supplier') }}" class="card bg-orange img-card box-warning-shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="text-white">
                            <h2 class="mb-0 number-font">{{ $supplier }}</h2>
                            <p class="text-white mb-0">Supplier</p>
                        </div>
                        <div class="ms-auto"> <i class="fe fe-user text-white fs-40 me-2 mt-2"></i> </div>
                    </div>
                </div>
            </a>
        </div>

    </div>

    {{-- Row Data --}}
    <div class="row">
        <div class="col-lg-12 overflow-x-auto">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-1"
                            class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                            <thead>
                                <th class="border-bottom-0" width="1%">No</th>
                                <th class="border-bottom-0">Nama Barang</th>
                                <th class="border-bottom-0">Stok</th>
                                <th class="border-bottom-0">Min. Permintaan</th>
                                <th class="border-bottom-0">Max. Permintaan</th>
                                <th class="border-bottom-0">Rata2 Permintaan</th>
                                <th class="border-bottom-0">Leadtime (Hari)</th>
                                <th class="border-bottom-0">Safety Stok</th>
                                <th class="border-bottom-0">Min. Stok</th>
                                <th class="border-bottom-0">Max. Stok</th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ROW 1 CLOSED -->
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table;
        $(document).ready(function() {
            table = $('#table-1').DataTable({
                "processing": true,
                "serverSide": true,
                "info": true,
                "order": [],
                "stateSave": true,
                "scrollX": true,
                "lengthMenu": [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100]
                ],
                "pageLength": 10,
                lengthChange: true,
                "ajax": {
                    "url": "{{ url('/admin/dashboard/show') }}",
                },
                "columns": [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false
                    },
                    {
                        data: 'barang_nama',
                        name: 'barang_nama'
                    },
                    {
                        data: 'totalstok',
                        name: 'totalstok'
                    },
                    {
                        data: 'min_permintaan',
                        name: 'min_permintaan'
                    },
                    {
                        data: 'max_permintaan',
                        name: 'max_permintaan'
                    },
                    {
                        data: 'average',
                        name: 'average'
                    },
                    {
                        data: 'leadtime',
                        name: 'leadtime'
                    },
                    {
                        data: 'safety_stok',
                        name: 'safety_stok'
                    },
                    {
                        data: 'min_stok',
                        name: 'min_stok'
                    },
                    {
                        data: 'max_stok',
                        name: 'max_stok'
                    },
                ],
            });
        });
    </script>
@endsection
