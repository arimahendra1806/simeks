@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">{{ $title }}</h2>
            </div>
            @if (session('role_id') != 1)
                <div class="pull-right">
                    <a href="{{ route(request()->segment(1) . '.penjualan.create') }}"
                        class="btn btn-primary btn-sm ml-2 float-right">
                        <i class="fa fa-plus mr-2"></i> Tambah Data
                    </a>
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table id="data_table" class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal</th>
                        <th>Total Pembelian</th>
                        <th>Total Produk</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_transaksi }}</td>
                            <td>{{ $item->pembeli->nama . ' (' . $item->pembeli->perusahaan . ')' }}</td>
                            <td>
                                Negosiasi : {{ date_to_indo($item->tanggal_negosiasi) }} <br>
                                Pembelian : {{ date_to_indo($item->tanggal_pembelian) }}
                            </td>
                            <td>{{ format_currency($item->total_pembayaran) }}</td>
                            <td>{{ $item->penjualanByProduk->count() }}</td>
                            <td>{{ $item->statusPenjualan->isi }}</td>
                            <td>
                                @if (session('role_id') == 3 && $item->status == 1)
                                    <form action="{{ route(request()->segment(1) . '.penjualan.konfirmasi', $item->id) }}"
                                        method="POST" style="display:inline;" id="konfirmasi-form-{{ $item->id }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn btn-success btn-sm mt-1"
                                            onclick="confirm_konfirmasi({{ $item->id }})">
                                            <i class="fa fa-check mr-2"></i> Konfirmasi
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route(request()->segment(1) . '.penjualan.show', $item->id) }}"
                                    class="btn btn-info btn-sm mt-1">
                                    <i class="fa fa-info mr-2"></i> Detail
                                </a>
                                @if (session('role_id') != 1)
                                    <form action="{{ route(request()->segment(1) . '.penjualan.destroy', $item->id) }}"
                                        method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm mt-1"
                                            onclick="confirm_delete({{ $item->id }})">
                                            <i class="fa fa-trash mr-2"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var table = $('#data_table').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                }
            })
        });

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

        function confirm_konfirmasi(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dikonfirmasi dan lanjut ke dokumen ekspor!",
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
    </script>
@endpush
