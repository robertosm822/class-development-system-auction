<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title }} - Leilões Online</title>

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.css">
    <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/owl.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/js/jquery-ui2.min.js')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
    <!--============= ScrollToTop Section Starts Here =============-->
    <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
    <div class="overlay"></div>
    <!--============= ScrollToTop Section Ends Here =============-->


    <!--============= Header Section Starts Here =============-->
    <div class="overlayer" id="overlayer">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>
    <header>
        <div class="header-top">
            <div class="container">
                <div class="header-top-wrapper">
                    <ul class="customer-support">
                        <li>
                            <a href="#0" class="mr-3"><i class="fa fa-phone-alt"></i><span class="ml-2 d-none d-sm-inline-block">Suporte ao Cliente</span></a>
                        </li>
                        <!--
                        <li>
                            <i class="fas fa-globe"></i>
                            <select name="language" class="select-bar">
                                <option value="en">En</option>
                                <option value="Bn">Bn</option>
                                <option value="Rs">Rs</option>
                                <option value="Us">Us</option>
                                <option value="Pk">Pk</option>
                                <option value="Arg">Arg</option>
                            </select>
                        </li>
                        -->
                    </ul>
                    @guest
                        <ul class="cart-button-area">

                            <li>
                                <a title="Entrar" href="{{ route('login') }}"  class="user-button"><i class="flaticon-user"></i> </a>
                            </li>
                        </ul>
                    @else
                        <ul class="cart-button-area">

                            <li>
                                
                                <a title="Sair" href="{{ route('logout') }}"   onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="user-button"><i class="flaticon-user"></i> </a>
                        
                            </li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo">
                        <a href="{{url('/')}}">
                            <img src="{{asset('assets/images/logo/logo.png')}}" alt="logo">
                        </a>
                    </div>
                    <ul class="menu ml-auto">
                        <li>
                            <a href="{{url('/')}}">Home</a>

                        </li>

                        <li>
                            <a href="#0">Paginas de Exemplo</a>
                            <ul class="submenu">

                                <li>
                                    <a href="#0">Acessos</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="#/registrar-se.php">Sign Up</a>
                                        </li>
                                        <li>
                                            <a href="#/entrar.php">Sign In</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#0">Dashboard</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="{{url('/admin')}}">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="#/admin/profile.php">Perfil</a>
                                        </li>
                                        <li>
                                            <a href="#/admin/admin-meus-lances.php">Meus Lances</a>
                                        </li>
                                        <li>
                                            <a href="#/admin/admin-lances-vencedores.php">Lances Vencedores</a>
                                        </li>
                                        <li>
                                            <a href="#/admin/admin-config-notification.php">Meus Alertas</a>
                                        </li>
                                        <li>
                                            <a href="#/admin/admin-favorites.php">Meus Favoritos</a>
                                        </li>

                                    </ul>
                                </li>
                                <li>
                                    <a href="./sobre.php">About Us</a>
                                </li>
                                <li>
                                    <a href="./faqs.php">Faqs</a>
                                </li>
                                <li>
                                    <a href="./404-error.php">404 Error</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="./contato.php">Contato</a>
                        </li>
                    </ul>
                    <form class="search-form">
                        <input type="text" placeholder="Search for brand, model....">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </form>
                    <div class="search-bar d-md-none">
                        <a href="#0"><i class="fas fa-search"></i></a>
                    </div>
                    <div class="header-bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--============= Header Section Ends Here =============-->

    {{ $slot }}

    <!--============= Footer Section Starts Here =============-->
    <footer class="bg_img padding-top oh" data-background="{{asset('assets/images/footer/footer-bg.jpg')}}">
        <div class="footer-top-shape">
            <img src="{{asset('assets/css/img/footer-top-shape.png')}}" alt="css">
        </div>

        <div class="newslater-wrapper">
            <div class="container">
                <div class="newslater-area">
                    <div class="newslater-thumb">
                        <img src="{{asset('assets/images/footer/newslater.png')}}" alt="footer">
                    </div>
                    <div class="newslater-content">
                        <div class="section-header left-style mb-low">
                            <h5 class="cate">Inscreva-se no LELOU</h5>
                            <h3 class="title">Para Obter Benefícios Exclusivos</h3>
                        </div>
                        <form class="subscribe-form">
                            <input type="text" placeholder="Digite o seu E-mail" name="email">
                            <button type="submit" class="custom-button">INSCREVER-SE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-top padding-bottom padding-top">
            <div class="container">
                <div class="row mb--60">
                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-widget widget-follow">
                            <h5 class="title">Follow Us</h5>
                            <ul class="links-list">
                                <li>
                                    <a href="#0"><i class="fas fa-phone-alt"></i>(646) 663-4575</a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fas fa-blender-phone"></i>(646) 968-0608</a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fas fa-envelope-open-text"></i><span class="__cf_email__" data-cfemail="244c41485464414a434b504c4149410a474b49">[email&#160;protected]</span></a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fas fa-location-arrow"></i>1201 Broadway Suite</a>
                                </li>
                            </ul>
                            <ul class="social-icons">
                                <li>
                                    <a href="#0" class="active"><i class="fab fa-facebook-f"></i></a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fab fa-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#0"><i class="fab fa-linkedin-in"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="copyright-area">
                    <div class="footer-bottom-wrapper">
                        <div class="logo">
                            <a href="index.php"><img src="{{asset('assets/images/logo/footer-logo.png')}}" alt="logo"></a>
                        </div>
                        <ul class="gateway-area">
                            <li>
                                <a href="#0"><img src="{{asset('assets/images/footer/paypal.png')}}" alt="footer"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="{{asset('assets/images/footer/visa.png')}}" alt="footer"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="{{asset('assets/images/footer/discover.png')}}" alt="footer"></a>
                            </li>
                            <li>
                                <a href="#0"><img src="{{asset('assets/images/footer/mastercard.png')}}" alt="footer"></a>
                            </li>
                        </ul>
                        <div class="copyright"><p>&copy; Copyright 2023 | <a href="#0">LELOU</a> By <a href="https://api.whatsapp.com/send?phone=5521981988134" target="_blank">Roberto S. Melo</a></p></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--============= Footer Section Ends Here =============-->

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('assets/js/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.3/js/bootstrap.min.js"></script>
    <script src="{{asset('assets/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/waypoints.js')}}"></script>
    <script src="{{asset('assets/js/nice-select.js')}}"></script>
    <script src="{{asset('assets/js/counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/owl.min.js')}}"></script>
    <script src="{{asset('assets/js/magnific-popup.min.js')}}"></script>
    <script src="{{asset('assets/js/yscountdown.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/js/main.js')}}"></script>
</body>

</html>
