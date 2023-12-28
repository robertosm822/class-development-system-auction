<div class="col-sm-10 col-md-7 col-lg-4">
    <div class="dashboard-widget mb-30 mb-lg-0">
        <div class="user">
            <div class="thumb-area">
                <div class="thumb">
                    <img src="../assets/css/img/user_default.png" alt="user">
                </div>
                <label for="profile-pic" class="profile-pic-edit"><i class="flaticon-pencil"></i></label>
                <input type="file" id="profile-pic" class="d-none">
            </div>
            <div class="content">
                <h5 class="title"><a href="#0">{{ Auth::user()->name; }}</a></h5>
                <span class="username"><a href="#mudar-plano" class="__cf_email__">[PERFIL ANUNCIANTE]</a></span>
            </div>
        </div>
        <ul class="dashboard-menu">
            <li>
                <a href="{{url('/admin')}}" class="active"><i class="flaticon-dashboard"></i>Dashboard</a>
            </li>
            <li>
                <a href="./profile.php"><i class="flaticon-settings"></i>Perfil Pessoal </a>
            </li>
            <li>
                <a href="admin-meus-lances.php"><i class="flaticon-auction"></i>Meus Lances</a>
            </li>
            <li>
                <a href="admin-lances-vencedores.php"><i class="flaticon-best-seller"></i>Lances Vencedores</a>
            </li>
            <li>
                <a href="admin-config-notification.php"><i class="flaticon-alarm"></i>Meus Alertas</a>
            </li>
            <li>
                <a href="admin-favorites.php"><i class="flaticon-star"></i>Meus Favoritos</a>
            </li>

        </ul>
    </div>
</div>
