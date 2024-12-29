<header class="header fixed-top" id="header">

    <div class="branding d-flex align-items-cente">

        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a class="logo d-flex align-items-center" href="index.html">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img alt="" src="assets/img/logo.png"> -->
                <h1 class="sitename">E-Learning</h1>
                <span>.</span>
            </a>

            <nav class="navmenu" id="navmenu">
                <ul>
                    <li><a href="/">Home<br></a></li>
                    <li><a href="/siswa/modul">Modul Pembelajaran</a></li>
                    <li><a href="/siswa/ujian">Ujian</a></li>
                    <li><a href="/siswa/hasil-ujian">Hasil Ujian</a></li>
                    @if (Auth::check())
                        <li><a class="btn-get-started" href="/logout"><span>{{ Auth::user()->nama }}</span> | Logout</a>
                        </li>
                    @else
                        <li><a class="btn-get-started" href="/login">Login</a></li>
                    @endif
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>

    </div>

</header>
