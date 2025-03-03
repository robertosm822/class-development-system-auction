const express = require("express");
const http = require("http");
const cors = require("cors");
const { Server } = require("socket.io");

// Criando o servidor Express
const app = express();
const server = http.createServer(app);

app.use(express.json()); // Permitir requisições JSON

// Configurar o CORS para permitir requisições de qualquer origem
app.use(cors({
    origin: "*", // Permite conexões de qualquer origem
    methods: ["GET", "POST"],
    allowedHeaders: ["Content-Type", "Authorization"]
}));

const io = new Server(server, {
    cors: {
        origin: "*", // Permite conexões de qualquer origem
        methods: ["GET", "POST"]
    }
});

const auctions = {};
let auctionTime = 300; // 5 minutos por padrão
let auctionInterval = null;



// Endpoint HTTP para iniciar o leilão via Laravel
app.post("/start-auction", (req, res) => {
    const { ad_id } = req.body;

    if (!ad_id) {
        return res.status(400).json({ error: "ID do leilão é obrigatório!" });
    }

    if (!auctionInterval) {
        auctionTime = 300; // Reinicia o tempo do leilão

        auctionInterval = setInterval(() => {
            if (auctionTime > 0) {
                auctionTime--;
                console.log(`Leilão ${ad_id}: ${auctionTime}s restantes`);

                io.emit("auctionTimeUpdate", auctionTime);
            } else {
                clearInterval(auctionInterval);
                io.emit("auctionEnded", { message: "Leilão encerrado!" });
            }
        }, 1000);
    }

    io.emit("startAuction", { ad_id });
    res.json({ message: "Leilão iniciado!", ad_id });
});



io.on("connection", (socket) => {
    console.log("Usuário conectado:", socket.id);

    // Enviar tempo restante para novos usuários conectados
    socket.on("joinAuction", (data) => {
        if (auctions[data.ad_id]) {
            console.log("Leilão ativo: "+data.ad_id);
            socket.emit("auctionTimeUpdate", auctions[data.ad_id].timeLeft);
        }
    });

    // Iniciar leilão
    socket.on("startAuction", (data) => {
        if (!auctions[data.ad_id]) {
            auctions[data.ad_id] = {
                timeLeft: 120, // Tempo inicial em segundos (5 minutos)
                botTimer: null,
                auctionInterval: null,
            };

            //vericar se leilao ja foi encerrado ou inativo
            if(data.ad_id === 6){
                io.emit("auctionEnded", { ad_id: data.ad_id, message: "Leilão encerrado!" });
                io.emit("auctionMessage", { ad_id: data.ad_id, message: "Leilão encerrado ou inativo!" });
                return;
            }

            // Iniciar contagem regressiva
            auctions[data.ad_id].auctionInterval = setInterval(() => {
                if (!data.ad_id || !auctions[data.ad_id]) {
                    console.log("Erro: Tentativa de encerrar um leilão inexistente!", data);
                    return; // Sai da função sem tentar acessar propriedades indefinidas
                }

                if (auctions[data.ad_id].timeLeft > 0) {
                    auctions[data.ad_id].timeLeft--;
                    io.emit("auctionTimeUpdate", auctions[data.ad_id].timeLeft);
                    console.log("Leilão ativo: "+data.ad_id+ " | Tempo decorrido: "+ auctions[data.ad_id].timeLeft);
                } else {
                    clearInterval(auctions[data.ad_id].auctionInterval);
                    io.emit("auctionEnded", { ad_id: data.ad_id, message: "Leilão encerrado!" });
                }
            }, 1000);

            startAuctionBot(data.ad_id);
        }
    });

    // Finalizar leilão manualmente
    socket.on("closeAuction", (data) => {
        if (auctions[data.ad_id]) {
            clearInterval(auctions[data.ad_id].auctionInterval);
            clearTimeout(auctions[data.ad_id].botTimer);
            delete auctions[data.ad_id];
            io.emit("auctionEnded", { ad_id: data.ad_id, message: "Leilão encerrado!" });
        }
    });

    // Novo lance recebido
    socket.on("newBid", (data) => {
        io.emit("updateBids", data); // Atualiza todos os usuários

        // Reiniciar o bot ao receber um novo lance
        if (auctions[data.ad_id]) {
            clearTimeout(auctions[data.ad_id].botTimer);
            startAuctionBot(data.ad_id);
        }
    });

    socket.on("disconnect", () => {
        console.log("Usuário desconectado:", socket.id);
    });
});

// Iniciando o servidor na porta 6001
server.listen(6001, () => {
    console.log("Servidor WebSocket rodando na porta 6001...");
});

// -------------------------
// LÓGICA DO BOT DO LEILÃO
// -------------------------

function startAuctionBot(ad_id) {
    if (!auctions[ad_id]) return;

    let botMessages = [
        { time: 300, message: "O leilão começou! Quem dá mais?" },
        { time: 120, message: "Falta 2 minuto para encerrar! Últimas ofertas!" },
        { time: 60, message: "Falta 1 minuto para encerrar! Últimas ofertas!" },
        { time: 30, message: "Dou-lhe uma..." },
        { time: 20, message: "Dou-lhe duas..." },
        { time: 10, message: "Última chance! Quem dá mais?" },
        { time: 5, message: "Vamos encerrar em 5 segundos. O martelo será batido!" }
    ];

    auctions[ad_id].botTimer = setInterval(() => {
        let timeLeft = auctions[ad_id].timeLeft;

        // Encontrar mensagens a serem enviadas no tempo exato
        botMessages.forEach(({ time, message }) => {
            if (timeLeft === time) {
                io.emit("auctionMessage", { ad_id, message });
            }
        });

        // Se o tempo acabar, encerrar
        if (timeLeft <= 0) {
            clearInterval(auctions[ad_id].botTimer);
            delete auctions[ad_id];
            io.emit("auctionMessage", { ad_id, message: "Leilão encerrado! Vamos anunciar o vencedor..." });
        }
    }, 1000); // Verificar a cada segundo
}
