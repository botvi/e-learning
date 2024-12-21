<ul class="metismenu" id="menu">
    <li class="menu-label">DASHBOARD</li>
    <li>
        <a href="/dashboard">
            <div class="parent-icon"><i class='bx bx-home-circle'></i></div>
            <div class="menu-title">DASHBOARD</div>
        </a>
    </li>
    @if (Auth::user()->role == 'admin')
    <li>
        <a href="/kelas">
            <div class="parent-icon"><i class='bx bxs-home-smile'></i></div>
            <div class="menu-title">MASTER KELAS</div>
        </a>
    </li>
    <li>
        <a href="/siswa">
            <div class="parent-icon"><i class='bx bx-user-circle'></i></div>
            <div class="menu-title">MASTER SISWA</div>
        </a>
    </li>
    <li>
        <a href="/guru">
            <div class="parent-icon"><i class='bx bx-user-circle'></i></div>
            <div class="menu-title">MASTER GURU</div>
        </a>
    </li>
    <li>
        <a href="/mata_pelajaran">
            <div class="parent-icon"><i class='bx bx-note' ></i></div>
            <div class="menu-title">MATA PELAJARAN</div>
        </a>
    </li>
  
    @endif

    @if (Auth::user()->role == 'guru')
    <li>
        <a href="/master_modul">
            <div class="parent-icon"><i class='bx bx-file'></i></div>
            <div class="menu-title">MODUL</div>
        </a>
    </li>
    <li>
        <a href="/ujian">
            <div class="parent-icon"><i class='bx bx-file'></i></div>
            <div class="menu-title">UJIAN</div>
        </a>
    </li>
   
    <li>
        <a href="/hasil_ujian">
            <div class="parent-icon"><i class='bx bx-file'></i></div>
            <div class="menu-title">HASIL UJIAN</div>
        </a>
    </li>
    @endif  
</ul>
