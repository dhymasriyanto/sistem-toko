<nav id="sidebar" class="sidebar">
    <div class="sidebar-content ">
        <a class="sidebar-brand" href="{{url('/')}}">
            <img src="{{asset('/appstack/img/brands/logo.png')}}" class="rounded-circle" alt="Logo"  width="30" height="30">
            <span class="align-middle">Sistem Toko Material</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Menu
            </li>
            <li class="sidebar-item {{ Request::is('/')  ? 'active' : '' }}">
                <a href="{{url('/')}}"  class="sidebar-link" >
                    <i class="align-middle" data-feather="home"></i>
                    <span class="align-middle">Beranda</span>
                </a>

            </li>
            <li class="sidebar-item {{ Request::is('users')  ? 'active' : '' }}">
                <a href="{{url('/users')}}"  class="sidebar-link" >
                    <i class="align-middle" data-feather="users"></i>
                    <span class="align-middle">Pengguna</span>
                </a>
            </li>
            <li class="sidebar-item ">
                <a href="#persediaan"  data-toggle="collapse" class="sidebar-link collapsed" >
                    <i class="align-middle" data-feather="folder"></i>
                    <span class="align-middle">Persediaan</span>
                </a>
                <ul id="persediaan" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item {{ Request::is('stuffs')  ? 'active' : '' }}"><a class="sidebar-link" href="{{url('/stuffs')}}">Inventori</a></li>
                    <li class="sidebar-item {{ Request::is('categories')  ? 'active' : '' }}"><a class="sidebar-link" href="{{url('/categories')}}">Kategori</a></li>
                    <li class="sidebar-item {{ Request::is('units')  ? 'active' : '' }}"><a class="sidebar-link" href="{{url('/units')}}">Satuan</a></li>

                </ul>
            </li>
            <li class="sidebar-item">
                <a href="#transaksi" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="shopping-cart"></i> <span class="align-middle">Transaksi</span>
                </a>
                <ul id="transaksi" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item {{ Request::is('in-transactions')  ? 'active' : '' }}"><a class="sidebar-link" href="{{url('/in-transactions')}}">Transaksi Masuk</a></li>
                    <li class="sidebar-item {{ Request::is('out-transactions')  ? 'active' : '' }}"><a class="sidebar-link" href="{{url('/out-transactions')}}">Transaksi Keluar</a></li>

                </ul>
            </li>

            <li class="sidebar-item">
                <a href="#riwayat" data-toggle="collapse" class="sidebar-link collapsed">
                    <i class="align-middle" data-feather="rotate-ccw"></i> <span class="align-middle">Riwayat</span>
                </a>
                <ul id="riwayat" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
                    <li class="sidebar-item {{ Request::is('histories')  ? 'active' : '' }}"><a class="sidebar-link" href="{{url('/histories')}}">Riwayat Transaksi</a></li>
                    <li class="sidebar-item {{ Request::is('debt-histories')  ? 'active' : '' }}"><a class="sidebar-link" href="{{url('/debt-histories')}}">Riwayat Hutang</a></li>

                </ul>
            </li>
            <li class="sidebar-item {{ Request::is('reports')  ? 'active' : '' }}">
                <a href="{{url('/reports')}}"  class="sidebar-link" >
                    <i class="align-middle" data-feather="trending-up"></i>
                    <span class="align-middle">Laporan</span>
                </a>
            </li>
        </ul>



    </div>
</nav>
