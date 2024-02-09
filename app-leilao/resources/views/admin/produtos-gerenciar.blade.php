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
                    <h5 class="title mb-10">Produtos Anunciados</h5>
                    <div class="dashboard-purchasing-tabs">
                        
                        <div class="tab-content">
                            <div class="tab-pane show active fade" id="current">
                                <table class="purchasing-table">
                                    <thead>
                                        <!--
                                        'title',
                                        'current_price',
                                        'product_color',
                                        'date_expiration',
                                        'status'
                                        -->
                                        <th class="space-table-left space-table-top">Título</th>
                                        <th class="space-table-left space-table-top">R$ Inicial</th>
                                        <th class="space-table-left space-table-top">Cor</th>
                                        <!-- <th class="space-table-left space-table-top">Data Expiração</th> -->
                                        <th class="space-table-left space-table-top">Status</th>
                                        <th class="space-table-left space-table-top">Ações</th>
                                    </thead>
                                    <tbody>
                                        @foreach($products as $product)
                                        <tr>
                                            <td data-purchase="item" class="space-table-left">{{ $product->title }}</td>
                                            <td data-purchase="bid price" class="space-table-left">R$ {{ $product->current_price }}</td>
                                            <td data-purchase="highest bid" class="space-table-left">{{ $product->product_color }}</td>
                                           <!-- <td data-purchase="lowest bid" class="space-table-left">{{ $product->date_expiration }}</td> -->
                                            <td data-purchase="expires" class="space-table-left">{{ ($product->status === "active")? "ATIVO" : "INATIVO" }}</td>
                                            <td data-purchase="lowest bid" class="space-table-left">
                                                <a href="#editar" title="Editar" onclick="editProduct('{{ $product->id }}')">
                                                    <i class="small material-icons small-blue">edit_chart</i>
                                                </a> | 
                                                <a href="#excluir" title="Excluir" onclick="delProductConfirm('{{ $product->id }}')">
                                                    <i class="small material-icons small-red">delete_chart</i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        
                                     
                                    </tbody>
                                </table>
                            </div>
                            <!--
                            <div class="tab-pane show fade" id="pending">
                                <table class="purchasing-table">
                                    <thead>
                                        <th>Item</th>
                                        <th>Bid Price</th>
                                        <th>Highest Bid</th>
                                        <th>Lowest Bid</th>
                                        <th>Expires</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane show fade" id="history">
                                <table class="purchasing-table">
                                    <thead>
                                        <th>Item</th>
                                        <th>Bid Price</th>
                                        <th>Highest Bid</th>
                                        <th>Lowest Bid</th>
                                        <th>Expires</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                        <tr>
                                            <td data-purchase="item">2018 Hyundai Sonata</td>
                                            <td data-purchase="bid price">$1,775.00</td>
                                            <td data-purchase="highest bid">$1,775.00</td>
                                            <td data-purchase="lowest bid">$1,400.00</td>
                                            <td data-purchase="expires">7/2/2021</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            -->
                        </div>
                    </div>
                </div>
                <!--FIM DO CONTEUDO DA TELA -->

            </div>
        </div>
        </div>
    </section>
    <!--============= Dashboard Section Ends Here =============-->
    <script>
        function delProductConfirm(id){
            console.log(`Deseja realmente apagar o produto ${id}?`);
        }
        function editProduct(id){
            console.log("Editando ...");
        }
    </script>

</x-layout-front>