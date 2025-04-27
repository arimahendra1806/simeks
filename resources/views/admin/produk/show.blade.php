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
                <a href="{{ route(request()->segment(1) . '.produk.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
        <div>
            <form action="{{ route(request()->segment(1) . '.produk.update', $produk->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="pemasok_id" class="form-label">Pemasok <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="pemasok_id" id="pemasok_id"
                            class="form-control form-select js-select2 @error('pemasok_id') is-invalid @enderror"
                            data-placeholder="- Pilih Pemasok -" disabled>
                            <option value=""></option>
                            @foreach ($option_pemasok as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pemasok_id', $produk->pemasok_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama . ' (' . $item->perusahaan . ')' }}
                                </option>
                            @endforeach
                        </select>
                        @error('pemasok_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="nama" class="form-label">Nama Produk <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama"
                            value="{{ old('nama', $produk->nama) }}" readonly>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="kategori_id" class="form-label">Kategori <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="kategori_id" id="kategori_id"
                            class="form-control form-select js-select2 @error('kategori_id') is-invalid @enderror"
                            data-placeholder="- Pilih Kategori -" disabled>
                            <option value=""></option>
                            @foreach ($option_kategori as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('kategori_id', $produk->kategori_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if (session('role_id') == 1)
                        <div class="col-md-12 mb-3">
                            <label for="file" class="form-label">Foto Produk </label>
                            <input type="file" class="form-control input-file @error('file') is-invalid @enderror"
                                placeholder="Masukkan file..." id="file" name="file[]" accept="image/*" disabled
                                multiple>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="col-md-12 mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan deskripsi..." readonly
                            id="deskripsi" name="deskripsi">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <label for="deskripsi" class="form-label">Harga</label>
                            @if (session('role_id') == 1)
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
                                        <th>Satuan</th>
                                        <th>Kuantitas</th>
                                        <th>Harga</th>
                                        @if (session('role_id') == 1)
                                            <th>Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hargas as $data)
                                        <tr>
                                            <td>
                                                <span class="number_input">{{ $loop->iteration }}</span>
                                            </td>
                                            <td>
                                                <select name="satuan_id[]" class="form-control form-select js-select2"
                                                    disabled>
                                                    @foreach ($option_satuan as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $data->satuan_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control js-currency" name="kuantitas[]"
                                                    value="{{ number_format($data->kuantitas, 0, '.', '.') }}" readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control js-currency" name="harga[]"
                                                    value="{{ number_format($data->harga, 0, '.', '.') }}" readonly>
                                            </td>
                                            @if (session('role_id') == 1)
                                                <td>
                                                    <a href="javascript:void(0)"
                                                        class="btn btn-danger btn-sm btn_delete disabled_btn">
                                                        <i class="fa fa-trash mr-2"></i> Hapus
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if (session('role_id') == 1)
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary float-right d-none btn_save"><i
                                    class="fa fa-save mr-2"></i>Simpan</button>
                            <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                                    class="fa fa-trash mr-2"></i>Batal</button>
                            <button class="btn btn-warning float-right btn_edit"><i
                                    class="fa fa-edit mr-2"></i>Edit</button>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Fungsi untuk memperbarui nomor urut
            function updateRowNumbers() {
                $("#data_table tbody tr").each(function(index) {
                    $(this).find(".number_input").text(index + 1);
                });
            }

            // Event saat tombol "Tambah" ditekan
            $(".btn_add").click(function() {
                let newRow = `
                    <tr>
                        <td>
                            <span class="number_input"></span>
                        </td>
                        <td>
                            <select name="satuan_id[]" class="form-control form-select js-select2">
                                @foreach ($option_satuan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control js-currency" name="kuantitas[]">
                        </td>
                        <td>
                            <input type="text" class="form-control js-currency" name="harga[]">
                        </td>
                        <td>
                            <a href="javascript:void(0)" class="btn btn-danger btn-sm btn_delete">
                                <i class="fa fa-trash mr-2"></i> Hapus
                            </a>
                        </td>
                    </tr>
                `;

                $("#data_table tbody").append(newRow);
                updateRowNumbers();

                $('.js-select2').each(function() {
                    var placeholder = $(this).data('placeholder');
                    $(this).select2({
                        theme: 'bootstrap4',
                        width: '100%',
                        placeholder: placeholder,
                    });
                });

                $('.js-currency').on('input', function() {
                    var input_val = $(this).val();
                    $(this).val(format_currency(input_val));
                });
            });

            // Event saat tombol "Hapus" ditekan
            $(document).on("click", ".btn_delete", function() {
                $(this).closest("tr").remove();
                updateRowNumbers();
            });

            // Inisialisasi nomor pertama kali
            updateRowNumbers();

            $('.btn_edit').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.btn_save').removeClass('d-none');
                $('.btn_cancel').removeClass('d-none');
                $('.form-control').attr('readonly', false);
                $('.btn_delete').removeClass('disabled_btn');
                $('.btn_add').removeClass('disabled_btn');
                $('.form-control.form-select').attr('disabled', false);
                $('.input-file').attr('disabled', false);
            });

            $('.btn_cancel').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.btn_edit').removeClass('d-none');
                $('.btn_save').addClass('d-none');
                $('.form-control').attr('readonly', true);
                $('.btn_delete').addClass('disabled_btn');
                $('.btn_add').addClass('disabled_btn');
                $('.form-control.form-select').attr('disabled', true);
                $('.input-file').attr('disabled', true);
            });

            $("form").on("submit", function(e) {
                e.preventDefault();

                let isValid = true;

                $("#data_table tbody tr").each(function() {
                    let satuan = $(this).find("select[name='satuan_id[]']").val();
                    let kuantitas = $(this).find("input[name='kuantitas[]']").val().trim();
                    let harga = $(this).find("input[name='harga[]']").val().trim();

                    $(this).find("select, input").removeClass("is-invalid");

                    if (!satuan || !kuantitas || !harga) {
                        isValid = false;
                        if (!satuan) $(this).find("select[name='satuan_id[]']").addClass(
                            "is-invalid");
                        if (!kuantitas) $(this).find("input[name='kuantitas[]']").addClass(
                            "is-invalid");
                        if (!harga) $(this).find("input[name='harga[]']").addClass("is-invalid");
                    }
                });

                if (!isValid) {
                    notif_error("Harap isi semua kolom sebelum menyimpan!");
                } else {
                    // Pastikan form hanya dikirim sekali
                    $(this).off("submit").submit();
                }
            });
        });
    </script>
@endpush
