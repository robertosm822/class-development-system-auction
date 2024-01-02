<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Address;
use App\Models\Seller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BackEndController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function profile()
    {
        $address = Address::where('user_id' , '=' , Auth::user()->id )->get();
        $actor='';
        $seller='';
        //verificar tipo de cadastro
        if(Auth::user()->user_type_login === 'participante'){
            $actor = Actor::where('user_id' , '=' , Auth::user()->id)->get();
            $actor = (isset($actor[0]['phone']))? $actor[0] : '';
        } else {
            $seller = Seller::where('user_id' , '=' , Auth::user()->id)->get();
            $seller = (isset($seller[0]['phone']))? $seller[0] : '';
        }
        return view('admin.perfil', compact('address','actor', 'seller'));
    }

    public function profileUpdateAddress(Request $request)
    {
        try {
            $data = $request->all();
            $employee = Address::find($data['id']);
            $employee->update([
                'zip_code' => $data['zip_code'],
                'street'=> $data['street'],
                'number'=> $data['number'],
                'district'=> $data['district'],
                'city'=> $data['city'],
                'state'=> $data['state'],
            ]);
            $success = 'Atualizado com sucesso!';
            return redirect('admin/perfil')->with('success',$success);
        } catch (\Exception $e) {
            $errorUpdate = 'Não foi possivel atualizar';
            return redirect('admin/perfil')->with('errorUpdate',$errorUpdate);
        }
        
    }

    public function updatePhone(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            
            
            if(Auth::user()->user_type_login === 'participante'){
                DB::table('actioneers')->update(
                    ['phone' => $data['phone'] ],
                    ['id' => $id]
                );
            }elseif (Auth::user()->user_type_login === 'anunciante'){
                DB::table('sellers')->update(
                    ['phone' => $data['phone'] ],
                    ['id' => $id]
                );
            }
            DB::commit();
            $success = 'Atualizado telefone com sucesso!';
            return redirect('admin/perfil')->with('success',$success);

        } catch (Exception $e) {
            DB::rollback();
            $errorCad = 'Ops. Algo deu errado em seu cadastro, tente novamente ou contate o suporte. '.$e->getMessage();
            return redirect('admin/perfil')->with('errorCad',$errorCad);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->all();
            DB::table('users')->update(
                ['password' => bcrypt($data['password'])],
                ['id' => Auth::user()->id]
            );

            DB::commit();
            $success = 'Atualizada senha com sucesso!';
            return redirect('admin/perfil')->with('success',$success);
        } catch (Exception $e) {
            DB::rollback();
            $errorCad = 'Ops. Algo deu errado em seu cadastro, tente novamente ou contate o suporte. '.$e->getMessage();
            return redirect('admin/perfil')->with('errorCad',$errorCad);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
