<?php

namespace App\Http\Controllers\Doacao;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DoacaoFinanciamentoRequest;
use App\Http\Requests\DoacaoFinanciamentoUpdateRequest;
use App\Models\DoacaoFinancimento;
use App\Models\User;
use App\Helpers\ImageUploadHelper;
use App\Helpers\EstadoHelper;
use App\Helpers\DoacaoHelper;
use App\Modes\DoacaoF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\MessageHelper;
class FinanciamentoController extends Controller
{
    //
    public function index(){
        $user=Auth::user()->it_tipo_utilizador;
        $id=Auth::user()->id;
        if($user==0){
       $data['doacoes'] = DoacaoFinancimento::join('users as doadores', 'doacao_financimentos.users_id', '=', 'doadores.id')
       ->join('financiamentos', 'doacao_financimentos.financiamentos_id', '=', 'financiamentos.id')
       ->join('users as necessitados', 'financiamentos.users_id', '=', 'necessitados.id')
       // ->where('financiamentos_id', $id)  // Descomente e ajuste conforme necessário
       ->select('doadores.name as doador', 'necessitados.name as necessitado', 'doacao_financimentos.*','doadores.it_tipo_utilizador')
       ->where('doadores.it_tipo_utilizador','!=',4)
       ->get();
    }
    elseif($user==1){
        $data['doacoes'] = DoacaoFinancimento::join('users as doadores', 'doacao_financimentos.users_id', '=', 'doadores.id')
        ->join('financiamentos', 'doacao_financimentos.financiamentos_id', '=', 'financiamentos.id')
        ->join('users as necessitados', 'financiamentos.users_id', '=', 'necessitados.id')
        // ->where('financiamentos_id', $id)  // Descomente e ajuste conforme necessário
        ->select('doadores.name as doador', 'necessitados.name as necessitado', 'doacao_financimentos.*','doadores.it_tipo_utilizador')
        ->where('doadores.it_tipo_utilizador','!=',4)
        ->where('doacao_financimentos.users_id',$id)
        ->get();
    }
    elseif($user==2){
        $data['doacoes'] = DoacaoFinancimento::join('users as doadores', 'doacao_financimentos.users_id', '=', 'doadores.id')
        ->join('financiamentos', 'doacao_financimentos.financiamentos_id', '=', 'financiamentos.id')
        ->join('users as necessitados', 'financiamentos.users_id', '=', 'necessitados.id')
        // ->where('financiamentos_id', $id)  // Descomente e ajuste conforme necessário
        ->select('doadores.name as doador', 'necessitados.name as necessitado', 'doacao_financimentos.*','doadores.it_tipo_utilizador')
        ->where('doadores.it_tipo_utilizador','!=',4)
        ->where('financiamentos.users_id',$id)
        ->get();
    }
    
        // dd($data);

       return view('admin.financiamento.doacao',$data);
    }
    public function index2(){
        $user=Auth::user()->it_tipo_utilizador;
        $id=Auth::user()->id;
    if($user==0){
        $data['doacoes'] = DoacaoFinancimento::join('users as doadores', 'doacao_financimentos.users_id', '=', 'doadores.id')
        ->join('financiamentos', 'doacao_financimentos.financiamentos_id', '=', 'financiamentos.id')
        ->join('users as necessitados', 'financiamentos.users_id', '=', 'necessitados.id')
        // ->where('financiamentos_id', $id)  // Descomente e ajuste conforme necessário
        ->select('doadores.empresa as doador', 'necessitados.name as necessitado', 'doacao_financimentos.*','doadores.it_tipo_utilizador')
        ->where('doadores.it_tipo_utilizador',4)
        ->get();
    }
    elseif($user==4){
        $data['doacoes'] = DoacaoFinancimento::join('users as doadores', 'doacao_financimentos.users_id', '=', 'doadores.id')
        ->join('financiamentos', 'doacao_financimentos.financiamentos_id', '=', 'financiamentos.id')
        ->join('users as necessitados', 'financiamentos.users_id', '=', 'necessitados.id')
        // ->where('financiamentos_id', $id)  // Descomente e ajuste conforme necessário
        ->where('doadores.it_tipo_utilizador',4)
        ->where('doacao_financimentos.users_id',$id)
        ->select('doadores.empresa as doador', 'necessitados.name as necessitado', 'doacao_financimentos.*')
        ->get();
    }
    else{
        $data['doacoes'] = DoacaoFinancimento::join('users as doadores', 'doacao_financimentos.users_id', '=', 'doadores.id')
        ->join('financiamentos', 'doacao_financimentos.financiamentos_id', '=', 'financiamentos.id')
        ->join('users as necessitados', 'financiamentos.users_id', '=', 'necessitados.id')
        // ->where('financiamentos_id', $id)  // Descomente e ajuste conforme necessário
        ->where('doadores.it_tipo_utilizador',4)
        ->where('financiamentos.users_id',$id)
        ->select('doadores.empresa as doador', 'necessitados.name as necessitado', 'doacao_financimentos.*','financiamentos.users_id')
        ->get();
    }
       
    
    //    dd($data);

       return view('admin.financiamento.doacao',$data);
    }

