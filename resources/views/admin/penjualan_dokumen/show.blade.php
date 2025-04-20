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
                <h2 class="text-blue mb-4">Detail Data {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route(request()->segment(1) . '.dokumen_penjualan.index') }}"
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
                <div class="col-md-12 mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <label for="deskripsi" class="form-label">Dokumen</label>
                        <a href="javascript:void(0)" class="btn btn-info btn-sm btn_add disabled_btn">
                            <i class="fa fa-plus mr-2"></i> Tambah
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="data_table" class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row">
                                            @foreach ($dokumens as $item)
                                                <div class="col-md-4">
                                                    <div class="card-box height-100-p widget-style3">
                                                        <div class="d-flex flex-wrap">
                                                            <div class="widget-data">
                                                                <div class="weight-700 font-24 text-dark">
                                                                    {{ $item->dokumen->nama }}</div>
                                                                <div class="font-14 text-secondary weight-500">
                                                                    {{ $item->file }}
                                                                </div>
                                                            </div>
                                                            <div class="widget-icon preview_file" style="cursor: pointer"
                                                                data-pdf="{{ asset('assets/uploads/dokumen/' . $item->file) }}">
                                                                <div class="icon" data-color="#00eccf"
                                                                    style="color: rgb(0, 236, 207);">
                                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if (session('role_id') == 3)
                                                            <form
                                                                action="{{ route(request()->segment(1) . '.dokumen_penjualan.destroy', $item->id) }}"
                                                                method="POST" style="display:inline;"
                                                                id="delete-form-{{ $item->id }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm w-100 rounded-0"
                                                                    onclick="confirm_delete({{ $item->id }})">
                                                                    <i class="fa fa-trash mr-2"></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach

                                            @if ($dokumens->isEmpty())
                                                <div class="col-md-12">
                                                    <h3 class="text-center">Belum Ada Dokumen</h3>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
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

    <div class="modal fade bs-example-modal-lg show" id="modal_dokumen" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tambah Item Dokumen
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <form action="{{ route(request()->segment(1) . '.dokumen_penjualan.update', $penjualan->id) }}"
                    id="form_dokumen" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="dokumen_id" class="form-label">Dokumen <span
                                        class="text-danger"><small>*</small></span></label>
                                <select name="dokumen_id" id="dokumen_id"
                                    class="form-control form-select js-select2 @error('dokumen_id') is-invalid @enderror"
                                    data-placeholder="- Pilih Produk -" required>
                                    <option value=""></option>
                                    @foreach ($option_dokumen as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('dokumen_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('dokumen_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="file" class="form-label">File Dokumen<span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="file" class="form-control input-file @error('file') is-invalid @enderror"
                                    placeholder="Masukkan total..." id="file" name="file"
                                    value="{{ old('file') }}" required accept="application/pdf">
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
                        <button type="submit" class="btn btn-primary">
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
        $(document).ready(function() {});

        $('.btn_add').click(function() {
            $('#modal_dokumen').modal('show');
        });

        $('.btn_edit').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('d-none');
            $('.btn_cancel').removeClass('d-none');
            $('.btn_delete').removeClass('disabled_btn');
            $('.btn_add').removeClass('disabled_btn');
        });

        $('.btn_cancel').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('d-none');
            $('.btn_edit').removeClass('d-none');
            $('.btn_delete').addClass('disabled_btn');
            $('.btn_add').addClass('disabled_btn');
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
    </script>
@endpush
