@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Tambah Data {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route(request()->segment(1) . '.pasar.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
        <div>
            <form action="{{ route(request()->segment(1) . '.pasar.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="negara_id" class="form-label">Negara <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="negara_id" id="negara_id"
                            class="form-control form-select js-select2 @error('negara_id') is-invalid @enderror"
                            data-placeholder="- Pilih Negara -">
                            <option value=""></option>
                            @foreach ($option_negara as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('negara_id', 63) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama . ' (' . $item->kode . ')' }}
                                </option>
                            @endforeach
                        </select>
                        @error('negara_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="industri_id" class="form-label">Industri <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="industri_id" id="industri_id"
                            class="form-control form-select js-select2 @error('industri_id') is-invalid @enderror"
                            data-placeholder="- Pilih Industri -">
                            <option value=""></option>
                            @foreach ($option_industri as $item)
                                <option value="{{ $item->id }}" {{ old('industri_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('industri_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="pembeli_id" class="form-label">Pembeli <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="pembeli_id" id="pembeli_id"
                            class="form-control form-select js-select2 @error('pembeli_id') is-invalid @enderror"
                            data-placeholder="- Pilih Pembeli -">
                            <option value=""></option>
                            @foreach ($option_pembeli as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('pembeli_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama . ' (' . $item->perusahaan . ')' }}
                                </option>
                            @endforeach
                        </select>
                        @error('pembeli_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="produk_id" class="form-label">Produk <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="produk_id" id="produk_id"
                            class="form-control form-select js-select2 @error('produk_id') is-invalid @enderror"
                            data-placeholder="- Pilih Produk -">
                            <option value=""></option>
                            @foreach ($option_produk as $item)
                                <option value="{{ $item->id }}" {{ old('produk_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('produk_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="regulasi" class="form-label">Regulasi</label>
                        <textarea class="form-control @error('regulasi') is-invalid @enderror" placeholder="Masukkan regulasi..." id="regulasi"
                            name="regulasi">{{ old('regulasi') }}</textarea>
                        @error('regulasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="kompetitor" class="form-label">Kompetitor</label>
                        <textarea class="form-control @error('kompetitor') is-invalid @enderror" placeholder="Masukkan kompetitor..."
                            id="kompetitor" name="kompetitor">{{ old('kompetitor') }}</textarea>
                        @error('kompetitor')
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
        $(document).ready(function() {});
    </script>
@endpush
