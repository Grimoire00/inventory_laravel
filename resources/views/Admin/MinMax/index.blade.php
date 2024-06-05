@extends('Master.Layouts.app', ['title' => $title])

@section('content')
    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title">{{ $title }}</h1>

    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW -->
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-between">
                    <h3 class="card-title">Data</h3>
                    @if ($hakTambah > 0)
                        <div>
                            <a class=" btn btn-primary-light" href="{{ route('minmax.proses_ubah') }}">Edit
                                Perhitungan</a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-1"
                            class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                            <thead>
                                <th class="border-bottom-0" width="1%">No</th>
                                {{-- <th class="border-bottom-0">Gambar</th> --}}
                                {{-- <th class="border-bottom-0">Kode Barang</th> --}}
                                <th class="border-bottom-0">Nama Barang</th>
                                <th class="border-bottom-0">Stok</th>
                                <th class="border-bottom-0">Min. Permintaan</th>
                                <th class="border-bottom-0">Max. Permintaan</th>
                                <th class="border-bottom-0">Rata2 Permintaan (/minggu)</th>
                                <th class="border-bottom-0">Leadtime</th>
                                <th class="border-bottom-0">Safety Stok</th>
                                <th class="border-bottom-0">Min. Stok</th>
                                <th class="border-bottom-0">Max. Stok</th>
                                {{-- <th class="border-bottom-0" width="1%">Action</th> --}}
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END ROW -->

    {{-- @include('Admin.Barang.tambah')
    @include('Admin.Barang.edit')
    @include('Admin.Barang.hapus')
    @include('Admin.Barang.gambar') --}}

    <script>
        function generateID() {
            id = new Date().getTime();
            $("input[name='kode']").val("BRG-" + id);
        }

        // function update(data) {
        //     $("input[name='idbarangU']").val(data.barang_id);
        //     $("input[name='kodeU']").val(data.barang_kode);
        //     $("input[name='namaU']").val(data.barang_nama.replace(/_/g, ' '));
        //     $("select[name='jenisbarangU']").val(data.jenisbarang_id);
        //     $("select[name='satuanU']").val(data.satuan_id);
        //     $("select[name='merkU']").val(data.merk_id);
        //     $("input[name='stokU']").val(data.barang_stok);
        //     $("input[name='hargaU']").val(data.barang_harga.replace(/_/g, ' '));
        //     if (data.barang_gambar != 'image.png') {
        //         $("#outputImgU").attr("src", "{{ asset('storage/barang/') }}" + "/" + data.barang_gambar);
        //     }
        // }

        // function hapus(data) {
        //     $("input[name='idbarang']").val(data.barang_id);
        //     $("#vbarang").html("barang " + "<b>" + data.barang_nama.replace(/_/g, ' ') + "</b>");
        // }

        function gambar(data) {
            if (data.barang_gambar != 'image.png') {
                $("#outputImgG").attr("src", "{{ asset('storage/barang/') }}" + "/" + data.barang_gambar);
            } else {
                $("#outputImgG").attr("src", "{{ url('/assets/default/barang/image.png') }}");
            }
        }

        function validasi(judul, status) {
            swal({
                title: judul,
                type: status,
                confirmButtonText: "Iya"
            });
        }
    </script>
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
            //datatables
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
                    "url": "{{ route('minmax.getminmax') }}",
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
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     searchable: false
                    // },
                ],
            });
        });
    </script>
@endsection
