@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix mb-4">
            <div class="pull-left">
                <h2 class="text-blue mb-4">{{ $title }}</h2>
            </div>
            @if (session('role_id') != 3)
                <div class="pull-right">
                    <a href="{{ route(request()->segment(1) . '.pembeli.create') }}"
                        class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-plus mr-2"></i> Tambah Data
                    </a>
                </div>
            @endif
        </div>
        <div class="table-responsive">
            <table id="data_table" class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Negara</th>
                        <th>Nama</th>
                        <th>Perusahaan</th>
                        <th>Email</th>
                        <th class="no-export">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->negara->kode }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->perusahaan }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route(request()->segment(1) . '.pembeli.show', $item->id) }}"
                                    class="btn btn-info btn-sm">
                                    <i class="fa fa-info mr-2"></i> Detail
                                </a>
                                @if (session('role_id') != 3)
                                    <form action="{{ route('admin.pembeli.destroy', $item->id) }}" method="POST"
                                        style="display:inline;" id="delete-form-{{ $item->id }}">
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
                },
                @if (session('role_id') == 3)
                    dom: 'Bfrtip',
                    // columnDefs: [{
                    //         targets: [0, 1],
                    //         visible: false
                    //     }
                    // ],
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Data Produk',
                            exportOptions: {
                                columns: ':not(.no-export)'
                            }
                        },
                        // {
                        //     extend: 'pdfHtml5',
                        //     title: 'Data Produk',
                        //     exportOptions: {
                        //         columns: ':not(.no-export)'
                        //     }
                        // },
                        // {
                        //     extend: 'csvHtml5',
                        //     title: 'Data Produk',
                        //     exportOptions: {
                        //         columns: ':not(.no-export)'
                        //     }
                        // },
                        // {
                        //     extend: 'print',
                        //     title: 'Data Produk',
                        //     exportOptions: {
                        //         columns: ':not(.no-export)'
                        //     }
                        // }
                    ]
                @endif
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
