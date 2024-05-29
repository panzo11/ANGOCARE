<?php

namespace App\Http\Controllers\Ong;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoacaoProdutoOng;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\ImageUploadHelper;
use App\Helpers\EstadoHelper;
class ProdutoController extends Controller
{
    //
    public function index(){
        $user=Auth::user()->it_tipo_utilizador;
        $id=Auth::user()->id;
        if($user==0){
        $data['doacoes']=DoacaoProdutoOng::join('users as doador','doacao_produto_ongs.users_id','doador.id')
        ->join('organizacaos as necessitado','doacao_produto_ongs.organizacaos_id','necessitado.id')
        // ->join('users as dono','organizacaos.users_id','necessitado.id')
        ->select('doacao_produto_ongs.*','doador.name as users_1','necessitado.nome as user_2')
        ->get();
        }
        elseif($user==3){
            $data['doacoes']=DoacaoProdutoOng::join('users as doador','doacao_produto_ongs.users_id','doador.id')
            ->join('organizacaos as necessitado','doacao_produto_ongs.organizacaos_id','necessitado.id')
            // ->join('users as dono','organizacaos.users_id','necessitado.id')
            ->where('necessitado.users_id',$id)
            ->select('doacao_produto_ongs.*','doador.name as users_1','necessitado.nome as user_2')

            ->get();
        }
        else{
            $data['doacoes']=DoacaoProdutoOng::join('users as doador','doacao_produto_ongs.users_id','doador.id')
            ->join('organizacaos as necessitado','doacao_produto_ongs.organizacaos_id','necessitado.id')
            // ->join('users as dono','organizacaos.users_id','necessitado.id')
            ->where('doacao_produto_ongs.users_id',$id)
            ->select('doacao_produto_ongs.*','doador.name as users_1','necessitado.nome as user_2')

            ->get();
        }
        return view('admin.organizacao.doacao.produto',$data);
    }
    public function store(Request $req,$id){
        try {

            $user=Auth::user()->id;
            // dd($id);
            DoacaoProdutoOng:: create([
                'users_id'=>$user,
                'organizacaos_id'=>$id,
                'doados'=>$req->doados,
                'entrega'=>$req->entrega,
                'ate'=>$req->ate,
                'estado'=>0,
            ]);
            return redirect()->back()->with('doacao',1);
        } catch (\Throwable $th) {
            // dd($th);
            return redirect()->back()->with('doacao.failed',1);
        }
    }
    public function activar(DoacaoProdutoOng $produto){
        try {
            $activar = EstadoHelper::activar($produto);
            return redirect()->back()->with('on', 1);
        } catch (\Throwable $th) {
            return redirect()->back()->with('on.error', 1);
        }


    }
    public function desativar(DoacaoProdutoOng $produto){
        try {
            $activar = EstadoHelper::desativar($produto);
            return redirect()->back()->with('off', 1);
        } catch (\Throwable $th) {
            return redirect()->back()->with('off.error', 1);
        }


    }
}
