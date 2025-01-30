<header class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm sticky-top ">
    <div class="container-fluid">
        <a class="navbar-dark d-flex align-items-center text-light">
            <span class="fs-6 fw-bold">e-Tiket Wisata</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item me-3 text-white">
                    <span class="fs-6">Halo, <strong>{{ Auth::user()->name }}</strong></span>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm" href="{{ route('dologout') }}"
                        onclick="event.preventDefault(); if(confirm('Yakin ingin keluar?')) {document.getElementById('logout-form').submit();} else{return false;}">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                    <form id="logout-form" action="{{ route('dologout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>