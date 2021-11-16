<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Korisnici</div>
                <a class="nav-link" href="/posts">
                    <div class="fas fa-newspaper"><i class="fas fa-tachometer-alt"></i></div>
                    Članci
                </a>
                @can('edit posts')
                <div class="sb-sidenav-menu-heading">Editor</div>
                <a class="nav-link" href="/postsAll">
                    <div class="far fa-newspaper"><i class="fas fa-tachometer-alt"></i></div>
                    Svi članci
                </a>
                @endcan
                @hasrole('admin')
                <div class="sb-sidenav-menu-heading">Admin</div>
                @can('edit posts')
                <a class="nav-link" href="/users">
                    <div class="fas fa-user-friends"><i class="fas fa-tachometer-alt"></i></div>
                    Korisnici
                </a>
                @endcan
                @can('edit posts')
                <a class="nav-link" href="/categories">
                    <div class="fas fa-tags"><i class="fas fa-tachometer-alt"></i></div>
                    Kategorije
                </a>
                @endcan
                @endhasrole
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{auth()->user()->username}}
        </div>
    </nav>
</div>