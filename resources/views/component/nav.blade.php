<nav class="navbar navbar-expand-lg shadow fixed-top" style="background:#fff">
    <a class="navbar-brand d-flex align-items-center" href="#">
        <div class="ms-3">
            <strong class="fs-3">Gas Magang </strong>
            <p class="fs-1">Ayo ! cari pengalaman magangmu</p>
        </div>
    </a>





    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <li class="nav-item dropdown">
                <a class="nav-link btn btn-dark nav-icon-hover" href="javascript:void(0)" id="drop2"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Username : {{ auth()->user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                    <div class="message-body">
                        <a href="{{route('password')}}" class="d-flex align-items-center gap-2 dropdown-item">
                            <i class="ti ti-user fs-6"></i>
                            <p class="mb-0 fs-3">Ubah password</p>
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="bi bi-box-arrow-right fs-6"></i>
                                <p class="mb-0 fs-3">Logout</p>
                            </button>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>


@include('auth.__modal')
