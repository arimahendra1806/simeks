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
                <a href="{{ route(request()->segment(1) . '.pengiriman.index') }}"
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
                                    <th>No</th>
                                    <th>Ekspedisi</th>
                                    <th>Tanggal</th>
                                    <th>Driver</th>
                                    <th>Status</th>
                                    <th style="width: 20%">Alamat</th>
                                    <th style="width: 20%">Keterangan</th>
                                    <th style="width: 20%">Link Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengiriman as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->ekspedisi }}</td>
                                        <td>{{ date_to_indo($item->tanggal_pengiriman) }}</td>
                                        <td>
                                            Nama : <br> {{ $item->nama_driver }} <br>
                                            Telepon : <br> {{ $item->telepon_driver }}
                                        </td>
                                        <td>{{ $item->statusPengiriman->isi }}</td>
                                        <td>
                                            <b>Alamat Awal</b> : <br> {{ $item->alamat_mulai ?? '-' }} <br>
                                            <b>Alamat Tujuan</b> : <br> {{ $item->alamat_selesai ?? '-' }}
                                        </td>
                                        <td style="width: 30%">{{ $item->keterangan ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('status_shipment', encrypt_64($item->id)) }}"
                                                class="btn btn-warning btn-sm w-100 mt-1" target="_blank">
                                                <i class="fa fa-link mr-2"></i> Cek Langsung
                                            </a>
                                            <a href="javascript:void(0)"
                                                data-url="{{ route('status_shipment', encrypt_64($item->id)) }}"
                                                class="btn btn-info btn-sm w-100 mt-1 copy-btn">
                                                <i class="fa fa-info mr-2"></i> Copy Link
                                            </a>
                                            @if ($item->status_pengiriman != 9)
                                                <form
                                                    action="{{ route(request()->segment(1) . '.pengiriman.confirm_wa', $item->id) }}"
                                                    method="POST" style="display:inline;"
                                                    id="confirm-wa-form-{{ $item->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-success btn-sm w-100 mt-1"
                                                        onclick="confirm_wa({{ $item->id }})">
                                                        <i class="fa fa-whatsapp mr-2"></i> Kirim Wa
                                                    </button>
                                                </form>
                                            @endif
                                            <?php
                                            $is_alamat = $item->alamat_mulai && $item->alamat_selesai ? true : false;
                                            ?>
                                            <a href="{{ $is_alamat ? 'https://www.google.com/maps/dir/?api=1&origin=' . urlencode($item->alamat_mulai) . '&destination=' . urlencode($item->alamat_selesai) : 'javascript:void(0)' }}"
                                                {{ $is_alamat ? 'target="_blank"' : '' }}
                                                class="btn btn-dark btn-sm w-100 mt-1">
                                                <i class="fa fa-map mr-2"></i> Cek Lokasi
                                            </a>
                                            @if ($item->status_pengiriman != 9)
                                                <form
                                                    action="{{ route(request()->segment(1) . '.pengiriman.destroy', $item->id) }}"
                                                    method="POST" style="display:inline;"
                                                    id="delete-form-{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger btn-sm w-100 mt-1"
                                                        onclick="confirm_delete({{ $item->id }})">
                                                        <i class="fa fa-trash mr-2"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($pengiriman->count() == 0)
                                    <tr>
                                        <td colspan="7" rowspan="2" class="text-center">
                                            <h2>Belum ada data</h2>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                @if (session('role_id') != 2)
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
                        Generate Pengiriman
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route(request()->segment(1) . '.pengiriman.generate_kirim') }}" id="form_pengiriman"
                    method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" id="id_penjualan" name="id_penjualan" value="{{ $penjualan->id }}">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="ekspedisi" class="form-label">Expedisi <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text" class="form-control @error('ekspedisi') is-invalid @enderror"
                                    placeholder="Masukkan ekspedisi..." id="ekspedisi" name="ekspedisi"
                                    value="{{ old('ekspedisi') }}">
                                @error('ekspedisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="tanggal_pengiriman" class="form-label">Tanggal <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text"
                                    class="form-control date-pickers @error('tanggal_pengiriman') is-invalid @enderror"
                                    placeholder="Masukkan tanggal_pengiriman..." id="tanggal_pengiriman"
                                    name="tanggal_pengiriman" value="{{ old('tanggal_pengiriman') }}" readonly>
                                @error('tanggal_pengiriman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama_driver" class="form-label">Nama Driver <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text" class="form-control @error('nama_driver') is-invalid @enderror"
                                    placeholder="Masukkan nama_driver..." id="nama_driver" name="nama_driver"
                                    value="{{ old('nama_driver') }}">
                                @error('nama_driver')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="telepon_driver" class="form-label">Telepon Driver <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text" class="form-control @error('telepon_driver') is-invalid @enderror"
                                    placeholder="Masukkan telepon_driver..." id="telepon_driver" name="telepon_driver"
                                    value="{{ old('telepon_driver') }}">
                                @error('telepon_driver')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="alamat_mulai" class="form-label">Alamat Awal <span
                                        class="text-danger"><small>*</small></span></label>
                                <textarea class="form-control @error('alamat_mulai') is-invalid @enderror" placeholder="Masukkan alamat awal..."
                                    id="alamat_mulai" name="alamat_mulai" cols="1" rows="5">{{ old('alamat_mulai', $data_alamat) }}</textarea>
                                @error('alamat_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="alamat_selesai" class="form-label">Alamat Tujuan <span
                                        class="text-danger"><small>*</small></span></label>
                                <textarea class="form-control @error('alamat_selesai') is-invalid @enderror" placeholder="Masukkan alamat tujuan..."
                                    id="alamat_selesai" name="alamat_selesai" cols="1" rows="5">{{ old('alamat_selesai') }}</textarea>
                                @error('alamat_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="keterangan" class="form-label">Keterangan <span
                                        class="text-danger"><small>*</small></span></label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" placeholder="Masukkan keterangan..."
                                    id="keterangan" name="keterangan" cols="1" rows="5">{{ old('keterangan') }}</textarea>
                                @error('keterangan')
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
                text: "Data status pengiriman ini akan di generate!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjut!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form_pengiriman').submit();
                }
            });
        }

        function confirm_delete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form-' + id).submit();
                }
            });
        }

        function confirm_wa(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dikirim sesuai nomor Telepon!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Kirim!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#confirm-wa-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
