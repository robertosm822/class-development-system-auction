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
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">

                                    <!-- Tempo Restante -->
                                    <div class="text-center mb-3">
                                        <h4 class="text-danger fw-bold" id="tempo-decorrido">
                                            Tempo decorrido: <span id="auction-time">0</span> segundos
                                        </h4>
                                    </div>

                                    <!-- Mensagens do Bot -->
                                    <div id="auction-messages" class="alert alert-warning text-center" style="display: none;">
                                        <strong id="bot-message"></strong>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session('success') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <!-- Formulário de Lances -->
                                    <div class="card shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Envie seu Lance</h5>
                                            <form id="bid-form">
                                                <div class="mb-3">
                                                    <label for="amount" class="form-label">Valor do Lance (R$)</label>
                                                    <input type="number" class="form-control" id="amount" placeholder="Digite seu lance" min="1" required>
                                                </div>
                                                <button type="submit" class="btn btn-primary w-100">Enviar Lance</button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Botões de Controle -->
                                    {{--
                                    <div class="d-flex justify-content-between mt-3">
                                        <button class="btn btn-success" onclick="startAuction()">Iniciar Leilão</button>
                                         <button class="btn btn-danger" onclick="closeAuction()">Finalizar Leilão</button>
                                    </div>
                                     --}}

                                    <!-- Histórico de Lances -->
                                    <div class="mt-4">
                                        <h5>Histórico de Lances</h5>
                                        <ul id="bids-list" class="list-group"></ul>
                                    </div>

                                    <!-- Vencedor -->
                                    <h2 id="winner" class="text-center mt-4 text-success fw-bold"></h2>

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

<!-- Socket.io -->
<script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
<script>
    const socket = io("http://127.0.0.1:6001");

    let lastBid = 0; // Último lance registrado
    let auctionTime = 120; // Tempo inicial do leilão


    // Atualizar tempo restante do leilão
    socket.on("auctionTimeUpdate", function (time) {
        console.log("ATUALIZANDO O TEMPO", time);
        document.getElementById("auction-time").innerHTML = time;
    });

    // Atualiza a lista de lances
    socket.on("updateBids", function (data) {
        lastBid = data.amount; // Atualiza o último lance
        const bidsList = document.getElementById("bids-list");

        // Criar um item de lista <li>
        const bidItem = document.createElement("li");
        bidItem.classList.add("list-group-item", "bid-item"); // Classe base

        // Adicionar cor diferente dependendo do usuário
        //trabalhar css de cores das mensans de lance
        if (data.user === "{{$userOnline->name}}") {
            bidItem.classList.add("user-bid"); // Adiciona classe para o usuário logado
        } else {
            bidItem.classList.add("other-bid"); // Adiciona classe para outros usuários
        }

        // Definir o conteúdo do lance
        bidItem.innerHTML = `<strong>${data.user}:</strong> R$ ${data.amount}`;

        // Adicionar ao histórico
        bidsList.prepend(bidItem); // Insere no topo da lista
    });

    // Mensagens do bot
    socket.on("auctionMessage", function (data) {
        const messageBox = document.getElementById("auction-messages");
        messageBox.style.display = "block";
        if(data.message === "Leilão encerrado! Vamos anunciar o vencedor..."){
            document.getElementById('tempo-decorrido').style.display = 'none';
        }
        document.getElementById("bot-message").innerText = data.message;
    });

    // Exibir vencedor
    socket.on("auctionWinner", function (data) {
        document.getElementById("winner").innerText =
            `🏆 O vencedor é ${data.user} com um lance de R$ ${data.amount}`;
    });

    // Enviar lance
    document.getElementById("bid-form").addEventListener("submit", function (event) {
        event.preventDefault();
        let amount = parseFloat(document.getElementById("amount").value);

        if (isNaN(amount) || amount <= lastBid) {
            alert("O lance deve ser maior que o último lance!");
            return;
        }

        socket.emit("newBid", { ad_id: {{$adId}}, amount: amount, user: "{{$userOnline->name}}" });
        document.getElementById("amount").value = "";
    });


    //criando efeito de animacao sonra com base nas mensagens do bot
    // Mapeamento de mensagens para os arquivos de áudio correspondentes
    const audioMap = {
        "Dou-lhe uma...": "/mp3/martelada-12-segundos.mp3",
        "Dou-lhe duas...": "/mp3/martelada-12-segundos.mp3",
        "Vamos encerrar em 5 segundos. O martelo será batido!": "/mp3/leilao-encerrado.mp3"
    };

    // Função para reproduzir áudio com base na mensagem recebida
    function playAuctionSound(message) {
        const audioSrc = audioMap[message]; // Verifica se a mensagem tem um áudio associado
        if (audioSrc) {
            const audio = new Audio(audioSrc);
            audio.play().catch(error => console.error("Erro ao reproduzir áudio:", error));
        }
    }

    // Escutando mensagens do servidor WebSocket
    socket.on("auctionMessage", (data) => {
        console.log("Mensagem recebida:", data.message);
        playAuctionSound(data.message);
    });

    // Iniciar leilão
    function startAuction() {
        socket.emit("startAuction", { ad_id: {{$adId}} });
    }

    // Finalizar leilão
    function closeAuction() {
        socket.emit("closeAuction", { ad_id: {{$adId}} });
    }

    startAuction(); //iniciar leilao
</script>


</x-layout-front>
