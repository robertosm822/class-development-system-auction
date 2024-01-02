<x-layout-front title="Dashboard">
<style>
    .modal-backdrop.fade.show{
        z-index: 100;
    }
    .modal-title{
        font-size: 18px;
        float: left !important;
    }
    button.close{

        float: right;
        width: 50px;
        padding-right: 38px;
        margin-bottom: -9px;

    }
</style>
<div class="cart-sidebar-area">

<div class="top-content">
        <a href="index.html" class="logo">
            <img src="{{asset('assets/images/logo/logo2.png')}}" alt="logo">
        </a>
        <span class="side-sidebar-close-btn"><i class="fas fa-times"></i></span>
    </div>
    <div class="bottom-content">
        <div class="cart-products">
            <h4 class="title">Shopping cart</h4>
            <div class="single-product-item">
                <div class="thumb">
                    <a href="#0"><img src="{{asset('assets/images/shop/shop01.jpg')}}" alt="shop"></a>
                </div>
                <div class="content">
                    <h4 class="title"><a href="#0">Color Pencil</a></h4>
                    <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                    <a href="#" class="remove-cart">Remove</a>
                </div>
            </div>
            <div class="single-product-item">
                <div class="thumb">
                    <a href="#0"><img src="{{asset('assets/images/shop/shop02.jpg')}}" alt="shop"></a>
                </div>
                <div class="content">
                    <h4 class="title"><a href="#0">Water Pot</a></h4>
                    <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                    <a href="#" class="remove-cart">Remove</a>
                </div>
            </div>
            <div class="single-product-item">
                <div class="thumb">
                    <a href="#0"><img src="{{asset('assets/images/shop/shop03.jpg')}}" alt="shop"></a>
                </div>
                <div class="content">
                    <h4 class="title"><a href="#0">Art Paper</a></h4>
                    <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                    <a href="#" class="remove-cart">Remove</a>
                </div>
            </div>
            <div class="single-product-item">
                <div class="thumb">
                    <a href="#0"><img src="{{asset('assets/images/shop/shop04.jpg')}}" alt="shop"></a>
                </div>
                <div class="content">
                    <h4 class="title"><a href="#0">Stop Watch</a></h4>
                    <div class="price"><span class="pprice">$80.00</span> <del class="dprice">$120.00</del></div>
                    <a href="#" class="remove-cart">Remove</a>
                </div>
            </div>
            <div class="single-product-item">
                <div class="thumb">
                    <a href="#0"><img src="{{asset('assets/images/shop/shop05.jpg')}}" alt="shop"></a>
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
<div class="hero-section style-2">
    <div class="container">
        <ul class="breadcrumb">
            <li>
                <a href="./index.php">Home</a>
            </li>
            <li>
                <a href="#0">Minha Conta</a>
            </li>
            <li>
                <span>Perfil</span>
            </li>
        </ul>
    </div>
    <div class="bg_img hero-bg bottom_center" data-background="{{asset('assets/images/banner/hero-bg.png')}}"></div>
