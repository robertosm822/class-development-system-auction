<x-layout-front title="Gerenciar Produtos">
    <style scoped>
        .custom-close-btn {
            width: 20px; /* Ajusta o tamanho */
            height: 20px;
            background-color: transparent; /* Mantém fundo transparente */
            border: none;
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0.8;
        }

        .custom-close-btn:hover {
            opacity: 1;
            transform: scale(1.1); /* Efeito de leve aumento ao passar o mouse */
        }

    </style>
    <!--============= BreadCamps Section Starts Here =============-->
    <div class="hero-section style-2 pb-lg-400">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                    <a href="/admin/">Admin</a>
                </li>
                <li>
                    <span>Editar Produtos</span>
                </li>
            </ul>
        </div>
        <div class="bg_img hero-bg bottom_center" data-background="{{asset('assets/images/banner/hero-bg.png')}}"></div>
    </div>
    <!--============= BreadCamps Section Ends Here =============-->


    <!--============= Dashboard Section Starts Here =============-->
    <section class="dashboard-section padding-bottom mt--240 mt-lg--325 pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                <div class="dashboard-widget" style="width: 83%; margin-bottom:10px">
                    <div class="dashboard-purchasing-tabs">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-12" style="padding: 10px; float: right;">
                                    <a href="/admin/list-products"  style="float: right;">
                                        <svg fill="#5e3dff" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" style="width: 25px;" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 46.032 46.033" xml:space="preserve" stroke="#5e3dff"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M8.532,18.531l8.955-8.999c-0.244-0.736-0.798-1.348-1.54-1.653c-1.01-0.418-2.177-0.185-2.95,0.591L1.047,20.479 c-1.396,1.402-1.396,3.67,0,5.073l11.949,12.01c0.771,0.775,1.941,1.01,2.951,0.592c0.742-0.307,1.295-0.918,1.54-1.652l-8.956-9 C6.07,25.027,6.071,21.003,8.532,18.531z"></path> <path d="M45.973,31.64c-1.396-5.957-5.771-14.256-18.906-16.01v-5.252c0-1.095-0.664-2.082-1.676-2.5 c-0.334-0.138-0.686-0.205-1.033-0.205c-0.705,0-1.398,0.276-1.917,0.796L10.49,20.479c-1.396,1.402-1.396,3.669-0.001,5.073 l11.95,12.009c0.517,0.521,1.212,0.797,1.92,0.797c0.347,0,0.697-0.066,1.031-0.205c1.012-0.418,1.676-1.404,1.676-2.5V30.57 c4.494,0.004,10.963,0.596,15.564,3.463c0.361,0.225,0.77,0.336,1.176,0.336c0.457,0,0.91-0.139,1.297-0.416 C45.836,33.429,46.18,32.515,45.973,31.64z"></path> </g> </g> </g></svg>
                                        Voltar
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="padding: 10px">

                                        <b>Venda por leilão:</b> {{($auction['status_auction'] === "active")? "Ativo" : "Inativo"}}
                                        <br>

                                </div>
                            </div>


                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#auctionModal">Ativar Venda por Leilão</button>
                        </div>
                    </div>
                </div>
                <!--INICIO DO CONTEUDO DA TELA -->
                <div class="dashboard-widget" style="width: 83%;">

                    <div class="dashboard-purchasing-tabs">

                        <div class="tab-content">
                            <div class="tab-pane show active fade" id="current">

                                    <h5>Editar Anúncio</h5>
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form action="{{ route('announcements.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')

                                        <!-- Campo Título -->
                                        <div class="form-group">
                                            <label for="title">Título</label>
                                            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $product->title) }}" required>
                                        </div>

                                        <!-- Campo Descrição -->
                                        <div class="form-group">
                                            <label for="description">Descrição Completa</label>
                                            <textarea name="description" id="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="date_expiration">Data de Expiração do Anúncio</label>
                                            <input type="datetime-local" name="date_expiration" id="date_expiration" value="{{ old('date_expiration', $product->date_expiration) }}" required>
                                        </div>

                                        <!-- Campo Preço -->
                                        <div class="form-group">
                                            <label for="current_price">Preço Inicial</label>
                                            <input type="number" name="current_price" id="current_price" class="form-control" value="{{ old('current_price', $product->current_price) }}" required>
                                        </div>

                                        <!-- Campo Categoria -->
                                        <div class="form-group">
                                            <label for="category_id">Categoria</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->category_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <!-- Campos Dinâmicos de Atributos -->
                                        <div class="form-group">
                                            <label>Atributos do Produto</label>
                                            <div id="attributes-container">
                                                @foreach ($product->attributes as $attribute)
                                                    <div class="attribute-row">
                                                        <input type="text" name="attributes[{{ $loop->index }}][name]" class="form-control input-attributes-add" placeholder="Nome do atributo"
                                                            value="{{ old('attributes.' . $loop->index . '.name', $attribute->attribute_name) }}" required>
                                                        <input type="text" name="attributes[{{ $loop->index }}][value]" class="form-control input-attributes-add" placeholder="Valor do atributo"
                                                            value="{{ old('attributes.' . $loop->index . '.value', $attribute->attribute_value) }}" required>
                                                        <button type="button" class="btn-attributes btn btn-danger remove-attribute" data-bs-toggle="tooltip" title="Excluir">
                                                            <i class="small material-icons small-white">delete_chart</i> <div class="txt-excluir-attr">Excluir</div>
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <button type="button" class="btn btn-success btn-attributes-add" id="add-attribute">

                                                <div class="add-icon-circle"><i class="small material-icons small-white">add_circle</i></div>
                                                <div>Adicionar Novo Atributo</div>
                                            </button>
                                        </div>

                                        <!-- Imagens -->
                                        <div class="form-group">
                                            <label for="images">Imagens</label>
                                            <input type="file" name="images[]" id="images" class="form-control" multiple>
                                            @if ($images->count() > 0)
                                                <div class="box-images-edit">
                                                    <h5>Imagens atuais:</h5>
                                                    <div class="row">
                                                        @foreach ($images as $image)
                                                        <div class="col-md-3">

                                                            <img src="{{ asset($image->url_archive) }}" alt="Imagem do anúncio" class="img-thumbnail img-mini"  onclick="openImageModal('{{ $image->id }}', '{{ asset($image->url_archive) }}')">
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Campo Status -->
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Ativo</option>
                                                <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Inativo</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Salvar</button>
                                    </form>

                            </div>

                        </div>
                    </div>
                </div>
                <!--FIM DO CONTEUDO DA TELA -->

            </div>
        </div>
        </div>
    </section>

    <!-- MODAL DE ATIVAR VENDA POR LEILAO -->
    <div class="modal fade" id="auctionModal" tabindex="-1" aria-labelledby="auctionModalLabel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="auctionModalLabel" aria-hidden="true">>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="auctionModalLabel">Ativar Venda Por Leilão</h5>
                    <button type="button" class="btn-close custom-close-btn" data-bs-dismiss="modal" aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <!-- Formulário -->
                    <form action="{{ route('auction.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="auction_name" class="form-label">Nome do Leilão</label>
                            <input type="hidden" name="product_id" value="{{$product->id}}">
                            <input type="text" class="form-control" id="auction_name" name="auction_name" value="{{$product->title}}" required>
                        </div>

                        <div class="mb-3">
                            <label for="auction_start" class="form-label">Início do Leilão</label>
                            <input type="datetime-local" class="form-control" id="auction_start" name="auction_start" value="{{$auction['auction_start']}}" required>
                        </div>

                        <div class="mb-3">
                            <label for="auction_end" class="form-label">Fim do Leilão</label>
                            <input type="datetime-local" class="form-control" id="auction_end" name="auction_end" value="{{$auction['auction_end']}}" required>
                        </div>

                        <div class="mb-3">
                            <label for="Status" class="form-label">Status</label>
                            <select name="status_auction" id="status_auction" class="form-control">
                                <option value="active" {{($auction['status_auction'] === "active")? "selected": ""}}>Ativo</option>
                                <option value="inactive" {{($auction['status_auction'] === "inactive")? "selected": ""}}>Inativo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Salvar Leilão</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--============= Dashboard Section Ends Here =============-->
    <!-- Modal de Visualização e Exclusão de Imagem -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Visualizar Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close" data-bs-dismiss="modal" style="width: 57px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" class="img-fluid" alt="Imagem do anúncio">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-modal-image" data-dismiss="modal" data-bs-dismiss="modal">Fechar</button>
                    <form id="deleteImageForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-modal-image">Excluir Imagem</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function delProductConfirm(id){
            console.log(`Deseja realmente apagar o produto ${id}?`);
        }
        function editProduct(id){
            console.log("Editando ...");
        }

        function openImageModal(imageId, imageUrl) {
            document.getElementById('modalImage').src = imageUrl;
            let form = document.getElementById('deleteImageForm');
            form.action = "{{url('/admin/images/')}}/" + imageId; // Ajuste conforme a rota real da exclusão
            $('#imageModal').modal('show');
        }

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

        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</x-layout-front>
