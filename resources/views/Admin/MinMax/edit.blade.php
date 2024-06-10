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
                            <a href="javascript:void(0)" onclick="submitFormU()" id="btnSimpanU"
                                class="btn btn-primary-light">Simpan</a>
                            <a class="btn btn-light" href="{{ url('/admin/minmax') }}">Kembali</a>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-1"
                            class="table table-bordered text-nowrap border-bottom dataTable no-footer dtr-inline collapsed">
                            <thead>
                                <th class="border-bottom-0" width="1%">No</th>
                                <th class="border-bottom-0">Nama Barang</th>
                                <th class="border-bottom-0">Stok</th>
                                <th class="border-bottom-0">Min Permintaan (hari)</th>
                                <th class="border-bottom-0">Max Permintaan (hari)</th>
                                <th class="border-bottom-0">Leadtime (hari)</th>
                                <th class="border-bottom-0">Rata2 Permintaan</th>
                                <th class="border-bottom-0">Safety Stok</th>
                                <th class="border-bottom-0">Min. Stok</th>
                                <th class="border-bottom-0">Max. Stok</th>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                    <tr data-id="{{ $item->barang_id }}">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->barang_nama }}</td>
                                        <td>{{ $item->current_stock }}</td>
                                        <!-- Kolom input -->
                                        <td>
                                            <input type="number" name="minPermintaanU[]"
                                                id="input_minpermintaan{{ $item->barang_id }}" class="form-control"
                                                placeholder="0" value="{{ $item->min_permintaan }}">
                                        </td>
                                        <td>
                                            <input type="number" name="maxPermintaanU[]"
                                                id="input_maxpermintaan{{ $item->barang_id }}" class="form-control"
                                                placeholder="0" value="{{ $item->max_permintaan }}">
                                        </td>
                                        <td>
                                            <input type="number" name="leadtimeU[]"
                                                id="input_leadtime{{ $item->barang_id }}" class="form-control"
                                                placeholder="0" value="{{ $item->leadtime }}">
                                        </td>
                                        <td>
                                            <input type="number" name="averageU[]"
                                                id="input_average{{ $item->barang_id }}" class="form-control" readonly
                                                placeholder="0" value="{{ $item->average }}">
                                        </td>
                                        <td>
                                            <input type="number" name="safetyU[]"
                                                id="input_safety_stok{{ $item->barang_id }}" class="form-control" readonly
                                                placeholder="0" value="{{ $item->safety_stok }}">
                                        </td>
                                        <td>
                                            <input type="number" name="minStokU[]"
                                                id="input_min_stok{{ $item->barang_id }}" class="form-control"
                                                placeholder="0" readonly value="{{ $item->min_stok }}">
                                        </td>
                                        <td>
                                            <input type="number" name="maxStokU[]"
                                                id="input_max_stok{{ $item->barang_id }}" class="form-control" readonly
                                                placeholder="0" value="{{ $item->max_stok }}">
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
        $(document).ready(function() {
            $('#table-1 tbody').on('input', 'input[type="number"]', function() {
                const id = $(this).closest('tr').data('id');
                const minPermintaan = parseFloat($('#input_minpermintaan' + id).val()) || 0;
                const maxPermintaan = parseFloat($('#input_maxpermintaan' + id).val()) || 0;
                const leadtime = parseFloat($('#input_leadtime' + id).val()) || 0;
                const average = (minPermintaan + maxPermintaan) / 2;
                const safety = (maxPermintaan - average) * leadtime;
                const minStok = (average * leadtime) + safety;
                const maxStok = 2 * (average * leadtime) + safety;

                $('#input_average' + id).val(average.toFixed(2));
                $('#input_safety_stok' + id).val(safety.toFixed(2));
                $('#input_min_stok' + id).val(minStok.toFixed(2));
                $('#input_max_stok' + id).val(maxStok.toFixed(2));
            });
        });

        function submitFormU() {
            let dataToUpdate = [];

            $('#table-1 tbody tr').each(function() {
                const id = $(this).data('id');
                const minPermintaan = parseFloat($('#input_minpermintaan' + id).val()) || 0;
                const maxPermintaan = parseFloat($('#input_maxpermintaan' + id).val()) || 0;
                const leadtime = parseFloat($('#input_leadtime' + id).val()) || 0;
                const average = (minPermintaan + maxPermintaan) / 2;
                const safety = (maxPermintaan - average) * leadtime;
                const minStok = (average * leadtime) + safety;
                const maxStok = 2 * (average * leadtime) + safety;

                dataToUpdate.push({
                    id: id,
                    minPermintaan: minPermintaan,
                    maxPermintaan: maxPermintaan,
                    leadtime: leadtime,
                    average: average,
                    safety: safety,
                    minStok: minStok,
                    maxStok: maxStok
                });
            });

            console.log(dataToUpdate);

            // Lakukan permintaan AJAX untuk memperbarui data
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/minmax/proses_ubah_store') }}",
                data: {
                    data: dataToUpdate,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    swal({
                        title: "Berhasil diubah!",
                        type: "success"
                    });
                    // Tindakan lebih lanjut setelah berhasil diperbarui
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Penanganan kesalahan jika ada
                }
            });
        }
    </script>
@endsection
