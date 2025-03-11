@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">{{ $title }}</h2>
            </div>
            <div class="pull-right">
                @if (session('role_id') == 2)
                    <a href="{{ route(request()->segment(1) . '.pasar.create') }}"
                        class="btn btn-primary btn-sm ml-2 float-right">
                        <i class="fa fa-plus mr-2"></i> Tambah Data
                    </a>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            <table id="data_table" class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Negara</th>
                        <th>Industri</th>
                        <th>Pembeli</th>
                        <th>Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->negara->nama }}</td>
                            <td>{{ $item->industri->nama }}</td>
                            <td>{{ $item->pembeli->nama }}</td>
                            <td>{{ $item->produk->nama }}</td>
                            <td>
                                <a href="{{ route(request()->segment(1) . '.pasar.show', $item->id) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fa fa-info mr-2"></i> Detail
                                </a>

                                @if (session('role_id') == 2)
                                    <form action="{{ route(request()->segment(1) . '.pasar.destroy', $item->id) }}"
                                        method="POST" style="display:inline;" id="delete-form-{{ $item->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="confirm_delete({{ $item->id }})">
                                            <i class="fa fa-trash mr-2"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