    public function store(DoacaoFinanciamentoRequest $req,$id){
        try {
            
            
            $id_user=Auth::user()->id;
            $caminho= ImageUploadHelper::uploadImage($req->comprovativo, 'documentos/doacoes/financiamento');
           
            $doacao=DoacaoFinancimento::create([
                'users_id'=> $id_user,
                'financiamentos_id'=>$id,
                'valores'=>$req->valores,
                'comprovativo'=>$caminho,
                'estado'=>0,
          
            ]);
            // dd( $doacao);
            return redirect()->back()->with('doacao',1);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            // DB::rollback();
            return redirect()->back()->with('doacao.error',1);
        }
    }
    public function update($id,DoacaoFinancimento $financiamento,DoacaoFinanciamentoUpdateRequest $req){
        try {
            DB::beginTransaction();
            if(! $req->comprovativo){
                $caminho= ImageUploadHelper::uploadImage($req->comprovativo, 'documentos/doacoes/financiamento');
                 $financiamento->update([
                    'users_id'=> $id_user,
                    'valores'=>req->valores,
                    'comprovativo'=>$caminho,
              
                ]);
            }
            else{
                 $financiamento->update([
                    'users_id'=> $id_user,
                    'financiamentos_id'=>req->financiamentos_id,
                    'valores'=>req->valores,
              
                ]);
            }
            DB::commit();
            return redirect()->back()->with('doacao',1);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('doacao.error',1);
      
        }
    }


    public function activar( $produto){
        DB::beginTransaction();
        try {
            $activar = DoacaoFinancimento::where('id',$produto)->update([
                'estado'=>1
            ]);
            $financiamento=DoacaoFinancimento::where('id',$produto)->first();
            $user=User::where('id',$financiamento->users_id)->first();
            $nome=$user->name;
            $numero=$user->email;
                $messagem="
                Querido Doador,
                Agradecemos imensamente pela sua generosa doação. Sua contribuição foi recebida com gratidão e terá um impacto significativo na vida daquele que a recebeu. Com o seu apoio, estamos construindo um futuro mais esperançoso. Obrigado por fazer parte desta jornada de solidariedade e por inspirar esperança com sua generosidade.
                ";
                $status=MessageHelper::send($numero,$messagem);
            DB::commit();
            return redirect()->back()->with('on', 1);
        } catch (\Throwable $th) {
            dd($th);
            DB::rollback();
            return redirect()->back()->with('on.error', 1);
        }
       

    }
    public function desativar( $produto){
        DB::beginTransaction();
        try {
            $activar = DoacaoFinancimento::where('id',$produto)->update([
                'estado'=>2
            ]);
            $financiamento=DoacaoFinancimento::where('id',$produto)->first();
            $user=User::where('id',$financiamento->users_id)->first();
            $nome=$user->name;
            $numero=$user->email;
                $messagem="
                Prezado Doador, lamentamos informar que, até agora, não recebemos sua doação. Caso tenha ocorrido algum problema, por favor, entre em contato conosco para resolvermos. Agradecemos muito pelo seu interesse em contribuir e estamos à disposição para qualquer assistência necessária.  ";
                $status=MessageHelper::send($numero,$messagem);
                DB::commit();
            return redirect()->back()->with('off', 1);
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('off.error', 1);
        }
       

    }
}