</div>
<!--============= Hero Section Ends Here =============-->
<!--============= Dashboard Section Starts Here =============-->

    <section class="dashboard-section padding-bottom mt--240 mt-lg--440 pos-rel">
        <div class="container">
            <div class="row justify-content-center">

            @include('admin.admin-left-menu')

                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            @if(Session::get('success') )
                                <div class="alert alert-success">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            @if(Session::get('errorUpdate'))
                                <div class="alert alert-danger">
                                    {{ Session::get('errorUpdate') }}
                                </div>
                            @endif
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    
                                    <h4 class="title">Dados Pessoais</h4>
                                    <span class="edit"><i data-toggle="modal" data-target="#modalPersonalDetails" class="flaticon-edit"></i> Editar</span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Nome</div>
                                        <div class="info-value">{{ Auth::user()->name}}</div>
                                    </li>
                                    <!--
                                    <li>
                                        <div class="info-name">Date of Birth</div>
                                        <div class="info-value">...</div>
                                    </li>
                                    -->
                                    <li>
                                        <div class="info-name">Endereço</div>
                                        <div class="info-value">
                                        @foreach ($address as $value)
                                          Rua: {{ $value->street }}, Número: {{ $value->number}}<br />
                                          {{$value->district}} - {{$value->city}} / {{$value->state}} <br />
                                          CEP: {{ $value->zip_code }}
                                        @endforeach
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            
                        </div>
                        <!--
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Account Settings</h4>
                                    <span class="edit"><i class="flaticon-edit"></i> Editar</span>
                                </div>
                                <ul class="dash-pro-body">

                                    <li>
                                        <div class="info-name">Time Zone</div>
                                        <div class="info-value">(GMT-06:00) Central America</div>
                                    </li>
                                    <li>
                                        <div class="info-name">Status</div>
                                        <div class="info-value"><i class="flaticon-check text-success"></i> Active</div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Email Address</h4>
                                    <span class="edit"><i class="flaticon-edit"></i> Editar</span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Email</div>
                                        <div class="info-value"><a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="3f5e535d5a4d4b0c0b067f58525e5653115c5052">[email&#160;protected]</a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Telefone</h4>
                                    <span class="edit"><i class="flaticon-edit"></i> Editar</span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Celular</div>
                                        <div class="info-value">
                                            {{  (isset($actor['phone']))? $actor['phone'] : '' }}
                                            {{ (isset($seller['phone']))? $seller['phone'] : '' }}
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dash-pro-item dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Security</h4>
                                    <span class="edit"><i class="flaticon-edit"></i> Editar</span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Password</div>
                                        <div class="info-value">xxxxxxxxxxxxxxxx</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<!--============= Dashboard Section Ends Here =============-->
<!-- modalPersonalDetails -->
<div id="modalPersonalDetails" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Editar Dados Pessoais</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            
        </div>
        <div class="modal-body">
            @if(Session::get('success') )
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <form class="form-horizontal" method="post" action="{{ route('updateAddress')}}">
                @csrf    
                <div class="form-group mb-30">
                    <label for="Endereco">Endereço:</label>
                </div>
                <div class="form-group mb-30">
                    <label for="cep"></label>
                    <input type="hidden" name="id" value="{{(isset($address[0]['id']))? $address[0]['id'] : ''}}">
                    <input type="text" id="cep" name="zip_code" value="{{(isset($address[0]['zip_code']))? $address[0]['zip_code'] : ''}}" placeholder="CEP" required>
                </div>
                <div class="form-group mb-30">
                    <label for="logradouro"></label>
                    <input type="text" id="logradouro" name="street" value="{{(isset($address[0]['street']))? $address[0]['street'] : ''}}" placeholder="Endereço" required>
                </div>
                <div class="form-group mb-30">
                    <label for="Numero"></label>
                    <input type="text" id="numero" name="number" value="{{(isset($address[0]['number']))? $address[0]['number'] : ''}}" placeholder="Número" required>
                </div>
                <div class="form-group mb-30">
                    <label for="bairro"></label>
                    <input type="text" id="bairro" name="district" value="{{(isset($address[0]['district']))? $address[0]['district'] : ''}}" placeholder="Bairro" required>
                </div>
                <div class="form-group mb-30">
                    <label for="cidade"></label>
                    <input type="text" id="cidade" name="city" value="{{(isset($address[0]['city']))? $address[0]['city'] : ''}}" placeholder="Cidade" required>
                </div>
                <div class="form-group mb-30">
                    <label for="estado"></label>
                    <input type="text" id="estado" name="state" value="{{(isset($address[0]['state']))? $address[0]['state'] : ''}}" placeholder="Estado" required>
                </div>
                <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success">ATUALIZAR</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            
        </div>
        </div>

    </div>
</div>
    
</x-layout-front>