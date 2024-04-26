<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DoacaoF;

use App\Models\Financiamento;
use App\Models\Organizacao;
use App\Models\OrganizacaoDocumento;
use App\Models\Produto;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


use App\Models\DoacaoFinancimento;
use App\Models\DoacaoProduto;
use App\Models\DoacaoProdutoOng;
use App\Models\DoacaoFinanciamentoOng;

class HomeController extends Controller
{
    public function index(){
        $id=Auth::user()->id;
        if(Auth::user()->it_tipo_utilizador==0){
        $data['financiamento_p']=Financiamento::where('estado',1)->count();
       
        $data['financiamentos']=Financiamento::count();
        $data['produto_p']=Produto::where('estado',1)->count();
        $data['produtos']=Produto::count();
        $data['organizacao_p']=Organizacao::where('estado',1)->count();
        $data['organizacaos']=Organizacao::count();
        $analise['financiamento']=DoacaoFinancimento::where('estado',0)->where('users_id',$id)->count();
        $analise['produtos']=DoacaoProduto::where('estado',0)->where('users_id',$id)->count();
        $analise['Ofinanciamento']=DoacaoFinanciamentoOng::where('estado',0)->where('users_id',$id)->count();
        $analise['Oprodutos']=DoacaoProdutoOng::where('estado',0)->where('users_id',$id)->count();

        $aprovado['financiamento']=DoacaoFinancimento::where('estado',1)->where('users_id',$id)->count();
        $aprovado['produtos']=DoacaoProduto::where('estado',1)->where('users_id',$id)->count();
        $aprovado['Ofinanciamento']=DoacaoFinanciamentoOng::where('estado',1)->where('users_id',$id)->count();
        $aprovado['Oprodutos']=DoacaoProdutoOng::where('estado',1)->where('users_id',$id)->count();

        $rejeitado['financiamento']=DoacaoFinancimento::where('estado',2)->where('users_id',$id)->count();
        $rejeitado['produtos']=DoacaoProduto::where('estado',2)->where('users_id',$id)->count();
        $rejeitado['Ofinanciamento']=DoacaoFinanciamentoOng::where('estado',2)->where('users_id',$id)->count();
        $rejeitado['Oprodutos']=DoacaoProdutoOng::where('estado',2)->where('users_id',$id)->count();

        $data['analise']= $analise['financiamento']+$analise['produtos']+$analise['Ofinanciamento']+ $analise['Oprodutos'];
        
        $data['aprovado']= $aprovado['financiamento']+$aprovado['produtos']+$aprovado['Ofinanciamento']+ $aprovado['Oprodutos'];
        $data['rejeitado']= $rejeitado['financiamento']+$rejeitado['produtos']+$rejeitado['Ofinanciamento']+ $rejeitado['Oprodutos'];
    
        }
        elseif(Auth::user()->it_tipo_utilizador==3){
            $data['financiamento_p']=Financiamento::where('financiamentos.users_id',$id)->where('estado',1)->count();
       
            $data['financiamentos']=Financiamento::where('financiamentos.users_id',$id)->count();
            $data['produto_p']=Produto::where('produtos.users_id',$id,$id)->where('estado',1)->count();
            $data['produtos']=Produto::where('produtos.users_id',$id,$id)->count();
            $data['organizacao_p']=Organizacao::where('organizacaos.users_id',$id)->where('estado',1)->count();
            $data['organizacaos']=Organizacao::where('organizacaos.users_id',$id)->count();
        }
        else{
            $analise['financiamento']=DoacaoFinancimento::where('estado',0)->where('users_id',$id)->count();
            $analise['produtos']=DoacaoProduto::where('estado',0)->where('users_id',$id)->count();
            $analise['Ofinanciamento']=DoacaoFinanciamentoOng::where('estado',0)->where('users_id',$id)->count();
            $analise['Oprodutos']=DoacaoProdutoOng::where('estado',0)->where('users_id',$id)->count();

            $aprovado['financiamento']=DoacaoFinancimento::where('estado',1)->where('users_id',$id)->count();
            $aprovado['produtos']=DoacaoProduto::where('estado',1)->where('users_id',$id)->count();
            $aprovado['Ofinanciamento']=DoacaoFinanciamentoOng::where('estado',1)->where('users_id',$id)->count();
            $aprovado['Oprodutos']=DoacaoProdutoOng::where('estado',1)->where('users_id',$id)->count();

            $rejeitado['financiamento']=DoacaoFinancimento::where('estado',2)->where('users_id',$id)->count();
            $rejeitado['produtos']=DoacaoProduto::where('estado',2)->where('users_id',$id)->count();
            $rejeitado['Ofinanciamento']=DoacaoFinanciamentoOng::where('estado',2)->where('users_id',$id)->count();
            $rejeitado['Oprodutos']=DoacaoProdutoOng::where('estado',2)->where('users_id',$id)->count();

            $data['analise']= $analise['financiamento']+$analise['produtos']+$analise['Ofinanciamento']+ $analise['Oprodutos'];
            
            $data['aprovado']= $aprovado['financiamento']+$aprovado['produtos']+$aprovado['Ofinanciamento']+ $aprovado['Oprodutos'];
            $data['rejeitado']= $rejeitado['financiamento']+$rejeitado['produtos']+$rejeitado['Ofinanciamento']+ $rejeitado['Oprodutos'];
            // dd($analise,$id);
            // dd($id);

        }

        return view('admin.dashboard.index', $data);
    }
}
