<nav class="col-md-2 bg-dark sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Route::is('home') ? 'active' : '' }} text-white" href="{{ route('home') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('member') ? 'active' : '' }} text-white" href="{{ route('member') }}">
                    <span data-feather="users"></span>
                    Data Member
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('buku') ? 'active' : '' }} text-white" href="{{ route('buku') }}">
                    <span data-feather="book"></span>
                    Data Buku
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::is('pinjam') ? 'active' : '' }} text-white" href="{{ route('pinjam') }}">
                    <span data-feather="file"></span>
                    Peminjaman
                </a>
            </li>
            @auth
                @if(Auth::user()->jenis === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('pengembalian') ? 'active' : '' }} text-white" href="{{ route('pengembalian') }}">
                        <span data-feather="check-circle"></span>
                        Pengembalian
                    </a>
                </li>
                @endif
            @endauth
            <li class="nav-item">
                <a class="nav-link {{ Route::is('kategori') ? 'active' : '' }} text-white" href="{{ route('kategori') }}">
                    <span data-feather="tag"></span>
                    Kategori
                </a>
            </li>
            @auth
                @if(Auth::user()->jenis === 'admin')
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('user') ? 'active' : '' }} text-white" href="{{ route('user') }}">
                        <span data-feather="user"></span>
                        Data User
                    </a>
                </li>
                @endif
            @endauth
        </ul>
    </div>
</nav>
