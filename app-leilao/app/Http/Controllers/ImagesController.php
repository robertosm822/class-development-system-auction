<?php

namespace App\Http\Controllers;

use App\Models\Annoucement;
use App\Models\AnnouncementAttribute;
use App\Models\Image;
use App\Models\Seller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public static function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'files' => 'required',
            'files.*' => 'required|mimes:jpg,jpeg,JPEG,gif,png,PNG|max:2048',
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
        $data = $request->all();
        try {
            DB::beginTransaction();

            //pegar o seller_id relacionado ao user online
            $seller_id = Seller::where('user_id', '=', Auth::user()->id)->first();
            $seller_id = $seller_id->id;

            $annuncement = [
                'seller_id' => $seller_id,
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'current_price' => $data['current_price'],
                'description' => $data['description'],
                'date_started' => $data['date_started'],
                'date_expiration' => $data['date_expiration'],
                'status' => $data['status'],
            ];
            $annuncementObj =  Annoucement::create($annuncement);

            $annuncementObj = $annuncementObj::orderBy('created_at', 'desc')->first();
            $annoucement_id = $annuncementObj->id;

            // Atualizar os atributos do anúncio
            if(isset($body['attributes']) && count($body['attributes']) > 0){
                $annuncementObj->attributes()->delete(); // Remove os atributos antigos
            }
            foreach ($data['attributes'] as $attribute) {
                AnnouncementAttribute::create([
                    'announcement_id' => $annoucement_id,
                    'attribute_name' => $attribute['name'],
                    'attribute_value' => $attribute['value'],
                ]);
            }

            $files = [];
            if ($request->file('files')){
                foreach($request->file('files') as $key => $file)
                {
                    $fileName = time().rand(1,99).'.'.$file->extension();
                    $file->move(public_path('uploads'), $fileName);

                    array_push($files, [
                        'announcement_id' => $annoucement_id,
                        'name_archive' => $fileName,
                        'url_archive' => '/uploads/'.$fileName
                    ]);
                }
            }

            foreach ($files as $key => $file) {
                Image::create($file);
            }

            DB::commit();
            $success = 'Cadastrado produto e imagens com sucesso!';
            return redirect('admin/cadastrar-produto')->with('success',$success);
        } catch (Exception $e) {
            DB::rollback();

            $errorCad = 'Ops. Algo deu errado em seu cadastro, tente novamente ou contate o suporte. '.$e->getMessage();
            dd($errorCad );
            return redirect('admin/cadastrar-produto')->with('errorCad',$errorCad);
        }

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Remover o arquivo físico (se necessário)
        $imagePath = public_path($image->url_archive);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

         // Caminho completo do arquivo
        $imagePath = public_path('uploads/' . $image->name_archive);

        // Verifica se o arquivo existe e exclui
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }

        // Excluir do banco de dados
        $image->delete();

        return redirect()->back()->with('success', 'Imagem excluída com sucesso!');
    }
}
