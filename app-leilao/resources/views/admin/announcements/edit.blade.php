<x-layout-front title="Gerenciar Produtos">

    <!--============= BreadCamps Section Starts Here =============-->
    <div class="hero-section style-2 pb-lg-400">
        <div class="container">
            <ul class="breadcrumb">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>
                <li>
                    <a href="#0">Admin</a>
                </li>
                <li>
                    <span>Gerenciar Produtos</span>
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
