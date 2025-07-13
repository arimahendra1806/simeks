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
    @endphp

    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Detail {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route(request()->segment(1) . '.dashboard.index') }}"
                    class="btn btn-secondary mr-2 float-right"><i class="fa fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
        <div>
            <div class="row">
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
                    <div class="d-flex justify-content-between mb-2">
                        <label for="deskripsi" class="form-label">Daftar Produk</label>
                    </div>
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Satuan</th>
                                    <th>Kuantitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->produk->nama }}</td>
                                        <td>{{ $item->satuan->nama }}</td>
                                        <td>{{ $item->kuantitas }}</td>
                                    </tr>
                                @endforeach

                                @if ($produk->count() == 0)
                                    <tr>
                                        <td colspan="3" rowspan="2" class="text-center">
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
                                    <th>Foto</th>
                                    <th>Aksi</th>
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
                                        <td>
                                            @if ($item->transaction_midtrans_status != 'settlement')
                                                <form
                                                    action="{{ route(request()->segment(1) . '.dashboard.konfirmasi_supplier', $item->id) }}"
                                                    method="POST" style="display:inline;"
                                                    id="konfirmasi-form-{{ $item->id }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="button" class="btn btn-success btn-sm mt-1"
                                                        onclick="confirm_konfirmasi({{ $item->id }})">
                                                        <i class="fa fa-check mr-2"></i> Konfirmasi
                                                    </button>
                                                </form>
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
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {});

        function confirm_konfirmasi(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dikonfirmasi dan pembayaran sudah dipastikan diterima!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjut!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#konfirmasi-form-' + id).submit();
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
