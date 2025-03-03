<?php

namespace App\Http\Controllers;

use App\Models\Annoucement;
use App\Models\AnnouncementAttribute;
use App\Models\Auction;
use App\Models\Category;
use App\Models\Image;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnoucementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Inicializa a query base
        $query = Annoucement::query();

        // Filtra por current_price (min e max)
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('current_price', [
                $request->input('min_price'),
                $request->input('max_price')
            ]);
        } elseif ($request->has('min_price')) {
            $query->where('current_price', '>=', $request->input('min_price'));
        } elseif ($request->has('max_price')) {
            $query->where('current_price', '<=', $request->input('max_price'));
        }

        // Filtra por title (busca parcial)
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        // Filtra por description (busca parcial)
        if ($request->has('description')) {
            $query->where('description', 'like', '%' . $request->input('description') . '%');
        }

        // Carrega os anúncios com as imagens relacionadas
        /** @var \Illuminate\Pagination\LengthAwarePaginator $announcements */
        $announcements = $query->with(['images'])->paginate(20);

        /** @var \Illuminate\Support\Collection $items */
        // Transforma os dados para incluir apenas a primeira imagem
        $formattedAnnouncements = $announcements->map(function ($announcement) {
            return [
                'id' => $announcement->id,
                'seller_id' => $announcement->seller_id,
                'category_id' => $announcement->category_id,
                'title' => $announcement->title,
                'current_price' => $announcement->current_price,
                'description' => $announcement->description,
                'date_started' => $announcement->date_started,
                'date_expiration' => $announcement->date_expiration,
                'status' => $announcement->status,
                'first_image' => $announcement->images->first() ? $announcement->images->first()->url_archive : '/uploads/no-image-icon.png', // Primeira imagem
            ];
        });

        // Retorna os resultados formatados como JSON
        return response()->json([
            'data' => $formattedAnnouncements,
            'meta' => [
                'current_page' => $announcements->currentPage(),
                'last_page' => $announcements->lastPage(),
                'per_page' => $announcements->perPage(),
                'total' => $announcements->total(),
            ],
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $seller_id = Seller::where('user_id', '=', Auth::user()->id)->first();

        return view('admin.cadastrar-produto', compact('categories', 'seller_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //pegar o seller_id relacionado ao user online
        $seller_id = Seller::where('user_id', '=', Auth::user()->first);
        $seller_id = $seller_id->id;
    }

    /**
     * Lista de Produtos anunciados por um anunciante
    */
    public function addForm(Request $request)
    {
        $products = Annoucement::all();
        $user = Auth::user();
        $search = $request->input('search');

        $products = Annoucement::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%{$search}%");
        })->where('seller_id',$user->id)->orderBy('date_started', 'desc')->paginate(10);

        return view('admin.produtos-gerenciar', compact('products', 'search'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Metodo para editar um Anuncio
    */
    public function edit($id)
    {
        // Encontrar o produto pelo ID
        $user = Auth::user();
        $product = Annoucement::where('seller_id',$user->id)->findOrFail($id);

        // Obter todas as categorias para preencher o campo select
        $categories = Category::all();

        // Obter todas as imagens associadas ao anúncio
        $images = Image::where('announcement_id', $id)->get();

        // Busca um leilão existente com o mesmo annoucement_id
        $auction = Auction::where('annoucement_id', $id)->first();
        $auction = [
            'auction_start' => (!is_null($auction))? $auction->auction_start: "",
            'auction_end' => (!is_null($auction))? $auction->auction_end: "",
            'status_auction' => (!is_null($auction))? $auction->status_auction: "",
        ];

        // Retornar a view com o produto encontrado
        return view('admin.announcements.edit',  compact('product', 'categories', 'images', 'auction'));
    }

    public function update(Request $request, $id)
    {
         // Validar os dados recebidos
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'current_price' => 'required|numeric',
            'date_expiration' => 'required',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'description'  => 'required',
            'images' => 'nullable',
            'attributes.*.name' => 'required|string|max:255',
            'attributes.*.value' => 'required|string|max:255',
        ]);
        $body = $request->all();


        // Encontrar o produto pelo ID e atualizar os dados
        $product = Annoucement::findOrFail($id);

        // Atualizar os dados principais do anúncio
        $product->update([
            'title' => $body['title'],
            'description' => $body['description'],
            'current_price' => $body['current_price'],
            'category_id' => $body['category_id'],
            'date_expiration' => $body['date_expiration'],
            'status' => $body['status']
        ]);

        // Atualizar os atributos do anúncio
        if(isset($body['attributes']) && count($body['attributes']) > 0){
            $product->attributes()->delete(); // Remove os atributos antigos
        }
        foreach ($body['attributes'] as $attribute) {
            AnnouncementAttribute::create([
                'announcement_id' => $product->id,
                'attribute_name' => $attribute['name'],
                'attribute_value' => $attribute['value'],
            ]);
        }


        $files = [];

       // Verifica se há imagens para upload
        if ($request->hasFile('images')) {
            foreach($request->file('images') as $key => $file)
            {
                $fileName = time().rand(1,99).'.'.$file->extension();
                $file->move(public_path('uploads'), $fileName);

                array_push($files, [
                    'announcement_id' => $product->id,
                    'name_archive' => $fileName,
                    'url_archive' => '/uploads/'.$fileName
                ]);
            }
        }

        foreach ($files as $key => $file) {
            Image::create($file);
        }



        // Redirecionar de volta para a lista de anúncios com uma mensagem de sucesso
        return redirect()->route('list.products')->with('success', 'Anúncio atualizado com sucesso!');
    }


    public function destroy($id)
    {
        $user = Auth::user();
        $announcement = Annoucement::where('seller_id',$user->id)->findOrFail($id);

        // Deletar imagens relacionadas antes de excluir o anúncio
        $announcement->images()->delete();

        // Excluir o anúncio
        $announcement->delete();

        return redirect()->route('list.products')->with('success', 'Anúncio excluído com sucesso!');
    }
}
