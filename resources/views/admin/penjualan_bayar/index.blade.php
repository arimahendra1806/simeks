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
                        <th>Total Pembelian</th>
                        <th>Total Pembayaran</th>
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
                            <td>
                                Total Bayar : <br> {{ format_currency($item->total_terbayar) }} <br>
                                Sisa Bayar : <br> {{ format_currency($item->sisa_pembayaran) }}
                            </td>
                            <td>{{ $item->statusPenjualan->isi }}</td>
                            <td>
                                <a href="{{ route(request()->segment(1) . '.pembayaran.show', $item->id) }}"
                                    class="btn btn-info btn-sm w-100 mt-1">
                                    <i class="fa fa-info mr-2"></i> Detail
                                </a>
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
    </script>
@endpush
