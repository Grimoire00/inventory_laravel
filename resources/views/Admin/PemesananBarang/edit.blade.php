<!-- MODAL EDIT -->
<div class="modal fade" data-bs-backdrop="static" id="Umodaldemo8">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Ubah Pemesanan Barang</h6><button aria-label="Close" onclick="resetU()"
                    class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="hidden" name="idbmU">
                        <div class="form-group">
                            <label for="bmkodeU" class="form-label">Kode Pesanan Barang <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="bmkodeU" readonly class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="tglmasukU" class="form-label">Tanggal Pesan <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="tglpesanU" class="form-control datepicker-date" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="supplierU" class="form-label">Pilih Supplier <span
                                    class="text-danger">*</span></label>
                            <select name="supplierU" id="supplierU" class="form-control">
                                <option value="">-- Pilih Supplier --</option>
                                @foreach ($supplier as $c)
                                    <option value="{{ $c->supplier_id }}">{{ $c->supplier_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode Barang <span class="text-danger me-1">*</span>
                                <input type="hidden" id="statusU" value="true">
                                <div class="spinner-border spinner-border-sm d-none" id="loaderkdU" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </label>
                            <div class="input-group">
                                <input type="text" class="form-control" autocomplete="off" name="kdbarangU"
                                    placeholder="">
                                <button class="btn btn-primary-light" onclick="searchBarangU()" type="button"><i
                                        class="fe fe-search"></i></button>
                                <button class="btn btn-success-light" onclick="modalBarangU()" type="button"><i
                                        class="fe fe-box"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" id="nmbarangU" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Satuan</label>
                                    <input type="text" class="form-control" id="satuanU" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <input type="text" class="form-control" id="jenisU" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input type="text" class="form-control" id="merkU" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Qty</label>
                                    <input type="text" class="form-control" name="pesan_jumlah" id="pesan_jumlahU">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Total Harga</label>
                                    <input type="text" class="form-control" name="totalharga" id="totalhargaU">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success d-none" id="btnLoaderU" type="button" disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <a href="javascript:void(0)" onclick="checkFormU()" id="btnSimpanU" class="btn btn-success">Simpan
                    Perubahan <i class="fe fe-check"></i></a>
                <a href="javascript:void(0)" class="btn btn-light" onclick="resetU()" data-bs-dismiss="modal">Batal
                    <i class="fe fe-x"></i></a>
            </div>
        </div>
    </div>
</div>

@section('formEditJS')
    <script>
        $('input[name="kdbarangU"]').keypress(function(event) {
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if (keycode == '13') {
                getbarangbyidU($('input[name="kdbarangU"]').val());
            }
        });

        function modalBarangU() {
            $('#modalBarang').modal('show');
            $('#Umodaldemo8').addClass('d-none');
            $('input[name="param"]').val('ubah');
            resetValidU();
            table2.ajax.reload();
        }

        function searchBarangU() {
            getbarangbyidU($('input[name="kdbarangU"]').val());
            resetValidU();
        }

        function getbarangbyidU(id) {
            $("#loaderkdU").removeClass('d-none');
            $.ajax({
                type: 'GET',
                url: "{{ url('admin/barang/getbarang') }}/" + id,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data) {
                    if (data.length > 0) {
                        $("#loaderkdU").addClass('d-none');
                        $("#statusU").val("true");
                        $("#nmbarangU").val(data[0].barang_nama);
                        $("#satuanU").val(data[0].satuan_nama);
                        $("#jenisU").val(data[0].jenisbarang_nama);
                        $("#merkU").val(data[0].merk_nama);
                    } else {
                        $("#loaderkdU").addClass('d-none');
                        $("#statusU").val("false");
                        $("#nmbarangU").val('');
                        $("#satuanU").val('');
                        $("#jenisU").val('');
                        $("#merkU").val('');
                    }
                }
            });
        }

        function checkFormU() {
            const tglpesan = $("input[name='tglpesanU']").val();
            const status = $("#statusU").val();
            const supplier = $("select[name='supplierU']").val();
            const pesan_jumlah = $("select[name='pesan_jumlahU']").val();
            // const kdbarang = $("input[name='kdbarangU").val();
            const totalharga = $("input[name='totalhargaU']").val();
            setLoadingU(true);
            resetValidU();

            if (tglpesan == "") {
                validasi('Tanggal Masuk wajib di isi!', 'warning');
                $("input[name='tglpesanU']").addClass('is-invalid');
                setLoading(Ufalse);
                return false;
            } else if (supplier == "") {
                validasi('Supplier wajib di pilih!', 'warning');
                $("select[name='supplierU']").addClass('is-invalid');
                setLoadingU(false);
                return false;
            } else if (status == "false") {
                validasi('Barang wajib di pilih!', 'warning');
                $("input[name='kdbarangU']").addClass('is-invalid');
                setLoadingU(false);
                return false;
            } else if (pesan_jumlah == "" || pesan_jumlah == "0") {
                validasi('Jumlah Masuk wajib di isi!', 'warning');
                $("input[name='pesan_jumlahU']").addClass('is-invalid');
                setLoading(false);
                return false;
            } else if (totalharga == "" || totalharga == "0") {
                validasi('Jumlah Masuk wajib di isi!', 'warning');
                $("input[name='totalhargaU']").addClass('is-invalid');
                setLoading(false);
                return false;
            } else {
                submitFormU();
            }
        }

        function submitFormU() {
            // const id = $("input[name='idbmU']").val();
            // const bmkode = $("input[name='bmkodeU']").val();
            // const tglmasuk = $("input[name='tglmasukU']").val();
            // const kdbarang = $("input[name='kdbarangU']").val();
            // const supplier = $("select[name='supplierU']").val();
            // const jml = $("input[name='jmlU']").val();

            const pbkode = $("input[name='pbkodeU']").val();
            const tglpesan = $("input[name='tglpesanU']").val();
            const kdbarang = $("input[name='kdbarangU']").val();
            const supplier = $("select[name='supplierU']").val();
            const pesan_jumlah = $("input[name='pesan_jumlahU']").val();
            const totalharga = $("input[name='totalhargaU']").val();

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/pemesanan-barang/proses_ubah') }}",
                enctype: 'multipart/form-data',
                data: {
                    pbkode: pbkode,
                    tglpesan: tglpesan,
                    barang: kdbarang,
                    supplier: supplier,
                    pesan_jumlah: pesan_jumlah,
                    totalharga: totalharga
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
            $("input[name='tglpesanU']").removeClass('is-invalid');
            $("input[name='kdbarangU']").removeClass('is-invalid');
            $("select[name='supplierU']").removeClass('is-invalid');
            $("input[name='jumlah_pesanU']").removeClass('is-invalid');
            $("input[name='totalhargaU']").removeClass('is-invalid');
        };

        function resetU() {
            resetValidU();
            $("input[name='pbkodeU']").val('');
            $("input[name='tglpesanU']").val('');
            $("input[name='kdbarangU']").val('');
            $("select[name='supplierU']").val('');
            $("input[name='jumlah_pesanU']").val('0');
            $("#nmbarang").val('');
            $("#satuan").val('');
            $("#jenis").val('');
            $("#merk").val('');
            $("#status").val('false');
            setLoading(false);

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
