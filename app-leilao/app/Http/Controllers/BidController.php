<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\NewBidEvent;
use Illuminate\Support\Facades\DB;

class BidController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'seller_id' => 'required',
            'announcement_id' => 'required|exists:annoucements,id',
            'amount' => 'required|numeric',
            'status_bid' => 'required|string',
            "price_now_bid" => 'nullable',
            "price_initial" => 'nullable',
            "price_incremental" =>  'nullable',
            "time_expiration" => 'nullable',
        ]);


        $bid = Bid::create([
            'seller_id' => $request->seller_id,
            'announcement_id' => $request->announcement_id,
            'amount' => $request->amount,
            'status_bid' => $request->status_bid,
            "price_now_bid" => 2.60,
            "price_initial" => 0,
            "price_incremental" =>  10,
            "time_expiration" => "250"
        ]);
        //broadcast(new NewBidEvent($bid))->toOthers(); // Envia evento em tempo real

        return response()->json($bid, 201);
    }

    // Lista todos os bids ou filtra pelo ID
    public function index($id = null)
    {
        if ($id) {
            $bid = Bid::find($id);
            if ($bid) {
                return response()->json($bid, 200);
            } else {
                return response()->json(['message' => 'Bid not found'], 404);
            }
        } else {
            $bids = Bid::all();
            return response()->json($bids, 200);
        }
    }


    // Atualiza informações de um bid
    public function update(Request $request, $id)
    {
        $bid = Bid::find($id);

        if (!$bid) {
            return response()->json(['message' => 'Bid not found'], 404);
        }

        $validatedData = $request->validate([
            'user_id' => 'exists:users,id',
            'announcement_id' => 'exists:announcements,id',
            'amount' => 'numeric',
            'status_bid' => 'string',
        ]);

        $bid->update($validatedData);

        return response()->json($bid, 200);
    }
}
