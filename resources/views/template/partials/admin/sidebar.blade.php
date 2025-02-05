<div class="left-side-bar">
    <div class="brand-logo">
        <div class="d-flex">
            <a href="javascript:void(0);" class="mt-3">
                <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/favicon-32x32.png" alt=""
                    class="dark-logo" />
                <img src="<?= asset('assets/lib/deskapp-master/') ?>/vendors/images/favicon-32x32.png" alt=""
                    class="light-logo" />
            </a>
            <h1 class="mt-1">SIMEKS</h1>
        </div>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                @if (session('role_id') == 1)
                    <li>
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('admin/dashboard*') ? 'active' : '' }}">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="micon bi bi-textarea-resize"></span
                            ><span class="mtext">Master Data</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="javascript:void(0);">Pilihan</a></li>
                            <li><a href="javascript:void(0);">Negara</a></li>
                            <li><a href="javascript:void(0);">Provinsi</a></li>
                            <li><a href="javascript:void(0);">Kota</a></li>
                            <li><a href="javascript:void(0);">Bank</a></li>
                            <li><a href="javascript:void(0);">Dokumen</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Data Supplier</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Data Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Data Buyer</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Rekap Market Research</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Rekap Pembayaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Transaksi Pengiriman</span>
                        </a>
                    </li>
                @elseif (session('role_id') == 2)
                    <li>
                        <a href="{{ route('marketing.dashboard.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('marketing/dashboard*') ? 'active' : '' }}">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Data Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Data Buyer</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Data Market Research</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Transaksi Penjualan</span>
                        </a>
                    </li>
                @elseif (session('role_id') == 3)
                    <li>
                        <a href="{{ route('direktur.dashboard.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('direktur/dashboard*') ? 'active' : '' }}">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Dokumen Ekspor</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Rekap Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Rekap Supplier</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Rekap Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Rekap Buyer</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Rekap Market Research</span>
                        </a>
                    </li>
                @elseif (session('role_id') == 4)
                    <li>
                        <a href="{{ route('buyer.dashboard.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('buyer/dashboard*') ? 'active' : '' }}">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Rekap Tranksaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);"
                            class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Upload Pembayaran</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
