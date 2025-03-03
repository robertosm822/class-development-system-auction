<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leilão de Eletrônicos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .shadow-sm {
            margin-bottom: 20px;
        }

        .card-img-top {
            height: 250px; /* Defina um tamanho fixo */
            object-fit: cover; /* Garante que a imagem se ajuste sem distorcer */
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Leilão de Eletrônicos</h2>
            <div class="d-flex">
                <select class="form-select me-2" id="priceFilter">
                    <option value="">Filtrar por preço</option>
                    <option value="0-1000">Até R$ 1.000</option>
                    <option value="1000-5000">R$ 1.000 - R$ 5.000</option>
                    <option value="5000-10000">R$ 5.000 - R$ 10.000</option>
                    <option value="10000-">Acima de R$ 10.000</option>
                </select>
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar item">
            </div>
        </div>
        <div class="row mt-4" id="productContainer">
            <!-- Produtos serão inseridos aqui via JavaScript -->
        </div>
        <!-- Paginação -->
        <nav>
            <ul class="pagination justify-content-center mt-4" id="paginationContainer">
                <!-- Botões de paginação serão inseridos via JavaScript -->
            </ul>
        </nav>
    </div>
    <script>
        const apiUrl = '/api/announcements'; // URL do endpoint da API
        let currentPage = 1;
        let currentFilters = {};

        async function fetchProducts(page = 1) {
            try {
                // Constrói a URL com os parâmetros de filtro e paginação
                const params = new URLSearchParams({
                    page,
                    ...currentFilters
                });
                let myHeaders = new Headers();
                myHeaders.append("Authorization", "Basic cm9iZXJ0by1hbnVuY2lhbnRlQGdtYWlsLmNvbTpNdWRhcjEyMyE=");

                const requestOptions = {
                    method: 'GET',
                    headers: myHeaders,
                    redirect: 'follow'
                };
                const response = await fetch(`${apiUrl}?${params}`, requestOptions);
                //if (!response.ok) throw new Error('Erro ao carregar produtos');
                const data = await response.json();

                // Renderiza os produtos e a paginação
                renderProducts(data.data);
                renderPagination(data.meta.last_page, page);
            } catch (error) {
                console.log(error);
                console.log('Ocorreu um erro ao carregar os produtos.');
            }
        }

        function renderProducts(products) {
            const productContainer = document.getElementById("productContainer");
            productContainer.innerHTML = "";

            products.forEach(product => {
                const productHTML = `
                    <div class="col-md-4">
                        <div class="card shadow-sm d-flex flex-column" style="min-height: 435px;">
                            <div class="flex-grow-1 d-flex align-items-center justify-content-center">
                                <img src="${product.first_image}" class="card-img-top" alt="${product.title}">
                            </div>
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title">${product.title}</h5>
                                <p class="text-success">Valor Inicial: <strong>R$ ${product.current_price.toFixed(2)}</strong></p>
                                <p class="text-muted">${product.bids?.length || 0} Lances</p>
                                <button class="btn btn-primary w-100">Dar um Lance</button>
                            </div>
                        </div>
                    </div>
                `;
                productContainer.innerHTML += productHTML;
            });
        }

        function renderPagination(totalPages, currentPage) {
            const paginationContainer = document.getElementById("paginationContainer");
            paginationContainer.innerHTML = "";

            for (let i = 1; i <= totalPages; i++) {
                const activeClass = i === currentPage ? "active" : "";
                const pageItem = `
                    <li class="page-item ${activeClass}">
                        <button class="page-link" onclick="changePage(${i})">${i}</button>
                    </li>
                `;
                paginationContainer.innerHTML += pageItem;
            }
        }

        function changePage(page) {
            currentPage = page;
            fetchProducts(page);
        }

        function applyFilters() {
            const priceFilter = document.getElementById("priceFilter").value;
            const searchInput = document.getElementById("searchInput").value.trim();

            // Limpa os filtros atuais
            currentFilters = {};

            // Aplica o filtro de preço
            if (priceFilter) {
                const [minPrice, maxPrice] = priceFilter.split('-');
                if (minPrice) currentFilters.min_price = minPrice;
                if (maxPrice) currentFilters.max_price = maxPrice;
            }

            // Aplica o filtro de busca
            if (searchInput) {
                currentFilters.title = searchInput;
            }

            // Recarrega os produtos com os novos filtros
            currentPage = 1;
            fetchProducts();
        }

        // Event listeners para os filtros
        document.getElementById("priceFilter").addEventListener("change", applyFilters);
        document.getElementById("searchInput").addEventListener("input", applyFilters);

        // Carrega os produtos ao iniciar a página
        fetchProducts();
    </script>
</body>
</html>
