@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Tambah Data {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
        <div>
            <form action="{{ route('admin.produk.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="pemasok_id" class="form-label">Pemasok <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="pemasok_id" id="pemasok_id"
                            class="form-control form-select js-select2 @error('pemasok_id') is-invalid @enderror"
                            data-placeholder="- Pilih Pemasok -">
                            <option value=""></option>
                            @foreach ($option_pemasok as $item)
                                <option value="{{ $item->id }}" {{ old('pemasok_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('pemasok_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="provinsi_id" class="form-label">Provinsi <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="provinsi_id" id="provinsi_id"
                            class="form-control form-select js-select2 @error('provinsi_id') is-invalid @enderror"
                            data-placeholder="- Pilih Provinsi -">
                            <option value=""></option>
                            @foreach ($option_provinsi as $item)
                                <option value="{{ $item->id }}" {{ old('provinsi_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('provinsi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="kota_id" class="form-label">Kota <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="kota_id" id="kota_id"
                            class="form-control form-select js-select2 @error('kota_id') is-invalid @enderror"
                            data-placeholder="- Pilih Kota -" disabled>
                            <option value=""></option>
                        </select>
                        @error('kota_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Produk<span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="kategori_id" class="form-label">Kategori <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="kategori_id" id="kategori_id"
                            class="form-control form-select js-select2 @error('kategori_id') is-invalid @enderror"
                            data-placeholder="- Pilih Kategori -">
                            <option value=""></option>
                            @foreach ($option_kategori as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('kategori_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="satuan_id" class="form-label">Satuan <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="satuan_id" id="satuan_id"
                            class="form-control form-select js-select2 @error('satuan_id') is-invalid @enderror"
                            data-placeholder="- Pilih Satuan -">
                            <option value=""></option>
                            @foreach ($option_satuan as $item)
                                <option value="{{ $item->id }}" {{ old('satuan_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('satuan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="isi" class="form-label">Isi <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="number" class="form-control @error('isi') is-invalid @enderror"
                            placeholder="Masukkan isi..." id="isi" name="isi" value="{{ old('isi') }}">
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="harga" class="form-label">Harga <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control js-currency @error('harga') is-invalid @enderror"
                            placeholder="Masukkan harga..." id="harga" name="harga" value="{{ old('harga') }}">
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukkan deskripsi..."
                            id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right"><i
                                class="fa fa-save mr-2"></i>Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#provinsi_id').change(function(){
                var provinsi = $(this).val();
                if(provinsi){
                    $.ajax({
                        url: `${url_path(2)}/kota/` + provinsi,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data){
                            $('#kota_id').empty().append('<option value="">Pilih Kota</option>');
                            $.each(data, function(key, kota){
                                $('#kota_id').append('<option value="'+ kota.id +'">'+ kota.nama +'</option>');
                            });
                            $('#kota_id').prop('disabled', false);
                        }
                    });
                }else{
                    $('#kota_id').empty().append('<option value="">Pilih Kota</option>');
                    $('#kota_id').prop('disabled', true);
                }
            });
        });
    </script>
@endpush
