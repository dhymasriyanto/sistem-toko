<nav id="sidebar" class="sidebar">
    <div class="sidebar-content ">
        <a class="sidebar-brand" href="index.html">
            <img src="{{url('/appstack/img/brands/logo.png')}}" class="rounded-circle" alt="Logo"  width="30" height="30">
            <span class="align-middle">Sistem Toko Material</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>
            <li class="sidebar-item {{ Request::is('/')  ? 'active' : '' }}">
                <a href="{{url('/')}}"  class="sidebar-link" >
                    <i class="align-middle" data-feather="home"></i>
                    <span class="align-middle">Dashboard</span>
                </a>

            </li>
            <li class="sidebar-item {{ Request::is('employees')  ? 'active' : '' }}">
                <a href="{{url('/employees')}}"  class="sidebar-link" >
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Pengguna</span>
                </a>
            </li>
            <li class="sidebar-item {{ Request::is('stuffs')  ? 'active' : '' }}">
                <a href="{{url('/stuffs')}}"  class="sidebar-link" >
                    <i class="align-middle" data-feather="folder"></i>
                    <span class="align-middle">Persediaan</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="#transaksi" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Transaksi</span>
                </a>
                <ul id="transaksi" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Transaksi Masuk</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-buttons.html">Transaksi Keluar</a></li>

                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#riwayat" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="rotate-ccw"></i> <span class="align-middle">Riwayat</span>
                </a>
                <ul id="riwayat" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-alerts.html">Riwayat Transaksi</a></li>
                    <li class="sidebar-item"><a class="sidebar-link" href="ui-buttons.html">Riwayat Hutang</a></li>

                </ul>
            </li>
            <li class="sidebar-item {{ Request::is('/employees')  ? 'active' : '' }}">
                <a href="{{url('/employees')}}"  class="sidebar-link" >
                    <i class="align-middle" data-feather="trending-up"></i>
                    <span class="align-middle">Laporan</span>
                </a>
            </li>
        </ul>



    </div>
</nav>
