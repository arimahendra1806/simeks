@extends('template.admin')

@section('content')
    <div class="pd-20 card-box mb-30">
        <div class="clearfix">
            <div class="pull-left">
                <h2 class="text-blue mb-4">{{ $title }}</h2>
                <h4 class="mt-2">Selamat Datang {{ session('user_name') }}</h4>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
