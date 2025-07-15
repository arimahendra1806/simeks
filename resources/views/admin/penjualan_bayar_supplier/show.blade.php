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

    @php
        $pendapatan = $penjualan->penjualanByProduk->sum(function ($produk) {
            return $produk->total * (1 - $produk->fee_cv / 100);
        });
        $total_pendapatan = $penjualan->penjualanByBayar
            ->where('tipe_pembayaran', 2)
            ->where('transaction_midtrans_status', 'settlement')
            ->sum('nominal');
        $sisa_pendapatan = $pendapatan - $total_pendapatan;

        $dataPerPemasok = [];
        $groupedByPemasok = $produk->groupBy(function ($item) {
            return $item->produk->pemasok->id ?? 'tanpa_pemasok';
        });
        foreach ($groupedByPemasok as $pemasokId => $items) {
            $pemasokId = optional($items->first()->produk->pemasok)->id ?? 0;
            $pemasokNama = optional($items->first()->produk->pemasok)->perusahaan ?? 'Tanpa Pemasok';

            $totalPendapatan = $items->sum(function ($item) {
                return $item->total * (1 - $item->fee_cv / 100);
            });

            // Ambil pembayaran yang relevan (tipe 2 dan settlement)
            $bayarPemasok = $bayar->whereIn('penjualan_by_produk_id', $items->pluck('id'));

            $totalBayar = $bayarPemasok->where('transaction_midtrans_status', 'settlement')->sum('nominal');

            $sisaBayar = $totalPendapatan - $totalBayar;

            $dataPerPemasok[] = [
                'id' => $pemasokId,
                'pemasok' => $pemasokNama,
                'total_pendapatan' => $totalPendapatan,
                'total_bayar' => $totalBayar,
                'sisa_bayar' => $sisaBayar,
            ];
        }
    @endphp

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Detail {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route(request()->segment(1) . '.pay_supplier.index') }}"
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
                    <label for="kode_transaksi" class="form-label">Total Bayar (BUYER)</label>
                    <input type="text" class="form-control" value="{{ format_currency($penjualan->total_terbayar) }}"
                        disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Sisa Bayar (BUYER)</label>
                    <input type="text" class="form-control" value="{{ format_currency($penjualan->sisa_pembayaran) }}"
                        disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Total Pendapatan (SUPPLIER)</label>
                    <input type="text" class="form-control" value="{{ format_currency($pendapatan) }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Total Bayar (SUPPLIER)</label>
                    <input type="text" class="form-control" value="{{ format_currency($total_pendapatan) }}" disabled>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="kode_transaksi" class="form-label">Sisa Bayar (SUPPLIER)</label>
                    <input type="text" class="form-control" value="{{ format_currency($sisa_pendapatan) }}" disabled>
                </div>
                <div class="col-md-12 mb-3">
                    <label class="form-label">Pendapatan Supplier</label>
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Pemasok</th>
                                    <th>Total Pendapatan</th>
                                    <th>Total Bayar</th>
                                    <th>Sisa Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataPerPemasok as $data)
                                    <tr>
                                        <td>{{ $data['pemasok'] }}</td>
                                        <td>Rp {{ number_format($data['total_pendapatan'], 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($data['total_bayar'], 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($data['sisa_bayar'], 0, ',', '.') }}</td>
                                        <td>
                                            {{-- Tambahkan tombol aksi jika perlu --}}
                                            <a href="#" class="btn btn-primary btn_add btn-sm"
                                                data-id="{{ $data['id'] }}" data-pemasok="{{ $data['pemasok'] }}"
                                                data-sisa="{{ format_currency($data['sisa_bayar']) }}"><i
                                                    class="fa fa-money mr-2"></i>
                                                Transfer</a>
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($produk->count() == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <h2>Belum ada data</h2>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-12 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <label for="deskripsi" class="form-label">Riwayat Pembayaran</label>
                        {{-- @if ($penjualan->sisa_pembayaran > 0)
                            <a href="javascript:void(0)" class="btn btn-info btn-sm btn_add disabled_btn">
                                <i class="fa fa-plus mr-2"></i> Tambah
                            </a>
                        @endif --}}
                    </div>
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Bayar</th>
                                    <th>Pemasok</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Nominal</th>
                                    <th>Status</th>
                                    <th>Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bayar as $item)
                                    <tr>
                                        <td>{{ $item->kode_bayar }}</td>
                                        <td>{{ $item->pemasok->perusahaan }}</td>
                                        <td>{{ date('d-m-Y H:i', strtotime($item->created_at)) }}</td>
                                        <td>{{ $item->statusKategori->isi }}</td>
                                        <td>{{ format_currency($item->nominal) }}</td>
                                        <td>{{ $item->transaction_midtrans_status ?? '-' }}</td>
                                        <td>
                                            @if ($item->foto)
                                                <a href="javascript:void(0);" class="btn btn-primary btn-sm open-gallery"
                                                    data-id="{{ $item->id }}"><i class="fa fa-image mr-2"></i>
                                                    Foto Pembayaran
                                                </a>

                                                <!-- Hidden div untuk menyimpan semua gambar produk -->
                                                <div class="pembayaran-gallery-{{ $item->id }}" style="display: none;">
                                                    <a href="{{ asset('assets/uploads/pembayaran/' . $item->foto) }}"
                                                        class="glightbox" data-gallery="gallery-{{ $item->id }}"
                                                        data-title="{{ $item->name }}">
                                                        <img src="{{ asset('assets/uploads/pembayaran/' . $item->foto) }}"
                                                            width="50" style="display: none;">
                                                    </a>
                                                </div>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach

                                @if ($bayar->count() == 0)
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

                @if (session('role_id') == 3)
                    {{-- <div class="col-md-12">
                        <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                                class="bi bi-arrow-bar-left mr-2"></i>Tutup</button>
                        <button class="btn btn-warning float-right btn_edit"><i class="fa fa-edit mr-2"></i>Edit</button>
                    </div> --}}
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
                        Transfer Pembayaran
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route(request()->segment(1) . '.pay_supplier.generate_tagihan') }}" id="form_tagihan"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" id="id_penjualan" name="id_penjualan" value="{{ $penjualan->id }}">
                        <input type="hidden" id="id_pemasok" name="id_pemasok" value="0">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="nama_pemasok" class="form-label">Pemasok <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text" class="form-control" placeholder="Masukkan nama..."
                                    id="nama_pemasok" readonly>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="sisa_pembayaran" class="form-label">Sisa Pembayaran <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text"
                                    class="form-control js-currency @error('sisa_pembayaran') is-invalid @enderror"
                                    placeholder="Masukkan sisa_pembayaran..." id="sisa_pembayaran" name="sisa_pembayaran"
                                    value="{{ old('sisa_pembayaran', format_currency($sisa_pendapatan)) }}" readonly>
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
                            <div class="col-md-12 mb-3">
                                <label for="file" class="form-label">Foto Pembayaran</label>
                                <input type="file" class="form-control @error('file') is-invalid @enderror"
                                    placeholder="Masukkan file..." id="file" name="file" accept="image/*">
                                @error('file')
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

        $('.btn_add').click(function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let pemasok = $(this).data('pemasok');
            let sisa = $(this).data('sisa');

            $('#id_pemasok').val(id);
            $('#nama_pemasok').val(pemasok);
            $('#sisa_pembayaran').val(sisa);

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

        const lightbox = GLightbox({
            selector: '.glightbox'
        });

        // Event untuk membuka gallery saat tombol diklik
        document.querySelectorAll('.open-gallery').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const productId = this.getAttribute('data-id');
                document.querySelectorAll(`.pembayaran-gallery-${productId} a`)[0]
                    .click(); // Membuka gambar pertama dari galeri
            });
        });
    </script>
@endpush
