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
use DB;

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

    public function financiamentoOngs()
    {
        // Consulta para agrupar dados de financiamento por ano e mês
        if(Auth::user()->it_tipo_utilizador==0){

        $financiamentos = DB::table('doacao_financiamento_ongs')

        ->where('doacao_financiamento_ongs.estado',1)
        ->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(valores) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
    else{
        $id=Auth::user()->id;
        $financiamentos = DB::table('doacao_financiamento_ongs')
        ->join('organizacaos','doacao_financiamento_ongs.organizacaos_id','organizacaos.id')
        ->where('organizacaos.users_id',$id)
        ->where('doacao_financiamento_ongs.estado',1)
        ->select(
            DB::raw('YEAR(doacao_financiamento_ongs.created_at) as year'),
            DB::raw('MONTH(doacao_financiamento_ongs.created_at) as month'),
            DB::raw('SUM(valores) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }

    }
        $categories = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        return response()->json([
            'series' => $series,
            'categories' => $categories,
        ]);
    }
    public function financiamento()
    {
        // Consulta para agrupar dados de financiamento por ano e mês
        if(Auth::user()->it_tipo_utilizador==0){

        $financiamentos = DB::table('doacao_financimentos')
        ->where('doacao_financimentos.estado',1)
        ->join('users','doacao_financimentos.users_id','users.id')

        ->select(
            DB::raw('YEAR(doacao_financimentos.created_at) as year'),
            DB::raw('MONTH(doacao_financimentos.created_at) as month'),
            DB::raw('SUM(doacao_financimentos.valores) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
    else{
        $id=Auth::user()->id;
        $financiamentos = DB::table('doacao_financimentos')
        ->join('financiamentos','doacao_financimentos.financiamentos_id','financiamentos.id')
        ->where('doacao_financimentos.estado',1)
        ->join('users','doacao_financimentos.users_id','users.id')

        ->where('financiamentos.users_id',$id)
        ->select(
            DB::raw('YEAR(doacao_financimentos.created_at) as year'),
            DB::raw('MONTH(doacao_financimentos.created_at) as month'),
            DB::raw('SUM(doacao_financimentos.valores) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
        $categories = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        return response()->json([
            'series' => $series,
            'categories' => $categories,
        ]);
    }


    public function financiamentoIndividual()
    {
        // Consulta para agrupar dados de financiamento por ano e mês
        if(Auth::user()->it_tipo_utilizador==0){

        $financiamentos = DB::table('doacao_financimentos')
        ->where('doacao_financimentos.estado',1)
        ->join('users','doacao_financimentos.users_id','users.id')
        ->where('users.it_tipo_utilizador',1)
        ->select(
            DB::raw('YEAR(doacao_financimentos.created_at) as year'),
            DB::raw('MONTH(doacao_financimentos.created_at) as month'),
            DB::raw('SUM(doacao_financimentos.valores) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
    else{
        $id=Auth::user()->id;
        $financiamentos = DB::table('doacao_financimentos')
        ->join('financiamentos','doacao_financimentos.financiamentos_id','financiamentos.id')
        ->where('doacao_financimentos.estado',1)
        ->join('users','doacao_financimentos.users_id','users.id')
        ->where('users.it_tipo_utilizador',1)
        ->where('financiamentos.users_id',$id)
        ->select(
            DB::raw('YEAR(doacao_financimentos.created_at) as year'),
            DB::raw('MONTH(doacao_financimentos.created_at) as month'),
            DB::raw('SUM(doacao_financimentos.valores) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
        $categories = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        return response()->json([
            'series' => $series,
            'categories' => $categories,
        ]);
    }

    public function financiamentoEmpresa()
    {
        // Consulta para agrupar dados de financiamento por ano e mês
        if(Auth::user()->it_tipo_utilizador==0){
        $financiamentos = DB::table('doacao_financimentos')
        ->where('doacao_financimentos.estado',1)
        ->join('users','doacao_financimentos.users_id','users.id')
        ->where('users.it_tipo_utilizador',4)

        ->select(
            DB::raw('YEAR(doacao_financimentos.created_at) as year'),
            DB::raw('MONTH(doacao_financimentos.created_at) as month'),
            DB::raw('SUM(doacao_financimentos.valores) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
    else{
        $id=Auth::user()->id;
        $financiamentos = DB::table('doacao_financimentos')
        ->where('doacao_financimentos.estado',1)
        ->join('financiamentos','doacao_financimentos.financiamentos_id','financiamentos.id')
        ->join('users','doacao_financimentos.users_id','users.id')
        ->where('users.it_tipo_utilizador',4)
        ->where('financiamentos.users_id',$id)
        ->select(
            DB::raw('YEAR(doacao_financimentos.created_at) as year'),
            DB::raw('MONTH(doacao_financimentos.created_at) as month'),
            DB::raw('SUM(doacao_financimentos.valores) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
        $categories = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        return response()->json([
            'series' => $series,
            'categories' => $categories,
        ]);
    }
    public function projectCategoryData()
    {
        $categories = \DB::table('users')
        ->select(
            \DB::raw('CASE

            WHEN users.it_tipo_utilizador = 1 THEN "Doadores Singular"
            WHEN users.it_tipo_utilizador = 3 THEN "Centro de Caridade"
            WHEN users.it_tipo_utilizador = 4 THEN "Empresa"

          END as tipo_utilizador'),
            \DB::raw('COUNT(users.id) as user_count')
        )
        ->where('users.it_tipo_utilizador', '!=', 2)
        ->where('users.it_tipo_utilizador', '!=', 0) // Exclui registros onde it_tipo_utilizador é 0
        ->groupBy('tipo_utilizador')
        ->get();

        return response()->json($categories);
    }

    // Doação de Produtos

    public function produto()
    {
        // Consulta para agrupar dados de financiamento por ano e mês
        if(Auth::user()->it_tipo_utilizador==0){
        $financiamentos = DB::table('doacao_produtos')
        ->where('doacao_produtos.estado',1)
        ->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(id) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
    else{
        $id=Auth::user()->id;
        $financiamentos = DB::table('doacao_produtos')
        ->join('produtos','doacao_produtos.produtos_id','produtos.id')
        ->where('produtos.users_id',$id)
        ->where('doacao_produtos.estado',1)
        ->select(
            DB::raw('YEAR(doacao_produtos.created_at) as year'),
            DB::raw('MONTH(doacao_produtos.created_at) as month'),
            DB::raw('SUM(doacao_produtos.id) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }

    }
        $categories = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        return response()->json([
            'series' => $series,
            'categories' => $categories,
        ]);
    }
    public function produtoIndividual()
    {
        // Consulta para agrupar dados de financiamento por ano e mês
        if(Auth::user()->it_tipo_utilizador==0){
        $financiamentos = DB::table('doacao_produtos')
        ->where('doacao_produtos.estado',1)
        ->join('users','doacao_produtos.users_id','users.id')
        ->where('users.it_tipo_utilizador',1)
        ->select(
            DB::raw('YEAR(doacao_produtos.created_at) as year'),
            DB::raw('MONTH(doacao_produtos.created_at) as month'),
            DB::raw('SUM(doacao_produtos.id) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
    else{
        $id=Auth::user()->id;
        $financiamentos = DB::table('doacao_produtos')
        ->where('doacao_produtos.estado',1)
        ->join('produtos','doacao_produtos.produtos_id','produtos.id')
        ->where('produtos.users_id',$id)
        ->join('users','doacao_produtos.users_id','users.id')
        ->where('users.it_tipo_utilizador',1)
        ->select(
            DB::raw('YEAR(doacao_produtos.created_at) as year'),
            DB::raw('MONTH(doacao_produtos.created_at) as month'),
            DB::raw('SUM(doacao_produtos.id) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
        $categories = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        return response()->json([
            'series' => $series,
            'categories' => $categories,
        ]);
    }
    public function produtoEmpresa()
    {
        // Consulta para agrupar dados de financiamento por ano e mês
         // Consulta para agrupar dados de financiamento por ano e mês
         if(Auth::user()->it_tipo_utilizador==0){
            $financiamentos = DB::table('doacao_produtos')
            ->where('doacao_produtos.estado',1)
            ->join('users','doacao_produtos.users_id','users.id')
            ->where('users.it_tipo_utilizador',4)
            ->select(
                DB::raw('YEAR(doacao_produtos.created_at) as year'),
                DB::raw('MONTH(doacao_produtos.created_at) as month'),
                DB::raw('SUM(doacao_produtos.id) as total')
                )
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();


            // Transformar os dados para o formato necessário para o gráfico
            $data = [];
            foreach ($financiamentos as $financiamento) {
                $year = $financiamento->year;
                $month = $financiamento->month;
                $total = $financiamento->total;

                if (!isset($data[$year])) {
                    $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
                }
                $data[$year][$month] = $total;
            }

            // Preparar dados para o gráfico
            $series = [];
            foreach ($data as $year => $months) {
                $series[] = [
                    'name' => $year,
                    'data' => array_values($months)
                ];
            }
        }
        else{
            $id=Auth::user()->id;
            $financiamentos = DB::table('doacao_produtos')
            ->where('doacao_produtos.estado',1)
            ->join('produtos','doacao_produtos.produtos_id','produtos.id')
            ->where('produtos.users_id',$id)
            ->join('users','doacao_produtos.users_id','users.id')
            ->where('users.it_tipo_utilizador',4)
            ->select(
                DB::raw('YEAR(doacao_produtos.created_at) as year'),
                DB::raw('MONTH(doacao_produtos.created_at) as month'),
                DB::raw('SUM(doacao_produtos.id) as total')
                )
                ->groupBy('year', 'month')
                ->orderBy('year')
                ->orderBy('month')
                ->get();


            // Transformar os dados para o formato necessário para o gráfico
            $data = [];
            foreach ($financiamentos as $financiamento) {
                $year = $financiamento->year;
                $month = $financiamento->month;
                $total = $financiamento->total;

                if (!isset($data[$year])) {
                    $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
                }
                $data[$year][$month] = $total;
            }

            // Preparar dados para o gráfico
            $series = [];
            foreach ($data as $year => $months) {
                $series[] = [
                    'name' => $year,
                    'data' => array_values($months)
                ];
            }
        }
            $categories = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

            return response()->json([
                'series' => $series,
                'categories' => $categories,
            ]);
    }
    public function produtoOngs()
    {
        // Consulta para agrupar dados de financiamento por ano e mês
        if(Auth::user()->it_tipo_utilizador==0){
        $financiamentos = DB::table('doacao_produto_ongs')
        ->where('doacao_produto_ongs.estado',1)
        ->select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(id) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
    else{
        $id=Auth::user()->id;
        $financiamentos = DB::table('doacao_produto_ongs')
        ->join('organizacaos','doacao_produto_ongs.organizacaos_id','organizacaos.id')
        ->where('organizacaos.users_id',$id)
        ->where('doacao_produto_ongs.estado',1)
        ->select(
            DB::raw('YEAR(doacao_produto_ongs.created_at) as year'),
            DB::raw('MONTH(doacao_produto_ongs.created_at) as month'),
            DB::raw('SUM(doacao_produto_ongs.id) as total')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        // Transformar os dados para o formato necessário para o gráfico
        $data = [];
        foreach ($financiamentos as $financiamento) {
            $year = $financiamento->year;
            $month = $financiamento->month;
            $total = $financiamento->total;

            if (!isset($data[$year])) {
                $data[$year] = array_fill(1, 12, 0); // Inicializa todos os meses com 0
            }
            $data[$year][$month] = $total;
        }

        // Preparar dados para o gráfico
        $series = [];
        foreach ($data as $year => $months) {
            $series[] = [
                'name' => $year,
                'data' => array_values($months)
            ];
        }
    }
        $categories = ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'];

        return response()->json([
            'series' => $series,
            'categories' => $categories,
        ]);
    }
}
