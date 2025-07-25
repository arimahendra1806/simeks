<div class="header">
    <div class="header-left">
        <div class="menu-icon bi bi-list"></div>
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification d-none">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        <div class="user-notification d-none">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="icon-copy dw dw-notification"></i>
                    <span class="badge notification-active"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            <li>
                                <a href="#">
                                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/img.jpg"
                                        alt="" />
                                    <h3>John Doe</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/photo1.jpg"
                                        alt="" />
                                    <h3>Lea R. Frith</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/photo2.jpg"
                                        alt="" />
                                    <h3>Erik L. Richards</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/photo3.jpg"
                                        alt="" />
                                    <h3>John Doe</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/photo4.jpg"
                                        alt="" />
                                    <h3>Renee I. Hansen</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/img.jpg"
                                        alt="" />
                                    <h3>Vicki M. Coleman</h3>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit, sed...
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/photo1.jpg"
                            alt="" />
                    </span>
                    <span class="user-name">{{ session('user_name') }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    {{-- <a class="dropdown-item" href="profile.html"><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="profile.html"><i class="dw dw-settings2"></i> Setting</a>
                    <a class="dropdown-item" href="faq.html"><i class="dw dw-help"></i> Help</a> --}}
                    @if (session('role_id') == 1)
                        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger dropdown-item"><i class="dw dw-logout"></i>
                                Logout</button>
                        </form>
                    @elseif (session('role_id') == 2)
                        <form action="{{ route('marketing.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger dropdown-item"><i class="dw dw-logout"></i>
                                Logout</button>
                        </form>
                    @elseif (session('role_id') == 3)
                        <form action="{{ route('direktur.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger dropdown-item"><i class="dw dw-logout"></i>
                                Logout</button>
                        </form>
                    @elseif (session('role_id') == 4)
                        <form action="{{ route('buyer.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger dropdown-item"><i class="dw dw-logout"></i>
                                Logout</button>
                        </form>
                    @elseif (session('role_id') == 5)
                        <form action="{{ route('supplier.logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-danger dropdown-item"><i class="dw dw-logout"></i>
                                Logout</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="github-link d-none">
            <a href="https://github.com/dropways/deskapp" target="_blank"><img
                    src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/github.svg" alt="" /></a>
        </div>
    </div>
</div>
