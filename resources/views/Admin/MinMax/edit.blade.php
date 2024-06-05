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
                            <a href="javascript:void(0)" onclick="checkForm()" id="btnSimpan" class="btn btn-primary">Simpan <i
                                    class="fe fe-check"></i></a>
                            <a href="javascript:void(0)" class="btn btn-light" onclick="reset()"
                                data-bs-dismiss="modal">Batal
                                <i class="fe fe-x"></i></a>
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
                                <th class="border-bottom-0">Min Permintaan (/hari)</th>
                                <th class="border-bottom-0">Max Permintaan (/hari)</th>
                                <th class="border-bottom-0">Rata2 Permintaan</th>
                                <th class="border-bottom-0">Leadtime (/hari)</th>
                                <th class="border-bottom-0">Min. Stok</th>
                                <th class="border-bottom-0">Max. Stok</th>
                                <th class="border-bottom-0">Safety Stok</th>
                                {{-- <th class="border-bottom-0" width="1%">Action</th> --}}
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->barang_nama }}</td>
                                        <td>{{ $item->current_stock }}</td>
                                        <!-- Kolom input -->
                                        <td>
                                            <input type="number" id="input_average{{ $item->id }}" class="form-control"
                                                placeholder="0" value="{{ $item->average }}">
                                        </td>
                                        <td>
                                            <input type="number" id="input_minpermintaan{{ $item->id }}"
                                                class="form-control" placeholder="0" value="{{ $item->min_permintaan }}">
                                        </td>
                                        <td>
                                            <input type="number" id="input_maxpermintaan{{ $item->id }}"
                                                class="form-control" placeholder="0" value="{{ $item->max_permintaan }}">
                                        </td>
                                        <td>
                                            <input type="number" id="input_leadtime{{ $item->id }}"
                                                class="form-control" placeholder="0" value="{{ $item->leadtime }}">
                                        </td>
                                        <td>
                                            <input type="number" id="input_safety_stok{{ $item->id }}"
                                                class="form-control" readonly placeholder="0"
                                                value="{{ $item->safety_stok }}">
                                        </td>
                                        <td>
                                            <input type="number" id="input_min_stok{{ $item->id }}"
                                                class="form-control" placeholder="0" readonly
                                                value="{{ $item->min_stok }}">
                                        </td>
                                        <td>
                                            <input type="number" readonly id="input_max_stok{{ $item->id }}"
                                                class="form-control" readonly placeholder="0"
                                                value="{{ $item->max_stok }}">
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
    <!-- END ROW -->

    {{-- @include('Admin.Barang.tambah')
    @include('Admin.Barang.edit')
    @include('Admin.Barang.hapus')
    @include('Admin.Barang.gambar') --}}
@endsection

@section('formEditJS')
    <script>
        function checkFormU() {
            const jenis = $("input[name='jenisbarangU']").val();
            setLoadingU(true);
            resetValidU();

            if (jenis == "") {
                validasi('Jenis Barang wajib di isi!', 'warning');
                $("input[name='jenisbarangU']").addClass('is-invalid');
                setLoadingU(false);
                return false;
            } else {
                submitFormU();
            }
        }

        function submitFormU() {
            const id = $("input[name='idjenisbarangU']").val();
            const jenis = $("input[name='jenisbarangU']").val();
            const ket = $("textarea[name='ketU']").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/jenisbarang/proses_ubah') }}/" + id,
                enctype: 'multipart/form-data',
                data: {
                    jenisbarang: jenis,
                    ket: ket
                },
                success: function(data) {
                    swal({
                        title: "Berhasil diubah!",
                        type: "success"
                    });
                    $('#Umodaldemo8').modal('toggle');
                    table.ajax.reload(null, false);
                    resetU();
                }
            });
        }

        function resetValidU() {
            $("input[name='jenisbarangU']").removeClass('is-invalid');
            $("textarea[name='ketU']").removeClass('is-invalid');
        };

        function resetU() {
            resetValidU();
            $("input[name='idjenisbarangU']").val('');
            $("input[name='jenisbarangU']").val('');
            $("textarea[name='ketU']").val('');
            setLoadingU(false);
        }

        function setLoadingU(bool) {
            if (bool == true) {
                $('#btnLoaderU').removeClass('d-none');
                $('#btnSimpanU').addClass('d-none');
            } else {
                $('#btnSimpanU').removeClass('d-none');
                $('#btnLoaderU').addClass('d-none');
            }
        }
    </script>
@endsection
