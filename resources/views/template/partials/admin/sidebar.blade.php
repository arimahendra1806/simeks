<div class="left-side-bar">
    <div class="brand-logo">
        <div class="d-flex">
            <a href="javascript:void(0);" class="mt-3">
                <img src="<?= asset('assets') ?>/image/logo.png" alt="" class="dark-logo" />
                <img src="<?= asset('assets') ?>/image/logo.png" alt="" class="light-logo" />
            </a>
            <h4 class="mt-1">ALMEA KAUSA ETERNA</h4>
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
                            <span class="micon bi bi-speedometer2"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle">
                            <span class="micon bi bi-textarea-resize"></span><span class="mtext">Master Data</span>
                        </a>
                        <ul class="submenu">
                            {{-- <li>
                                <a href="{{ route('admin.pilihan.index') }}"
                                    class="{{ Request::is('admin/pilihan*') ? 'active' : '' }}">Pilihan</a>
                            </li> --}}
                            <li>
                                <a href="{{ route('admin.negara.index') }}"
                                    class="{{ Request::is('admin/negara*') ? 'active' : '' }}">Negara</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.bank.index') }}"
                                    class="{{ Request::is('admin/bank*') ? 'active' : '' }}">Bank</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.dokumen.index') }}"
                                    class="{{ Request::is('admin/dokumen*') ? 'active' : '' }}">Dokumen</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.kategori.index') }}"
                                    class="{{ Request::is('admin/kategori*') ? 'active' : '' }}">Kategori</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.satuan.index') }}"
                                    class="{{ Request::is('admin/satuan*') ? 'active' : '' }}">Satuan</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.industri.index') }}"
                                    class="{{ Request::is('admin/industri*') ? 'active' : '' }}">Industri</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.user.index') }}"
                                    class="{{ Request::is('admin/user*') ? 'active' : '' }}">User</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.produk.index') }}"
                                    class="{{ Request::is('admin/user*') ? 'active' : '' }}">Data Produk</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="{{ Request::is('admin/user*') ? 'active' : '' }}">Data Supplier</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);"
                                    class="{{ Request::is('admin/user*') ? 'active' : '' }}">Data Buyer</a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="{{ route('admin.pemasok.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('admin/pemasok') ? 'active' : '' }}">
                            <span class="micon bi bi-shop-window"></span><span class="mtext">Data Supplier</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ route('admin.produk.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('admin/produk') ? 'active' : '' }}">
                            <span class="micon bi bi-bag"></span><span class="mtext">Data Produk</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{ route('admin.pembeli.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('admin/pembeli') ? 'active' : '' }}">
                            <span class="micon bi bi-people"></span><span class="mtext">Data Buyer</span>
                        </a>
                    </li> --}}
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-building"></span><span class="mtext">Rekap Market
                                Research</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-journal-bookmark"></span><span class="mtext">Rekap
                                Pembayaran</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-wallet2"></span><span class="mtext">Transaksi
                                Pengiriman</span>
                        </a>
                    </li>
                @elseif (session('role_id') == 2)
                    <li>
                        <a href="{{ route('marketing.dashboard.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('marketing/dashboard*') ? 'active' : '' }}">
                            <span class="micon bi bi-speedometer2"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-bag"></span><span class="mtext">Data Produk</span>
                        </a>
                        {{-- <a href="{{ route('marketing.produk.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('marketing/produk*') ? 'active' : '' }}">
                            <span class="micon bi bi-bag"></span><span class="mtext">Data Produk</span>
                        </a> --}}
                    </li>
                    <li>
                        <a href="javascript:void(0)" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-people"></span><span class="mtext">Data Buyer</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-building"></span><span class="mtext">Data Market
                                Research</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-wallet2"></span><span class="mtext">Transaksi
                                Penjualan</span>
                        </a>
                    </li>
                @elseif (session('role_id') == 3)
                    <li>
                        <a href="{{ route('direktur.dashboard.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('direktur/dashboard*') ? 'active' : '' }}">
                            <span class="micon bi bi-speedometer2"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-file-break"></span><span class="mtext">Dokumen Ekspor</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-wallet2"></span><span class="mtext">Rekap
                                Penjualan</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-shop-window"></span><span class="mtext">Rekap Supplier</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-bag"></span><span class="mtext">Rekap Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-people"></span><span class="mtext">Rekap Buyer</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-building"></span><span class="mtext">Rekap Market
                                Research</span>
                        </a>
                    </li>
                @elseif (session('role_id') == 4)
                    <li>
                        <a href="{{ route('buyer.dashboard.index') }}"
                            class="dropdown-toggle no-arrow {{ Request::is('buyer/dashboard*') ? 'active' : '' }}">
                            <span class="micon bi bi-speedometer2"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-wallet2"></span><span class="mtext">Rekap
                                Tranksaksi</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-cash"></span><span class="mtext">Upload
                                Pembayaran</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
