@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Detail {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('admin.user.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
        <div>
            <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="role_id" class="form-label">Posisi <span
                                class="text-danger"><small>*</small></span></label>
                        <select name="role_id" id="role_id"
                            class="form-control form-select js-select2 @error('role_id') is-invalid @enderror"
                            data-placeholder="- Pilih Posisi -" disabled>
                            <option value=""></option>
                            @foreach ($option_role as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('role_id', $user->role_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama User <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            placeholder="Masukkan name..." id="name" name="name"
                            value="{{ old('name', $user->name) }}" readonly>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            placeholder="Masukkan email..." id="email" name="email"
                            value="{{ old('email', $user->email) }}" readonly>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            placeholder="Masukkan password..." id="password" name="password" value="{{ old('password') }}"
                            readonly>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span
                                class="text-danger"><small>*</small></span></label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Masukkan konfirmasi password..." id="password_confirmation"
                            name="password_confirmation" value="{{ old('password_confirmation') }}" readonly>
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-right d-none btn_save"><i
                                class="fa fa-save mr-2"></i>Simpan</button>
                        <button class="btn btn-danger float-right d-none btn_cancel mr-2"><i
                                class="fa fa-trash mr-2"></i>Batal</button>
                        <button class="btn btn-warning float-right btn_edit"><i class="fa fa-edit mr-2"></i>Edit</button>
                    </div>
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
