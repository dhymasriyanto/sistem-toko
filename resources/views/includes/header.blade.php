<nav class="navbar navbar-expand navbar-light bg-white">
    <a class="sidebar-toggle d-flex mr-2">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle" data-feather="bell-off"></i>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        4 New Notifications
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row no-gutters align-items-center">
                                <div class="col-2">
                                    <i class="text-danger" data-feather="alert-circle"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Update completed</div>
                                    <div class="text-muted small mt-1">Restart server 12 to complete the update.</div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>

                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                    {{--                    <img src="" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood"> --}}
                    <span class="text-dark">
                        {{Auth::user()->name}} ({{Auth::user()->level_akses}})
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a style="color: deepskyblue" class="dropdown-item" href="/profiles/{{Auth::user()->id}}"><i
                            class="align-middle mr-1" data-feather="user"></i>Profil</a>
                    <div class="dropdown-divider"></div>
                    {{--                    <a class="dropdown-item" href="/logout">Keluar</a>--}}
                    <a style="color: red" class="dropdown-item" data-toggle="modal" data-target="#logoutModal"><i
                            class="align-middle mr-1" data-feather="log-out"></i>Logout</a>

                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warning!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <p class="mb-0">Yakin untuk keluar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a type="button" href="/logout" class="btn btn-danger">Yakin</a>
            </div>
        </div>
    </div>
</div>
