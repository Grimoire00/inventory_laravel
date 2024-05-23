<!-- MODAL HAPUS -->
<div class="modal fade" data-bs-backdrop="static" id="Kmodaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <form class="modal-body text-center p-4 pb-5" id="form-action-konfimasi-pemesanan" method="POST"
                action="{{ route('konfirmasi-pemesanan.konfirmasiPemesanan') }}" onsubmit="submitFormKonfirmasi()">
                @csrf
                <button type="reset" aria-label="Close" onclick="resetKonfirmasi()"
                    class="btn-close position-absolute" data-bs-dismiss="modal"><span
                        aria-hidden="true">×</span></button>
                <br>
                <i class="icon icon-exclamation fs-70 text-warning lh-1 my-5 d-inline-block"></i>
                <h3 class="mb-5">Konfirmasi <span id="konfirmasi-action-button"></span> Status <span
                        id="konfirmasi-status-pesanan"></span> Konfirmasi Pemesanan
                    <span id="konfirmasi-id-status-pesanan"></span> ?
                </h3>
                <input type="hidden" name="konfirmasi_pesanan_id" id="konfirmasi_pesanan_id">
                <input type="hidden" name="konfirmasi_action" id="konfirmasi_action">
                <button class="btn btn-danger-light pd-x-25 d-none" id="btnLoaderKonfirmasi" type="button"
                    disabled="">
                    <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                    Loading...
                </button>
                <button class="btn btn-danger-light pd-x-25" id="btnSubmitKonfirmasi" type="submit">Konfirmasi</button>
                <button type="reset" data-bs-dismiss="modal" class="btn btn-default pd-x-25">Batal</button>
            </form>
        </div>
    </div>
</div>

<script>
    // document ready
    $(document).ready(function() {
        function submitFormKonfirmasi(e) {
            // get id form
            // e.preventDefault();
            console.log("ke klik");
            setLoadingKonfirmasi(true);
            const id_pesanan = $("input[name='konfirmasi_pesanan_id']").val();
            const pesanan_action = $("input[name='konfirmasi_action']").val();
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/konfirmasi-pemesanan/proses-konfirmasi') }}",
                data: {
                    id_pesanan: id_pesanan,
                    pesanan_action: pesanan_action
                }
                success: function(data) {
                    swal({
                        title: "Berhasil dihapus!",
                        type: "success"
                    });
                    $('#Kmodaldemo9').modal('toggle');
                    table.ajax.reload(null, false);
                    resetKonfirmasi();
                }
            });
        }

        function resetKonfirmasi() {
            const id_pesanan = $("input[name='konfirmasi_pesanan_id']").val('');
            const pesanan_action = $("input[name='konfirmasi_action']").val('');
            setLoadingKonfirmasi(false);
        }

        function setLoadingKonfirmasi(bool) {
            if (bool == true) {
                $('#btnLoaderKonfirmasi').removeClass('d-none');
                $('#btnSubmitKonfirmasi').addClass('d-none');
            } else {
                $('#btnSubmitKonfirmasi').removeClass('d-none');
                $('#btnLoaderKonfirmasi').addClass('d-none');
            }
        }
    })
</script>
