<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuctionController extends Controller
{

    public function showAuction($auctionId)
    {
        $adId = $auctionId; // ID do leilão a ser iniciado

        try {
            $userOnline = Auth::user();
           //verificar se este leilao esta ativo ou inativo
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao iniciar o leilão: ' . $e->getMessage());
        }

        // Retorna a view do leilão
        return view('auction.bids', compact('adId', 'userOnline'));
    }

    public function store(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'product_id' => 'required',
            'auction_name' => 'required|string|max:255',
            'auction_start' => 'required|date',
            'auction_end' => 'required|date|after:auction_start',
            'status_auction' => 'nullable'
        ]);
        $body = $request->all();

        // Busca um leilão existente com o mesmo annoucement_id
        $auction = Auction::where('annoucement_id', $body['product_id'])->first();

        if ($auction) {
            // Se já existir, apenas atualiza os dados
            $auction->update([
                'auction_name' => $body['auction_name'],
                'auction_start' => $body['auction_start'],
                'auction_end' => $body['auction_end'],
                'status_auction' => $body['status_auction'] ?? $auction->status_auction,
            ]);

            $message = 'Leilão atualizado com sucesso!';
        } else {
            // Se não existir, cria um novo registro
            $auction = Auction::create([
                'auction_uuid' => Str::uuid(),
                'annoucement_id' => $body['product_id'],
                'seller_id' => auth()->id(),
                'auction_name' => $body['auction_name'],
                'auction_start' => $body['auction_start'],
                'auction_end' => $body['auction_end'],
                'status_auction' => $body['status_auction'] ?? 'pending',
            ]);

            $message = 'Leilão ativado com sucesso!';
        }

        return redirect()->back()->with('success', $message);
    }
}

