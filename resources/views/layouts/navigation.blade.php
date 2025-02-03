<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{request()->is('dashboard') ? 'active' : ''}}" aria-current="page"
                    href="/dashboard">
                    <span data-feather="home" class="align-text-bottom"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{request()->is('user*') ? 'active' : ''}}" href="/user">
                    <span data-feather="users" class="align-text-bottom"></span>
                    User
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link {{request()->is('produk*') ? 'active' : ''}}" href="/produk">
                    <span data-feather="box" class="align-text-bottom"></span>
                    Produk
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{request()->is('transaksi*') ? 'active' : ''}}" href="/transaksi">
                    <span data-feather="shopping-cart" class="align-text-bottom"></span>
                    Transaksi
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link {{request()->is('profile*') ? 'active' : ''}}" href="/profile">
                    <span data-feather="user" class="align-text-bottom"></span>
                    Profile
                </a>
            </li>
        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>reports</span>
        </h6>

        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="/user-export">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    User
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="/produk-export">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Produk
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="/transaksi-export">
                    <span data-feather="file-text" class="align-text-bottom"></span>
                    Transaksi
                </a>
            </li>

        </ul>
    </div>
</nav>