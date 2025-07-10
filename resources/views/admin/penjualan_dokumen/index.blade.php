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
                            <td>{{ $item->penjualanByProduk->count() }} Produk</td>
                            <td>
                                {{ $item->statusPenjualan->isi }}
                                @if ($item->status_dokumen == 2)
                                    <br>
                                    <span class="text-danger">TUNDA : {{ $item->note_dokumen }}</span>
                                @endif
                            </td>
                            <td>
                                @if (session('role_id') == 3 && $item->status == 2 && $item->penjualanByDokumen->count() > 0)
                                    <form
                                        action="{{ route(request()->segment(1) . '.dokumen_penjualan.konfirmasi', $item->id) }}"
                                        method="POST" style="display:inline;" id="konfirmasi-form-{{ $item->id }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn btn-success btn-sm mt-1"
                                            onclick="confirm_konfirmasi({{ $item->id }})">
                                            <i class="fa fa-check mr-2"></i> Konfirmasi
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-warning btn-sm mt-1 btn_tunda"
                                        data-id={{ $item->id }}>
                                        <i class="fa fa-hourglass mr-2"></i> Tunda Dokumen
                                        <div class="data-tunda-{{ $item->id }} d-none">
                                            {{ $item->note_dokumen }}
                                        </div>
                                    </button>
                                @endif
                                @if (session('role_id') == 3 &&
                                        $item->status == 2 &&
                                        $item->status_dokumen == 2 &&
                                        $item->penjualanByDokumen->count() > 0)
                                    <form
                                        action="{{ route(request()->segment(1) . '.dokumen_penjualan.batal', $item->id) }}"
                                        method="POST" style="display:inline;" id="batal-form-{{ $item->id }}">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" class="btn btn-danger btn-sm mt-1"
                                            onclick="confirm_batal({{ $item->id }})">
                                            <i class="fa fa-times mr-2"></i> Batalkan Jual
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route(request()->segment(1) . '.dokumen_penjualan.show', $item->id) }}"
                                    class="btn btn-info btn-sm mt-1">
                                    <i class="fa fa-info mr-2"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">CATATAN TUNDA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route(request()->segment(1) . '.dokumen_penjualan.tunda') }}" method="POST"
                    style="display:inline;" id="tunda-form">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" name="penjualan_id">
                        <div class="form-group">
                            <label for="note_dokumen">Catatan</label>
                            <textarea class="form-control" name="note_dokumen" id="note_dokumen" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
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

        $('.btn_tunda').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let note = $(this).find('.data-tunda-' + id).text().trim();
            $('#tunda-form input[name="penjualan_id"]').val(id);
            $('#tunda-form textarea[name="note_dokumen"]').val(note);
            $('#exampleModal').modal('show');
        });

        function confirm_konfirmasi(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dikonfirmasi dan lanjut ke pembayaran!",
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

        function confirm_batal(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dibatalkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Lanjut!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#batal-form-' + id).submit();
                }
            });
        }
    </script>
@endpush
