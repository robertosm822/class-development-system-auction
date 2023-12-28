<x-layout-front title="Início">

    <!--============= Account Section Starts Here =============-->
    <section class="account-section padding-bottom">
        <div class="container">
            <div class="account-wrapper mt--100 mt-lg--440">
                <div class="left-side">
                    <div class="section-header">
                        <h2 class="title">Olá</h2>
                        <p>Você pode fazer login na sua conta Lelou aqui.</p>
                    </div>
                    <!--
                    <ul class="login-with">
                        <li>
                            <a href="#0"><i class="fab fa-facebook"></i>Log in with Facebook</a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-google-plus"></i>Log in with Google</a>
                        </li>
                    </ul>
                    -->
                    <div class="or">
                        <span>Or</span>
                    </div>
                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-envelope"></i></label>
                            <input type="text" id="login-email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" id="login-pass" placeholder="Password">
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group">
                            <a href="#0">Esqueceu a senha?</a>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="custom-button">LOG IN</button>
                        </div>
                    </form>
                </div>
                <div class="right-side cl-white">
                    <div class="section-header mb-0">
                        <h3 class="title mt-0">NOVO AQUI?</h3>
                        <p>Cadastre-se e crie sua conta</p>
                        <a href="registrar-se.php" class="custom-button transparent">INSCREVER-SE</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Account Section Ends Here =============-->
</x-layout-front>