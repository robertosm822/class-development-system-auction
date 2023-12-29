<x-layout-front title="Logar-se">

    <!--============= Cart Section Starts Here =============-->
    <div class="cart-sidebar-area">
        <div class="top-content">
            <a href="index.html" class="logo">
                <img src="./assets/images/logo/logo2.png" alt="logo">
            </a>
            <span class="side-sidebar-close-btn"><i class="fas fa-times"></i></span>
        </div>
        <div class="bottom-content">
            <div class="cart-products">
                <h4 class="title">Shopping cart</h4>
                <div class="single-product-item">
                    <div class="thumb">
                        <a href="#0"><img src="assets/images/shop/shop01.jpg" alt="shop"></a>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="#0">Color Pencil</a></h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="single-product-item">
                    <div class="thumb">
                        <a href="#0"><img src="assets/images/shop/shop02.jpg" alt="shop"></a>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="#0">Water Pot</a></h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="single-product-item">
                    <div class="thumb">
                        <a href="#0"><img src="assets/images/shop/shop03.jpg" alt="shop"></a>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="#0">Art Paper</a></h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="single-product-item">
                    <div class="thumb">
                        <a href="#0"><img src="assets/images/shop/shop04.jpg" alt="shop"></a>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="#0">Stop Watch</a></h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="single-product-item">
                    <div class="thumb">
                        <a href="#0"><img src="assets/images/shop/shop05.jpg" alt="shop"></a>
                    </div>
                    <div class="content">
                        <h4 class="title"><a href="#0">Comics Book</a></h4>
                        <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                        <a href="#" class="remove-cart">Remove</a>
                    </div>
                </div>
                <div class="btn-wrapper text-center">
                    <a href="#0" class="custom-button"><span>Checkout</span></a>
                </div>
            </div>
        </div>
    </div>
    <!--============= Cart Section Ends Here =============-->


    <!--============= Hero Section Starts Here =============-->
    <div class="hero-section">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="./index.php">Home</a>
                </li>
                <li>
                    <a href="#0">Pages</a>
                </li>
                <li>
                    <span>INSCREVER-SE</span>
                </li>
            </ul>
        </div>
        <div class="bg_img hero-bg bottom_center" data-background="./assets/images/banner/hero-bg.png"></div>
    </div>
    <!--============= Hero Section Ends Here =============-->


    <!--============= Account Section Starts Here =============-->
    <section class="account-section padding-bottom">
        <div class="container">
            <div class="account-wrapper mt--100 mt-lg--440">
                <div class="left-side">
                    <div class="section-header">
                        <h2 class="title">INSCREVER-SE</h2>
                        <p>Estamos felizes por você estar aqui!</p>
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                                @php
                                    Session::forget('success');
                                @endphp
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Oops!</strong> Parece que faltou informações para completar o seu cadastro.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <ul class="login-with">
                        <li id="participante-cad">
                            <a onclick="selecionarParticipante('participante-cad')" href="#0"><!-- <i class="fab fa-facebook"></i> -->Participar realizando lances?</a>
                        </li>
                        <li id="anunciante-cad">
                            <a onclick="selecionarAnunciante('anunciante-cad')" href="#0"><!-- <i class="fab fa-google-plus">--></i>Anunciar um produto para lance?</a>
                        </li>
                        
                    </ul>
                    <div class="or">
                        <span> Dados necessários: </span>
                    </div>
                    <form class="login-form" method="POST" action="{{ route('register-user') }}">
                        @csrf
                        <div class="form-group mb-30">
                            <label for="name-email"><i class="far fa-user"></i></label>
                            <input type="text" id="name" name="name" placeholder="Nome completo">

                            <input type="hidden" name="user_type_login" value="">
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-envelope"></i></label>
                            <input type="text" id="login-email" name="email" placeholder="Email Address">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-30">
                            <label for="telefone"><i class="fa fa-phone" aria-hidden="true"></i></label>
                            <input type="text" id="telefone" placeholder="Telefone / Celular">
                        </div>
                        <div class="form-group mb-30">
                            <label for="cep"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                            <input type="text" id="cep" placeholder="CEP">
                        </div>
                        <div class="form-group mb-30">
                            <label for="logradouro"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                            <input type="text" id="logradouro" placeholder="Endereço">
                        </div>
                        <div class="form-group mb-30">
                            <label for="Numero"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                            <input type="text" id="numero" placeholder="Número">
                        </div>
                        <div class="form-group mb-30">
                            <label for="bairro"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                            <input type="text" id="bairro" placeholder="Bairro">
                        </div>
                        <div class="form-group mb-30">
                            <label for="cidade"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                            <input type="text" id="cidade" placeholder="Cidade">
                        </div>
                        <div class="form-group mb-30">
                            <label for="estado"><i class="fa fa-map-marker" aria-hidden="true"></i></label>
                            <input type="text" id="estado" placeholder="Estado">
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" name="password" id="login-pass" placeholder="Senha">
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-30">
                            <label for="c-password"><i class="fas fa-lock"></i></label>
                            <input type="password" name="c-password" id="confirm-pass" placeholder="Confirme a senha">
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group checkgroup mb-30">
                            <input type="checkbox" name="terms" id="check"><label for="check">Aceito os termos e política de privacidade do site.</label>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="custom-button">LOG IN</button>
                        </div>
                    </form>
                </div>
                <div class="right-side cl-white">
                    <div class="section-header mb-0">
                        <h3 class="title mt-0">JÁ TEM UMA CONTA?</h3>
                        <p>Faça o login e vá para o seu Painel.</p>
                        <a href="entrar.php" class="custom-button transparent">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= Account Section Ends Here =============-->

    <script>
        function selecionarAnunciante(tipo){
            console.log(tipo);
            if(tipo === 'anunciante-cad') {
                
                $('#'+tipo).css('background-color', '#6fb578');
                $('#participante-cad').css('background-color', '#fff');
                $('input[name="user_type_login"]').val('anunciante');
            }
            
        }
        function selecionarParticipante(tipo){
            if(tipo === 'participante-cad'){
                $('#participante-cad').css('background-color', '#6fb578');
                $('#anunciante-cad').css('background-color', '#fff');
                $('input[name="user_type_login"]').val('participante');
            } 
            
        }
        //definir cadastro default
        setTimeout(() => {
            selecionarParticipante('participante-cad');
        }, 1000);
        
    </script>
</x-layout-front>