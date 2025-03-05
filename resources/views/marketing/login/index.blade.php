@extends('template.login')

@section('content')
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-6">
                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="login-box bg-white box-shadow border-radius-10" style="max-width: 600px !important;">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Masuk Sebagai Marketing</h2>
                        </div>
                        <form action="{{ route('do_log_marketing') }}" method="POST">
                            @csrf
                            <div class="select-role">
                                <div class="btn-group row">
                                    <div class="col-md-6" onclick="location.href='{{ route('admin_login') }}'">
                                        <label class="btn active w-100">
                                            <div class="icon">
                                                <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/briefcase.svg"
                                                    class="svg" alt="" />
                                            </div>
                                            <span>Saya</span>
                                            Admin
                                        </label>
                                    </div>
                                    <div class="col-md-6" onclick="location.href='{{ route('direktur_login') }}'">
                                        <label class="btn active w-100">
                                            <div class="icon">
                                                <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/briefcase.svg"
                                                    class="svg" alt="" />
                                            </div>
                                            <span>Saya</span>
                                            Manager
                                        </label>
                                    </div>
                                    {{-- <div class="col-md-4" onclick="location.href='{{ route('buyer_login') }}'">
                                        <label class="btn active w-100">
                                            <div class="icon">
                                                <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/person.svg"
                                                    class="svg" alt="" />
                                            </div>
                                            <span>Saya</span>
                                            Buyer
                                        </label>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="input-group">
                                <input type="email"
                                    class="form-control form-control-lg @error('email') is-invalid @enderror"
                                    placeholder="Email" id="email" name="email" value="{{ old('email') }}" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group">
                                <input type="password"
                                    class="form-control form-control-lg @error('password') is-invalid @enderror"
                                    placeholder="**********" id="password" name="password" value="{{ old('password') }}" />
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row pb-30 d-none">
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1" />
                                        <label class="custom-control-label" for="customCheck1">Remember</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="forgot-password">
                                        <a href="javascript:void(0)">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Masuk Sekarang
                                        </button>
                                    </div>
                                    <div class="font-16 weight-600 pt-10 pb-10 text-center d-none" data-color="#707373">
                                        OR
                                    </div>
                                    <div class="input-group mb-0">
                                        <a class="btn btn-outline-primary btn-lg btn-block d-none"
                                            href="register.html">Register To
                                            Create Account</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
