@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h2 class="text-blue mb-4">{{ $title }}</h2>
                <h4 class="mt-2">Selamat Datang {{ session('user_name') }}</h4>
            </div>
        </div>
    </div>
    <div class="row pb-10">
        @if (session('role_id') == '1')
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $total_produk }}</div>
                            <div class="font-14 text-secondary weight-500">
                                Total Produk
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#00eccf" style="color: rgb(0, 236, 207);">
                                <i class="icon-copy dw dw-package"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $total_pemasok }}</div>
                            <div class="font-14 text-secondary weight-500">
                                Total Pemasok
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#ff5b5b" style="color: rgb(255, 91, 91);">
                                <span class="icon-copy ti-user"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $total_pembeli }}</div>
                            <div class="font-14 text-secondary weight-500">
                                Total Pembeli
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy fa fa-user" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (session('role_id') == '3')
            <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">{{ $total_transaksi }}</div>
                            <div class="font-14 text-secondary weight-500">Total Transaksi</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon" data-color="#09cc06" style="color: rgb(9, 204, 6);">
                                <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if (session('role_id') == '1')
        <div class="pd-20 card-box mb-30">
            <h3>Data Produk & Pemasok</h3>
            <div class="table-responsive">
                <table id="data_produk" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pemasok</th>
                            <th>Nama Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produk as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pemasok->nama . ' (' . $item->pemasok->perusahaan . ')' }}</td>
                                <td>{{ $item->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if (session('role_id') == '2')
        <div class="pd-20 card-box mb-30">
            <h3>Data Penjualan</h3>
            <div class="table-responsive">
                <table id="data_penjualan" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Pembeli</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_transaksi }}</td>
                                <td>{{ $item->pembeli->nama . ' (' . $item->pembeli->perusahaan . ')' }}</td>
                                <td>
                                    Negosiasi : {{ date_to_indo($item->tanggal_negosiasi) }} <br>
                                    Pembelian : {{ date_to_indo($item->tanggal_pembelian) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    @if (session('role_id') != '5')
        <div class="pd-20 card-box mb-30 {{ session('role_id') == '1' ? 'd-none' : '' }}">
            <canvas id="grafikNominal" width="400" height="200"></canvas>
        </div>
        <div class="pd-20 card-box mb-30 {{ session('role_id') != '3' ? 'd-none' : '' }}">
            <canvas id="grafikJumlah" width="400" height="200"></canvas>
        </div>
        <div class="pd-20 card-box mb-30">
            <canvas id="grafikProduk" width="400" height="200"></canvas>
        </div>
        <div class="pd-20 card-box mb-30">
            <h3>Pembeli Paling Sering Beli</h3>
            <div class="table-responsive">
                <table id="data_pembeli" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>Total Pembelian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pembelian as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->pembeli->nama . ' (' . $item->pembeli->perusahaan . ')' }}</td>
                                <td>{{ $item->total ?: '0' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="pd-20 card-box mb-30">
            <canvas id="grafikPendapatanSupplier" width="400" height="200"></canvas>
        </div>
        <div class="pd-20 card-box mb-30">
            <h3>Daftar Pesanan</h3>
            <div class="table-responsive">
                <table id="data_table_pendapatan_supplier" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Transaksi</th>
                            <th>Nama Pembeli</th>
                            <th>Tanggal</th>
                            <th>Total Produk</th>
                            <th>Total Pendapatan</th>
                            <th>Sisa Pendapatan <br> (BELUM BAYAR)</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tabelPendapatanSupplier as $item)
                            @php
                                $pendapatan = $item->penjualanByProduk->sum(function ($produk) {
                                    return $produk->total * (1 - $produk->fee_cv / 100);
                                });

                                $total_pendapatan = $item->penjualanByBayar
                                    ->where('tipe_pembayaran', 2)
                                    ->where('transaction_midtrans_status', 'settlement')
                                    ->sum('nominal');

                                $sisa_pendapatan = $pendapatan - $total_pendapatan;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->kode_transaksi }}</td>
                                <td>{{ $item->pembeli->nama . ' (' . $item->pembeli->perusahaan . ')' }}</td>
                                <td>
                                    {{ date_to_indo($item->tanggal_pembelian) }}
                                </td>
                                <td>{{ $item->penjualanByProduk->count() }}</td>
                                <td>{{ format_currency($pendapatan) }}</td>
                                <td>{{ format_currency($sisa_pendapatan) }}</td>
                                <td>{{ $item->statusPenjualan->isi }}</td>
                                <td>
                                    <a href="{{ route(request()->segment(1) . '.dashboard.show_supplier', $item->id) }}"
                                        class="btn btn-primary btn-sm">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection

@push('js')
    <script>
        let labelPendapatanSupplier = {!! json_encode($labelJumlah) !!};
        let dataPendapatanSupplier = {!! json_encode($dataPendapatanSupplier) !!};

        let ctxJPendapantaSupplier = document.getElementById('grafikPendapatanSupplier')?.getContext('2d');
        let chartPendapatanSupplier = new Chart(ctxJPendapantaSupplier, {
            type: 'bar',
            data: {
                labels: labelPendapatanSupplier,
                datasets: [{
                    label: 'Total Pendapatan Supplier (Jumlah Tahun ' + new Date().getFullYear() + ')',
                    data: dataPendapatanSupplier,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        onClick: () => {},
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        }
                    }
                }
            }
        });

        let labelJumlahProduk = {!! json_encode($dataLabelProduk) !!};
        let dataJumlahProduk = {!! json_encode($dataJumlahProduk) !!};

        let ctxJumlahProduk = document.getElementById('grafikProduk')?.getContext('2d');
        let chartJumlahProduk = new Chart(ctxJumlahProduk, {
            type: 'bar',
            data: {
                labels: labelJumlahProduk,
                datasets: [{
                    label: '5 Produk Terlaris (Jumlah Tahun ' + new Date().getFullYear() + ')',
                    data: dataJumlahProduk,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        onClick: () => {},
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        }
                    }
                }
            }
        });

        let labelJumlah = {!! json_encode($labelJumlah) !!};
        let dataJumlah = {!! json_encode($dataJumlah) !!};

        let ctxJumlah = document.getElementById('grafikJumlah')?.getContext('2d');
        let chartJumlah = new Chart(ctxJumlah, {
            type: 'bar',
            data: {
                labels: labelJumlah,
                datasets: [{
                    label: 'Total Penjualan (Jumlah Tahun ' + new Date().getFullYear() + ')',
                    data: dataJumlah,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        onClick: () => {},
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        }
                    }
                }
            }
        });

        let labelNominal = {!! json_encode($labelJumlah) !!};
        let dataNominal = {!! json_encode($dataNominal) !!};

        let ctxNominal = document.getElementById('grafikNominal')?.getContext('2d');
        let chartNominal = new Chart(ctxNominal, {
            type: 'bar',
            data: {
                labels: labelNominal,
                datasets: [{
                    label: 'Total Penjualan (Nominal Tahun ' + new Date().getFullYear() + ')',
                    data: dataNominal,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        onClick: () => {},
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                        }
                    }
                }
            }
        });

        $(document).ready(function() {
            var table = $('#data_produk').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                },
            });
            var table2 = $('#data_penjualan').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                },
            });
            var table3 = $('#data_pembeli').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                },
            });
            var table4 = $('#data_table_pendapatan_supplier').DataTable({
                oLanguage: {
                    sUrl: "/assets/js/datatable_id.json"
                },
            });
        });
    </script>
@endpush
