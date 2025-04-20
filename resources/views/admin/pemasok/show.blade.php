@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Detail Data {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route(request()->segment(1) . '.pemasok.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
        <div>
            <form action="{{ route(request()->segment(1) . '.pemasok.update', $pemasok->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="negara_id" class="form-label">Negara</label>
                        <select name="negara_id" id="negara_id"
                            class="form-control form-select js-select2 @error('negara_id') is-invalid @enderror"
                            data-placeholder="- Pilih Negara -" disabled>
                            <option value=""></option>
                            @foreach ($option_negara as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('negara_id', $pemasok->negara_id) == $item->id ? 'selected' : '' }}>
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
                            placeholder="Masukkan nama..." id="nama" name="nama"
                            value="{{ old('nama', $pemasok->nama) }}" readonly>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="perusahaan" class="form-label">Perusahaan <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('perusahaan') is-invalid @enderror"
                            placeholder="Masukkan perusahaan..." id="perusahaan" name="perusahaan"
                            value="{{ old('perusahaan', $pemasok->perusahaan) }}" readonly>
                        @error('perusahaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan email..." id="email" name="email"
                            value="{{ old('email', $pemasok->email) }}" readonly>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telepon" class="form-label">Nomor WA <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('telepon') is-invalid @enderror"
                            placeholder="Masukkan telepon..." id="telepon" name="telepon"
                            value="{{ old('telepon', $pemasok->telepon) }}" readonly>
                        @error('telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan alamat..." id="alamat"
                            name="alamat" readonly>{{ old('alamat', $pemasok->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
            $('.btn_edit').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.btn_save').removeClass('d-none');
                $('.btn_cancel').removeClass('d-none');
                $('.form-control').attr('readonly', false);
                $('.form-control.form-select').attr('disabled', false);
            });

            $('.btn_cancel').on('click', function(e) {
                e.preventDefault();
                $(this).addClass('d-none');
                $('.btn_edit').removeClass('d-none');
                $('.btn_save').addClass('d-none');
                $('.form-control').attr('readonly', true);
                $('.form-control.form-select').attr('disabled', true);
            });
        });
    </script>
@endpush
