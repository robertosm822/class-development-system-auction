<x-layout-front title="Cadastrar Produto">
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
    .filenames-active{
        border-radius: 9px;border: 1px solid silver;padding: 10px;
    }
    .h4-arquivos {
        font-size: 16px;
    }
    /*
        Alert Bootstrap fake
    */
    .alert-danger {
        padding: 1rem; /* Espaçamento interno */
        margin-bottom: 1rem; /* Espaçamento externo na parte inferior */
        border: 1px solid #f5c6cb; /* Cor da borda */
        border-radius: 0.25rem; /* Borda arredondada */
        background-color: #f8d7da; /* Cor de fundo */
        color: #721c24; /* Cor do texto */
    }
    .alert-danger .close {
        background: transparent;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        color: #721c24;
        float: right;
        padding-bottom: 26px;
        padding-left: 12px;
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
                <a href="#0">Produtos | Anúcios</a>
            </li>
            <li>
                <span>Cadastrar</span>
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

                            @if ($errors->any())

                                <div class="alert-danger">
                                    <button class="close" onclick="this.parentElement.style.display='none'">&times;</button>
                                    ⚠️ <strong>Atenção!</strong> {{ $errors->first() }}
                                  </div>
                            @endif

                            @if(Session::get('errorUpdate'))
                                <div class="alert alert-danger">
                                    {{ Session::get('errorUpdate') }}
                                </div>
                            @endif


                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">

                                    <h4 class="title">Cadastrar Imagens:</h4>
                                    <!-- <span class="edit"><i data-toggle="modal" data-target="#modalPersonalDetails" class="flaticon-edit"></i> Editar</span> -->
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Escolha</div>
                                        <div class="info-value">
                                            <input type="file" name="files[]"  form="formAnnoucement"  id="inputFile" multiple  class="form-control @error('files') is-invalid @enderror">

                                            @error('files')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </li>
                                    <li>
                                        <div class="info-value" style="width: 100%;">
                                            <div class="filenames"></div>
                                        </div>
                                    </li>


                                </ul>
                            </div>


                        </div>
                        <form action="{{route('upload.files')}}" method="post" enctype="multipart/form-data" style="width: 100%;" id="formAnnoucement">
                            @csrf
                            <div class="col-12">
                                <div class="dash-pro-item mb-30 dashboard-widget">
                                    <div class="header">
                                        <h4 class="title">Categoria</h4>
                                        <!-- <span class="edit"><i class="flaticon-edit" data-toggle="modal" data-target="#modalPersonalPhone"></i> Editar</span> -->
                                    </div>
                                    <ul class="dash-pro-body">
                                        <li>
                                            <div class="info-name">Escolha</div>
                                            <div class="info-value">
                                                <select name="category_id" id="category_id">
                                                    @foreach($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </li>
                                    </ul>
                                    <input type="hidden" name="announcement_id" value="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="dash-pro-item dashboard-widget">
                                    <div class="header">
                                        <h4 class="title">Informações do Produto | Ativo</h4>
                                        <!-- <span class="edit"><i class="flaticon-edit" data-toggle="modal" data-target="#modalPersonalPassword"></i> Editar</span> -->
                                    </div>
                                    <ul class="dash-pro-body">
                                        <li>
                                            <div class="info-name">Título:</div>
                                            <div class="info-value">
                                                <input class="form-control" type="text" name="title" id="title" required>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="info-name">Descrição</div>
                                            <div class="info-value">
                                                <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="info-name">Preço Inicial</div>
                                            <div class="info-value">
                                            <input class="form-control" type="number" name="current_price" id="current_price" required>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="info-name">Incremento</div>
                                            <div class="info-value">
                                                <input type="number" name="product_bid_increment" id="product_bid_increment" value="100.00" placeholder="100.00" required>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="info-name">Inicia em</div>
                                            <div class="info-value">
                                                <input type="datetime-local" name="date_started" id="date_started" placeholder="dd/mm/YYYY" required>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="info-name">Expira em</div>
                                            <div class="info-value">
                                                <input type="datetime-local" name="date_expiration" id="date_expiration" placeholder="dd/mm/YYYY" required>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group" style="width: 100%;">
                                                <label>Atributos do Produto</label>
                                                <div id="attributes-container">

                                                        <div class="attribute-row">
                                                            <input type="text" name="attributes[${index}][name]" class="form-control input-attributes-add" placeholder="Nome do atributo" required>
                                                                <input type="text" name="attributes[${index}][value]" class="form-control input-attributes-add" placeholder="Valor do atributo" required>
                                                                <button type="button" class="btn-attributes btn btn-danger remove-attribute"><i class="small material-icons small-white">delete_chart</i> <div class="txt-excluir-attr">Excluir</div></button>
                                                        </div>

                                                </div>
                                                <button type="button" class="btn btn-success btn-attributes-add" id="add-attribute">

                                                    <div class="add-icon-circle"><i class="small material-icons small-white">add_circle</i></div>
                                                    <div>Adicionar Novo Atributo</div>
                                                </button>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="info-name">Status</div>
                                            <div class="info-value">
                                                <select name="status" id="status">
                                                    <option value="active">Ativo</option>
                                                    <option value="inactive">Inativo | Desabilitado</option>
                                                </select>
                                            </div>
                                        </li>
                                        <li>

                                                <button type="submit" class="btn-info" style="margin-top: 20px;">CADASTRAR</button>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>
<!--============= Dashboard Section Ends Here =============-->
<script>

//recurso visual para mostrar quais arquivos foram selecionados
setTimeout(() => {
    $('input[name="files[]"]').change(function(){
        $('.filenames').html('<br><h4 class="h4-arquivos">Arquivos selecionados:</h4><hr>');
        for(var i = 0 ; i < this.files.length ; i++){
            const fileName = this.files[i].name;
            console.log(fileName);
            $('.filenames').addClass('filenames-active');
            $('.filenames').append('<div class="name">' + fileName + '</div>');
        }
    });
}, 1000);


document.addEventListener("DOMContentLoaded", function () {
    const attributesContainer = document.getElementById("attributes-container");
    const addAttributeBtn = document.getElementById("add-attribute");

    addAttributeBtn.addEventListener("click", function () {
        const index = attributesContainer.children.length;
        const attributeRow = document.createElement("div");
        attributeRow.classList.add("attribute-row");
        attributeRow.innerHTML = `
            <input type="text" name="attributes[${index}][name]" class="form-control input-attributes-add" placeholder="Nome do atributo" required>
            <input type="text" name="attributes[${index}][value]" class="form-control input-attributes-add" placeholder="Valor do atributo" required>
            <button type="button" class="btn-attributes btn btn-danger remove-attribute"><i class="small material-icons small-white">delete_chart</i> <div class="txt-excluir-attr">Excluir</div></button>
        `;
        attributesContainer.appendChild(attributeRow);
    });

    attributesContainer.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-attribute")) {
            event.target.parentElement.remove();
        }
    });
});


</script>
</x-layout-front>
