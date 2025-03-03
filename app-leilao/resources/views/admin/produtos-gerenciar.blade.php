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

            @include('admin.admin-left-menu')

                <!--INICIO DO CONTEUDO DA TELA -->
                <div class="dashboard-widget">
                     <!-- Exibir mensagem de sucesso -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Exibir mensagem de erro (caso haja) -->
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <h5 class="title mb-10">Produtos Anunciados</h5>
                    <!-- Campo de busca -->
                    <div class="row">
                        <div class="col-md-12">
                            <form method="GET" action="{{ route('list.products') }}" class="mb-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Buscar por título" value="{{ request('search') }}">
                                    <button class="btn btn-primary margin-top-btn-search" type="submit">Buscar</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dashboard-purchasing-tabs">

                        <div class="tab-content">
                            <div class="tab-pane show active fade" id="current">
                                <table class="purchasing-table table-striped">
                                    <thead>

                                        <th class="space-table-left space-table-top">Título</th>
                                        <th class="space-table-left space-table-top">R$ Inicial</th>
                                        <th class="space-table-left space-table-top">Expiração</th>
                                        <!-- <th class="space-table-left space-table-top">Data Expiração</th> -->
                                        <th class="space-table-left space-table-top">Status</th>
                                        <th class="space-table-left space-table-top">Ações</th>
                                    </thead>
                                    <tbody>
                                        @forelse($products as $product)
                                        <tr>
                                            <td data-purchase="item" class="space-table-left">{{ $product->title }}</td>
                                            <td data-purchase="bid price" class="space-table-left">R$ {{ $product->current_price }}</td>
                                            <td data-purchase="lowest bid" class="space-table-left">{{ $product->date_expiration }}</td>
                                            <td data-purchase="expires" class="space-table-left">{{ ($product->status === "active")? "ATIVO" : "INATIVO" }}</td>
                                            <td data-purchase="lowest bid" class="space-table-left">
                                                <a href="{{ route('announcements.edit', $product->id) }}" title="Editar">
                                                    <i class="small material-icons small-blue">edit_chart</i>
                                                </a> |
                                                <a href="javascript:void(0);" title="Excluir" data-toggle="modal" data-target="#deleteModal"
                                                onclick="setDeleteAnnouncement('{{ $product->id }}')">
                                                    <i class="small material-icons small-red">delete_chart</i>
                                                </a>
                                            </td>
                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Nenhum anúncio encontrado.</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                                 <!-- Paginação -->
                                <div class="d-flex justify-content-center margin-top-btn-search">
                                    {{ $products->links() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <!--FIM DO CONTEUDO DA TELA -->

            </div>
        </div>
        </div>
    </section>

    <!-- Modal de Confirmação de Exclusão -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel" style="font-size: 16px;width: 50%;">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar" style="width: 57px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja excluir este anúncio?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="width: 125px;">Cancelar</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width: 125px;">Excluir</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--============= Dashboard Section Ends Here =============-->
    <script>
        function delProductConfirm(id){
            console.log(`Deseja realmente apagar o produto ${id}?`);
        }
        function editProduct(id){
            console.log("Editando ...");
        }

        function setDeleteAnnouncement(id) {
            let form = document.getElementById('deleteForm');
            form.action = "{{url('/admin/announcements/')}}/" + id;
        }



    </script>

</x-layout-front>
