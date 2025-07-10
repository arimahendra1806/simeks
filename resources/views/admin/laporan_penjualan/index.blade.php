@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">{{ $title }}</h2>
            </div>
        </div>
        <div class="table-responsive">
            <table id="data_table" class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama Pembeli</th>
                        <th>Tanggal</th>
                        <th>Total Produk</th>
                        <th>Total Pembelian</th>
                        <th>Total Terbayar</th>
                        <th>Fee CV + Pengiriman</th>
                        <th>Fee Supplier</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kode_transaksi }}</td>
                            <td>{{ $item->pembeli->nama . ' (' . $item->pembeli->perusahaan . ')' }}</td>
                            <td>
                                {{ date_to_indo($item->tanggal_pembelian) }}
                            </td>
                            <td>{{ $item->penjualanByProduk->count() }}</td>
                            <td>{{ format_currency($item->total_pembayaran) }}</td>
                            <td>{{ format_currency($item->total_terbayar) }}</td>
                            <td>{{ format_currency(
                                $item->penjualanByProduk->sum(function ($produk) {
                                    return $produk->total * ($produk->fee_cv / 100);
                                }) + $item->biaya_pengiriman,
                            ) }}
                            </td>
                            <td>{{ format_currency(
                                $item->penjualanByProduk->sum(function ($produk) {
                                    return $produk->total * (1 - $produk->fee_cv / 100);
                                }),
                            ) }}
                            </td>
                            <td>{{ $item->statusPenjualan->isi }}</td>
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
                },
                @if (session('role_id') == 3)
                    dom: 'Bfrtip',
                    // columnDefs: [{
                    //         targets: [0, 1],
                    //         visible: false
                    //     }
                    // ],
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Data Produk',
                            exportOptions: {
                                columns: ':not(.no-export)'
                            }
                        },
                        // {
                        //     extend: 'pdfHtml5',
                        //     title: 'Data Produk',
                        //     exportOptions: {
                        //         columns: ':not(.no-export)'
                        //     }
                        // },
                        // {
                        //     extend: 'csvHtml5',
                        //     title: 'Data Produk',
                        //     exportOptions: {
                        //         columns: ':not(.no-export)'
                        //     }
                        // },
                        // {
                        //     extend: 'print',
                        //     title: 'Data Produk',
                        //     exportOptions: {
                        //         columns: ':not(.no-export)'
                        //     }
                        // }
                    ]
                @endif
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
