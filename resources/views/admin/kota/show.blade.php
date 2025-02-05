@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">Detail Data {{ $title }}</h2>
            </div>
            <div class="pull-right">
                <a href="{{ route('admin.kota.index') }}" class="btn btn-secondary mr-2 float-right"><i
                        class="fa fa-arrow-left mr-2"></i>Kembali</a>
            </div>
        </div>
        <div>
            <form action="{{ route('admin.kota.update', $kotum->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="provinsi_id" class="form-label">Provinsi <span class="text-danger"><small>*</small></span></label>
                        <select name="provinsi_id" id="provinsi_id"
                            class="form-control form-select js-select2 @error('provinsi_id') is-invalid @enderror"
                            data-placeholder="- Pilih Provinsi -" disabled>
                            <option value=""></option>
                            @foreach ($option_provinsi as $item)
                                <option value="{{ $item->id }}"
                                    {{ old('provinsi_id', $kotum->provinsi_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('provinsi_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nama" class="form-label">Nama Kota <span class="text-danger"><small>*</small></span></label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror"
                            placeholder="Masukkan nama..." id="nama" name="nama"
                            value="{{ old('nama', $kotum->nama) }}" readonly>
                        @error('nama')
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
