@extends('template.admin')

@section('content')
    <style>
        .disabled_btn {
            pointer-events: none;
            /* Mencegah klik */
            opacity: 0.6;
            /* Membuat tampilan lebih redup */
            cursor: not-allowed;
            /* Mengubah cursor menjadi tanda larangan */
        }
    </style>

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Detail {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route(request()->segment(1) . '.pembayaran.index') }}"
                    class="btn btn-secondary mr-2 float-right"><i class="fa fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="kode_transaksi" class="form-label">Kode Transaksi</label>
                    <input type="text" class="form-control" value="{{ $penjualan->kode_transaksi }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Nama Pembeli</label>
                    <input type="text" class="form-control" value="{{ $penjualan->pembeli->nama }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Email Pembeli</label>
                    <input type="text" class="form-control" value="{{ $penjualan->pembeli->email }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Telepon Pembeli</label>
                    <input type="text" class="form-control" value="{{ $penjualan->pembeli->telepon }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Total Belanja</label>
                    <input type="text" class="form-control" value="{{ format_currency($penjualan->total_pembayaran) }}"
                        disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Total Bayar</label>
                    <input type="text" class="form-control" value="{{ format_currency($penjualan->total_terbayar) }}"
                        disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Sisa Bayar</label>
                    <input type="text" class="form-control" value="{{ format_currency($penjualan->sisa_pembayaran) }}"
                        disabled>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <label for="deskripsi" class="form-label">Riwayat Pembayaran</label>
                        @if ($penjualan->sisa_pembayaran > 0)
                            <a href="javascript:void(0)" class="btn btn-info btn-sm btn_add disabled_btn">
                                <i class="fa fa-plus mr-2"></i> Tambah
                            </a>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Bayar</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Link Bayar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bayar as $item)
                                    <tr>
                                        <td>{{ $item->kode_bayar }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->statusKategori->isi }}</td>
                                        <td>{{ format_currency($item->nominal) }}</td>
                                        <td>{{ $item->transaction_midtrans_status ?? '-' }}</td>
                                        @if ($item->transaction_midtrans_status == '')
                                            <td>
                                                <a href="javascript:void(0)"
                                                    data-url="{{ route('invoice_pay', encrypt_64($item->id)) }}"
                                                    class="btn btn-info btn-sm w-100 mt-1 copy-btn">
                                                    <i class="fa fa-info mr-2"></i> Copy
                                                </a>
                                            </td>
                                        @else
                                            <td>-</td>
                                        @endif
                                    </tr>
                                @endforeach

                                @if ($bayar->count() == 0)
                                    <tr>
                                        <td colspan="6" rowspan="2" class="text-center">
                                            <h2>Belum ada data</h2>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (session('role_id') == 3)
                    <div class="col-md-12">
                        <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                                class="bi bi-arrow-bar-left mr-2"></i>Tutup</button>
                        <button class="btn btn-warning float-right btn_edit"><i class="fa fa-edit mr-2"></i>Edit</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg show" id="modal_generate" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Generate Tagihan
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route(request()->segment(1) . '.pembayaran.generate_tagihan') }}" id="form_tagihan"
                    method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" id="id_penjualan" name="id_penjualan" value="{{ $penjualan->id }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="sisa_pembayaran" class="form-label">Sisa Pembayaran <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text"
                                    class="form-control js-currency @error('sisa_pembayaran') is-invalid @enderror"
                                    placeholder="Masukkan sisa_pembayaran..." id="sisa_pembayaran" name="sisa_pembayaran"
                                    value="{{ old('sisa_pembayaran', format_currency($penjualan->sisa_pembayaran)) }}"
                                    readonly>
                                @error('sisa_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="nominal" class="form-label">Nominal <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text"
                                    class="form-control js-currency @error('nominal') is-invalid @enderror"
                                    placeholder="Masukkan nominal..." id="nominal" name="nominal"
                                    value="{{ old('nominal') }}" required>
                                @error('nominal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            Tutup
                        </button>
                        <button type="submit" onclick="generate()" class="btn btn-primary">
                            Tambahkan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('.copy-btn').click(function() {
                var url = $(this).data('url');
                var tempInput = $('<input>');
                $('body').append(tempInput);
                tempInput.val(url).select();
                document.execCommand('copy');
                tempInput.remove();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Link berhasil disalin',
                });
            });
        });

        $('.btn_add').click(function() {
            $('#modal_generate').modal('show');
        });

        $('.btn_edit').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('d-none');
            $('.btn_cancel').removeClass('d-none');
            $('.btn_add').removeClass('disabled_btn');
        });

        $('.btn_cancel').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('d-none');
            $('.btn_edit').removeClass('d-none');
            $('.btn_add').addClass('disabled_btn');
        });

        function generate() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data tagihan ini akan di generate!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjut!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form_tagihan').submit();
                }
            });
        }
    </script>
@endpush
