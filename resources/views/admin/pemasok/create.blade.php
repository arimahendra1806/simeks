@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Tambah Data {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('admin.pemasok.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
        <div>
            <form action="{{ route('admin.pemasok.store') }}" method="POST">
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
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="perusahaan" class="form-label">Perusahaan <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('perusahaan') is-invalid @enderror"
                            placeholder="Masukkan perusahaan..." id="perusahaan" name="perusahaan"
                            value="{{ old('perusahaan') }}">
                        @error('perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan email..." id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telepon" class="form-label">Nomor WA <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                            placeholder="Masukkan telepon..." id="telepon" name="telepon" value="{{ old('telepon') }}">
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat..." id="alamat"
                            name="alamat">{{ old('alamat') }}</textarea>
                        @error('alamat')
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
