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
                <a href="{{ route(request()->segment(1) . '.penjualan.index') }}"
                    class="btn btn-secondary mr-2 float-right"><i class="fa fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
        <div>
            <form action="{{ route(request()->segment(1) . '.penjualan.update', $penjualan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="pembeli_id" class="form-label">Pembeli <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="pembeli_id" id="pembeli_id"
                            class="form-control form-select edit-input js-select2 @error('pembeli_id') is-invalid @enderror"
                            data-placeholder="- Pilih Pembeli -" disabled>
                            <option value=""></option>
                            @foreach ($option_pembeli as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pembeli_id', $penjualan->pembeli_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama . ' (' . $item->perusahaan . ')' }}
                                </option>
                            @endforeach
                        </select>
                        @error('pembeli_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_negosiasi" class="form-label">Tanggal Negosiasi<span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text"
                            class="form-control date-picker input-date @error('tanggal_negosiasi') is-invalid @enderror"
                            placeholder="Pilih Tanggal..." id="tanggal_negosiasi" name="tanggal_negosiasi"
                            value="{{ old('tanggal_negosiasi', date_to_indo($penjualan->tanggal_negosiasi)) }}" readonly
                            disabled>
                        @error('tanggal_negosiasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian<span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text"
                            class="form-control date-picker input-date @error('tanggal_pembelian') is-invalid @enderror"
                            placeholder="Pilih Tanggal..." id="tanggal_pembelian" name="tanggal_pembelian"
                            value="{{ old('tanggal_pembelian', date_to_indo($penjualan->tanggal_pembelian)) }}" readonly
                            disabled>
                        @error('tanggal_pembelian')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="hasil_negosiasi" class="form-label">Hasil Negosiasi</label>
                        <textarea class="form-control edit-input @error('hasil_negosiasi') is-invalid @enderror"
                            placeholder="Masukkan hasil_negosiasi..." id="hasil_negosiasi" name="hasil_negosiasi" disabled>{{ old('hasil_negosiasi', $penjualan->hasil_negosiasi) }}</textarea>
                        @error('hasil_negosiasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="permintaan" class="form-label">Permintaan</label>
                        <textarea class="form-control edit-input @error('permintaan') is-invalid @enderror" placeholder="Masukkan permintaan..."
                            id="permintaan" name="permintaan" disabled>{{ old('permintaan', $penjualan->permintaan) }}</textarea>
                        @error('permintaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <label for="deskripsi" class="form-label">Produk</label>
                            <a href="javascript:void(0)" class="btn btn-info btn-sm btn_add disabled_btn">
                                <i class="fa fa-plus mr-2"></i> Tambah
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table id="data_table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Satuan</th>
                                        <th>Kuantitas</th>
                                        <th>Harga</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_all = 0;
                                    @endphp
                                    @foreach ($produks as $produk)
                                        @php
                                            $total_all += $produk->total;
                                        @endphp
                                        <tr>
                                            <td>
                                                <span class="number_input"></span>
                                            </td>
                                            <td>
                                                <select name="produk_ids[]" class="form-select js-select2" disabled>
                                                    @foreach ($option_produk as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $produk->produk_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama }}</option>
                                                    @endforeach
                                                    <input type="hidden" class="form-control" name="produk_id[]" readonly
                                                        value="{{ $produk->produk_id }}">
                                                </select>
                                            </td>
                                            <td>
                                                <select name="satuan_ids[]" class="form-select js-select2" disabled>
                                                    @foreach ($option_satuan as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $produk->satuan_id == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" class="form-control" name="satuan_id[]" readonly
                                                    value="{{ $produk->satuan_id }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control js-currency" name="kuantitas[]"
                                                    readonly value="{{ format_currency($produk->kuantitas) }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control js-currency" name="harga[]"
                                                    readonly value="{{ format_currency($produk->harga) }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control js-currency" name="total[]"
                                                    readonly value="{{ format_currency($produk->total) }}">
                                            </td>
                                            <td>
                                                <a href="javascript:void(0)"
                                                    class="btn btn-danger btn-sm btn_delete disabled_btn">
                                                    <i class="fa fa-trash mr-2"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5" class="text-right">Total</th>
                                        <th class="text-right total_all">{{ format_currency($total_all) }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @if (session('role_id') != 1 && !(session('role_id') == 2 && $penjualan->status == 1))
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

    <div class="modal fade bs-example-modal-lg show" id="modal_produk" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">
                        Tambah Item Produk
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="form_product">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="produk_add" class="form-label">Produk <span
                                        class="text-danger"><small>*</small></span></label>
                                <select name="produk_add" id="produk_add"
                                    class="form-control form-select js-select2 @error('produk_add') is-invalid @enderror"
                                    data-placeholder="- Pilih Produk -" required>
                                    <option value=""></option>
                                    @foreach ($option_produk as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('produk_add') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('produk_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="satuan_add" class="form-label">Satuan <span
                                        class="text-danger"><small>*</small></span></label>
                                <select name="satuan_add" id="satuan_add"
                                    class="form-control form-select js-select2 @error('satuan_add') is-invalid @enderror"
                                    data-placeholder="- Pilih Satuan -" required>
                                    <option value=""></option>
                                </select>
                                @error('satuan_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="harga_add" class="form-label">Harga <span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text"
                                    class="form-control js-currency @error('harga_add') is-invalid @enderror"
                                    placeholder="Masukkan harga..." id="harga_add" name="harga_add"
                                    value="{{ old('harga_add') }}" readonly required>
                                @error('harga_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="kuantitas_add" class="form-label">Kuantitas<span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text"
                                    class="form-control js-currency @error('kuantitas_add') is-invalid @enderror"
                                    placeholder="Masukkan kuantitas..." id="kuantitas_add" name="kuantitas_add"
                                    value="{{ old('kuantitas_add') }}" required>
                                @error('kuantitas_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="total_add" class="form-label">Total<span
                                        class="text-danger"><small>*</small></span></label>
                                <input type="text" class="form-control @error('total_add') is-invalid @enderror"
                                    placeholder="Masukkan total..." id="total_add" name="total_add"
                                    value="{{ old('total_add'), 0 }}" readonly required>
                                @error('total_add')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Tutup
                    </button>
                    <button type="button" class="btn btn-primary save_item">
                        Tambahkan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        const baseSegment = '{{ request()->segment(1) }}';
        let data_satuan = '';

        $(document).ready(function() {
            updateRowNumbers();
        });

        function updateRowNumbers() {
            $("#data_table tbody tr").each(function(index) {
                $(this).find(".number_input").text(index + 1);
            });

            if ($("#data_table tbody tr").length == 0) {
                no_item();
            }
        }

        function no_item() {
            $("#data_table tbody").append(`
                <tr class="no_item">
                    <td colspan="7" class="text-center">Tidak ada item</td>
                </tr>
            `);
        }

        $('.btn_add').click(function() {
            $('#form_product').trigger("reset");
            $('#satuan_add').empty();
            $('#satuan_add').append('<option value="">Pilih Satuan</option>');
            $('#modal_produk').modal('show');
        });

        $('#produk_add').on('change', function() {
            let id = $(this).val();
            let url = `/${baseSegment}/penjualan/satuan/${id}`;
            Swal.showLoading();

            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    Swal.close();
                    $('#satuan_add').empty();
                    $('#satuan_add').append('<option value="">Pilih Satuan</option>');
                    $.each(data, function(index, item) {
                        $('#satuan_add').append(
                            `<option value="${item.satuan.id}" data-harga="${item.harga}">${item.satuan.nama}</option>`
                        );
                    });
                }
            });
        });

        $('#satuan_add').on('change', function() {
            let harga = $('option:selected', this).data('harga');
            $('#harga_add').val(format_currency(harga));
        });

        $('#kuantitas_add').on('input', function() {
            let harga = remove_currency($('#harga_add').val());
            let kuantitas = remove_currency($(this).val());

            let total = parseInt(harga) * parseInt(kuantitas);
            $('#total_add').val(format_currency(total));
        });

        $(".save_item").click(function() {
            let produk = $('#produk_add').val();
            let satuan = $('#satuan_add').val();
            let harga = $('#harga_add').val();
            let kuantitas = $('#kuantitas_add').val();
            let total = $('#total_add').val();

            let newRow = `
                    <tr>
                        <td>
                            <span class="number_input"></span>
                        </td>
                        <td>
                            <select name="produk_ids[]" class="form-select js-select2" disabled>
                                @foreach ($option_produk as $item)
                                    <option value="{{ $item->id }} ${ (produk == {{ $item->id }} ? 'selected' : '') }">{{ $item->nama }}</option>
                                @endforeach
                                <input type="hidden" class="form-control" name="produk_id[]" readonly value="${produk}">
                            </select>
                        </td>
                        <td>
                            <select name="satuan_ids[]" class="form-select js-select2" disabled>
                                @foreach ($option_satuan as $item)
                                    <option value="{{ $item->id }}" ${ (satuan == {{ $item->id }} ? 'selected' : '') }>{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" class="form-control" name="satuan_id[]" readonly value="${satuan}">
                        </td>
                        <td>
                            <input type="text" class="form-control js-currency" name="kuantitas[]" readonly value="${kuantitas}">
                        </td>
                        <td>
                            <input type="text" class="form-control js-currency" name="harga[]" readonly value="${harga}">
                        </td>
                        <td>
                            <input type="text" class="form-control js-currency" name="total[]" readonly value="${total}">
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

            $('#modal_produk').modal('hide');
            remove_no_item();
            calculate();
        });

        function calculate() {
            let total_all = 0;
            $("#data_table tbody tr").each(function() {
                let total = remove_currency($(this).find("input[name='total[]']").val());
                total_all += parseInt(total);
            });

            $('.total_all').text(format_currency(total_all));
        }

        function remove_no_item() {
            $("#data_table tbody tr").each(function() {
                if ($(this).hasClass("no_item")) {
                    $(this).remove();
                }
            });
        }

        $(document).on("click", ".btn_delete", function() {
            $(this).closest("tr").remove();
            updateRowNumbers();
            calculate();
        });

        $("form").on("submit", function(e) {
            e.preventDefault();

            let isValid = true;

            $("#data_table tbody tr").each(function() {
                let produk = $(this).find("input[name='produk_id[]']").val();
                let satuan = $(this).find("input[name='satuan_id[]']").val();
                let kuantitas = $(this).find("input[name='kuantitas[]']").val();
                let harga = $(this).find("input[name='harga[]']").val();
                let total = $(this).find("input[name='total[]']").val();

                $(this).find("select, input").removeClass("is-invalid");

                if (!produk || !satuan || !kuantitas || !harga || !total) {
                    isValid = false;
                    if (!produk) $(this).find("input[name='produk_id[]']").addClass(
                        "is-invalid"
                    )
                    if (!satuan) $(this).find("input[name='satuan_id[]']").addClass(
                        "is-invalid");
                    if (!kuantitas) $(this).find("input[name='kuantitas[]']").addClass(
                        "is-invalid");
                    if (!harga) $(this).find("input[name='harga[]']").addClass("is-invalid");
                    if (!total) $(this).find("input[name='total[]']").addClass("is-invalid");
                }
            });

            if (!isValid) {
                notif_error("Data produk belum lengkap!");
            } else {
                $(this).off("submit").submit();
            }
        });

        $('.btn_edit').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('d-none');
            $('.btn_save').removeClass('d-none');
            $('.btn_cancel').removeClass('d-none');
            $('.btn_delete').removeClass('disabled_btn');
            $('.btn_add').removeClass('disabled_btn');
            $('.edit-input').attr('readonly', false);
            $('.edit-input').attr('disabled', false);
            $('.input-date').attr('disabled', false);
        });

        $('.btn_cancel').on('click', function(e) {
            e.preventDefault();
            $(this).addClass('d-none');
            $('.btn_edit').removeClass('d-none');
            $('.btn_save').addClass('d-none');
            $('.btn_delete').addClass('disabled_btn');
            $('.btn_add').addClass('disabled_btn');
            $('.edit-input').attr('readonly', true);
            $('.edit-input').attr('disabled', true);
            $('.input-date').attr('disabled', true);
        });
    </script>
@endpush
