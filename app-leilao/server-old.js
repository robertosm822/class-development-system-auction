const express = require("express");
const app = express();
const http = require("http").createServer(app);
const io = require("socket.io")(http, {
    cors: { origin: "*" }
});

const auctions = {}; // Armazena os leilões ativos e o tempo restante
let auctionTime = 300; // Tempo inicial do leilão (5 minutos)
let auctionInterval = null;

app.use(express.json()); // Permitir requisições JSON

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

    // Disparar o tempo inicial para novos usuários conectados
    socket.emit("auctionTimeUpdate", auctionTime);

    // Iniciar contagem regressiva do leilão
    socket.on("startAuction", (data) => {
        if (!auctionInterval) {
            auctionInterval = setInterval(() => {
                if (auctionTime > 0) {
                    auctionTime--;
                    console.log(`Leilão ${data.ad_id}: ${auctionTime}s restantes`);

                    // Emitindo para todos os clientes conectados
                    io.emit("auctionTimeUpdate", auctionTime);
                } else {
                    clearInterval(auctionInterval);
                    io.emit("auctionEnded", { message: "Leilão encerrado!" });
                }
                startAuctionBot(data.ad_id);
            }, 1000);
        }
    });

    // Finalizar leilão manualmente
    socket.on("closeAuction", () => {
        clearInterval(auctionInterval);
        auctionInterval = null;
        auctionTime = 0;
        io.emit("auctionTimeUpdate", auctionTime);
        io.emit("auctionEnded", { message: "Leilão finalizado!" });
    });

    // Novo lance recebido
    socket.on("newBid", (data) => {
        io.emit("updateBids", data); // Atualiza todos os usuários

        // Reinicia o temporizador do bot para esse leilão
        if (auctions[data.ad_id]) {
            clearTimeout(auctions[data.ad_id].botTimer);
            startAuctionBot(data.ad_id);
        }
    });

    // Evento para iniciar um novo leilão com um tempo definido
    /*
    socket.on("startAuction", (data) => {
        if (!auctions[data.ad_id]) {
            auctions[data.ad_id] = {
                timeLeft: 300, // Tempo inicial do leilão (em segundos) -> 5 minutos
            };
            startAuctionBot(data.ad_id);
        }
    });
    */

    // Evento para fechar o leilão
    socket.on("closeAuction", (data) => {
        if (auctions[data.ad_id]) {
            clearTimeout(auctions[data.ad_id].botTimer);
            delete auctions[data.ad_id];
            io.emit("auctionWinner", data); // Notifica todos os usuários
        }
    });

    socket.on("disconnect", () => {
        console.log("Usuário desconectado:", socket.id);
    });
});

// Iniciar servidor
http.listen(6001, () => {
    console.log("Servidor WebSocket rodando na porta 6001...");
});

//console.log("Servidor WebSocket rodando na porta 6001...");

// -------------------------
// LÓGICA DO BOT DO LEILÃO
// -------------------------

function startAuctionBot(ad_id) {
    if (!auctions[ad_id]) return;

    auctions[ad_id].botTimer = setInterval(() => {
        auctions[ad_id].timeLeft -= 10; // Reduz 10 segundos a cada ciclo
        console.log(`Leilão ${ad_id}: ${auctions[ad_id].timeLeft}s restantes`);

        //mostrar tempo encerrando
        if (auctions[ad_id].timeLeft < 300) {
            io.emit("auctionMessageTime", {
                ad_id,
                message: `Leilão ${ad_id}: ${auctions[ad_id].timeLeft}s restantes`,
            });
        }

        if (auctions[ad_id].timeLeft === 300) {
            io.emit("auctionMessage", {
                ad_id,
                message: "O leilão começou! Quem dá mais?",
            });
        } else if (auctions[ad_id].timeLeft === 60) {
            io.emit("auctionMessage", {
                ad_id,
                message: "Falta 1 minuto para encerrar! Últimas ofertas!",
            });
        } else if (auctions[ad_id].timeLeft === 30) {
            io.emit("auctionMessage", {
                ad_id,
                message: "Dou-lhe uma...",
            });
        } else if (auctions[ad_id].timeLeft === 20) {
            io.emit("auctionMessage", {
                ad_id,
                message: "Dou-lhe duas...",
            });
        } else if (auctions[ad_id].timeLeft === 10) {
            io.emit("auctionMessage", {
                ad_id,
                message: "Última chance! Quem dá mais?",
            });
        } else if (auctions[ad_id].timeLeft === 5) {
            io.emit("auctionMessage", {
                ad_id,
                message: "Vamos encerrar em 5 segundos. O martelo será batido!",
            });
        } else if (auctions[ad_id].timeLeft <= 0) {
            clearTimeout(auctions[ad_id].botTimer);
            delete auctions[ad_id];

            io.emit("auctionMessage", {
                ad_id,
                message: "Leilão encerrado! Vamos anunciar o vencedor...",
            });

            // Aqui poderíamos chamar um evento no Laravel para calcular o vencedor
        }
    }, 10000); // A cada 10 segundos, o bot envia mensagens
}
