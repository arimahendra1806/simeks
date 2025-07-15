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

        textarea.form-control.custom {
            height: auto !important;
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
                <div class="col-md-4 mb-3">
                    <label for="termin" class="form-label">Termin</label>
                    <input type="number" class="form-control" value="{{ old('termin', $penjualan->termin) }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="jasa_pengirim" class="form-label">Jasa Pengirim</label>
                    <input type="text" class="form-control"
                        value="{{ old('jasa_pengirim', $penjualan->jasa_pengirim) }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tipe_pengiriman" class="form-label">Tipe Pengiriman</label>
                    <select name="tipe_pengiriman" id="tipe_pengiriman"
                        class="form-control form-select edit-input js-select2" disabled>
                        <option value=""></option>
                        @foreach ($option_tipe_pengiriman as $item)
                            <option value="{{ $item->parameter }}"
                                {{ old('tipe_pengiriman', $penjualan->tipe_pengiriman) == $item->parameter ? 'selected' : '' }}>
                                {{ $item->isi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="biaya_pengiriman" class="form-label">Biaya Pengiriman<span
                            class="text-danger"></span></label>
                    <input type="text" class="form-control js-currency edit-input"
                        value="{{ old('biaya_pengiriman', format_currency($penjualan->biaya_pengiriman)) }}" disabled>
                    @error('biaya_pengiriman')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div
                    class="col-md-12 mb-3 container-biaya-pengiriman {{ old('tipe_pengiriman', $penjualan->tipe_pengiriman) == 1 ? 'd-none' : '' }}">
                    <label class="form-label">Rincian Biaya Pengiriman</label>
                    <div id="biaya-dinamis-wrapper">
                        @php
                            $detail_kirim = json_decode($penjualan->detail_kirim);
                            is_array($detail_kirim) || ($detail_kirim = []);
                        @endphp
                        @foreach ($detail_kirim as $key => $value)
                            <div class="row mb-2 biaya-item">
                                <div class="col-md-3">
                                    <input type="text" name="biaya_detail[{{ $key }}][nama]"
                                        class="form-control edit-input" placeholder="Nama Biaya (mis. Ongkir Lokal)"
                                        value="{{ $value->nama }}" readonly>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="biaya_detail[{{ $key }}][nominal]"
                                        class="form-control js-currency nominal-biaya edit-input" placeholder="Nominal"
                                        value="{{ $value->nominal }}" readonly>
                                </div>
                                <div class="col-md-6">
                                    <textarea name="biaya_detail[{{ $key }}][keterangan]" class="form-control custom edit-input" cols="1"
                                        rows="2" disabled>{{ $value->keterangan ?? '-' }}</textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
                                @php
                                    $counter_termin = 0;
                                @endphp
                                @foreach ($bayar as $item)
                                    <tr>
                                        <td>{{ $item->kode_bayar }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                        <td>
                                            @php
                                                $status_now = $item->transaction_midtrans_status ?? '-';
                                                if ($status_now == 'settlement') {
                                                    $counter_termin++;
                                                }

                                                echo $item->statusKategori->isi . ' ' . $counter_termin;

                                                if ($status_now == 'settlement') {
                                                    $counter_termin++;
                                                }
                                            @endphp
                                        </td>
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
                            <div class="col-md-6 mb-3">
                                <label for="termin" class="form-label">Termin</label>
                                <input type="text" class="form-control" value="{{ $penjualan->termin }}" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="sisa_termin" class="form-label">Sisa Termin</label>
                                <input type="text" class="form-control"
                                    value="{{ $penjualan->termin - $bayar->where('transaction_midtrans_status', 'settlement')->count() }}"
                                    readonly>
                            </div>
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
                            @php
                                $must_termin = 0;
                                if ($bayar->where('transaction_midtrans_status', 'settlement')->count() == 1) {
                                    $must_termin = format_currency($penjualan->sisa_pembayaran);
                                }
                            @endphp
                            <div class="col-md-12 mb-3">
                                <label for="nominal" class="form-label">Nominal <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text"
                                    class="form-control js-currency @error('nominal') is-invalid @enderror"
                                    placeholder="Masukkan nominal..." id="nominal" name="nominal"
                                    value="{{ old('nominal', $must_termin) }}"
                                    {{ $must_termin != 0 ? 'readonly' : 'required' }}>
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
                        <button type="button" onclick="generate()" class="btn btn-primary">
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
