<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormDataRequest;
use App\Models\Actor;
use App\Models\Address;
use App\Models\Seller;
use \App\Models\User as User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\throwException;

class FrontEndController extends Controller
{
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('frontend.registrar-se');
    }

    /**
     * Store a new user created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeUser(FormDataRequest $request)
    {
        
        try {
            DB::beginTransaction();

            $data = $request->all();
            //gravar dados do usuario
            $userArr = [
                'name' => $data['name'],
                'email' => $data['email'],
                'user_type_login' => $data['user_type_login'],
                'password' => bcrypt($data['password']),
            ];
            $user = User::create($userArr);
            //gravar dados de endereco
            $address = new Address();
            $address->user_id = $user->id;
            $address->zip_code = $data['zip_code'];
            $address->street = $data['street'];
            $address->number = $data['number'];
            $address->district = $data['district'];
            $address->city = $data['city'];
            $address->state = $data['state'];
            $address->push();
            //gravar dados de seller ou actioneer
            if($data['user_type_login'] === 'participante'){
                $actorArr = [
                    'user_id' => $user->id,
                    'full_name' => $data['name'],
                    'phone' => $data['phone']
                ];
                Actor::create($actorArr);
            }elseif ($data['user_type_login'] === 'anunciante'){
                $sellerArr = [
                    'user_id' => $user->id,
                    'full_name' => $data['name'],
                    'phone' => $data['phone']
                ];
                Seller::create($sellerArr);
            }
           
            DB::commit();
            return back()->with('success', 'Cadastro realizado com sucesso. ');
        } catch (Exception $e) {
            DB::rollback();
            $errorCad = 'Ops. Algo deu errado em seu cadastro, tente novamente ou contate o suporte. '.$e->getMessage();
            return redirect('registrar-se')->with('errorCad',$errorCad);
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
