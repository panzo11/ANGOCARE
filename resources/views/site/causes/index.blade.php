@extends('layouts.site.index')
@section('titulo','Causes')
@section('conteudo')

  <section class="breadcrumbs-page-wrap">
    <div class="bg-fixed pos-rel breadcrumbs-page">
        <div class="container">
            <h1>Explorar Pedidos</h1>
            <nav aria-label="breadcrumb" class="breadcrumb-wrap">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('site.home.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Explorar Pedidos</li>
                </ol>
            </nav>
        </div>
    </div>
</section>
<!-- Page Breadcrumbs End -->

<!-- Main Body Content Start -->
<main id="body-content">

    <!-- Causes Grid Start -->
    <section class="wide-tb-100">
        <div class="container">
            <h1 class="heading-main">
                <small>Ajude-nos Agora</small>
                Pedidos mais recentes
            </h1>
            <div class="row">
                @foreach ($doacoes as $doacao)


                <!-- Causes Wrap -->
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="causes-wrap">
                        <div class="img-wrap">
                            <a href="{{ route('site.causas.show',$doacao->id) }}"><img src="{{asset($doacao->capa)}}" alt="" height="300px"></a>
                            <div class="raised-progress">
                                <div class="skillbar-wrap">
                                    <div class="clearfix">
                                        {{ number_format($doacao->total, 2, ',', '.') }}Kz alcançado de {{ number_format($doacao->valores, 2, ',', '.') }}Kz
                                    </div>
                                    @php
                                        $porcetangem=($doacao->total/$doacao->valores)*100
                                    @endphp
                                    <div class="skillbar mt-4" data-percent="{{ $porcetangem }}%">
                                        <div class="skillbar-percent">{{ $porcetangem }}%</div>
                                        <div class="skillbar-bar"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="content-wrap">
                            <span class="tag">{{ $doacao->categoria }}</span>
                            <h3><a href="{{ route('site.causas.show',$doacao->id) }}">{{ $doacao->categoria }}</a></h3>

                            @php
                                $user=App\Models\Organizacao::join('users','organizacaos.users_id','users.id')
                                ->select('users.name as proprietario','organizacaos.*')
                                ->where('users.id',$doacao->users_id)
                                ->first();

   @endphp
   {{-- @dd($user) --}}
                            <p>{{$user->nome}}</p>
                            <div class="btn-wrap">
                                <a class="btn-primary btn" href="{{ route('site.causas.show',$doacao->id) }}">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Causes Wrap -->

                @endforeach

            </div>
        </div>
    </section>
    <!-- Causes Grid Start -->

    <!-- Featured Cause Start -->
    <!-- Featured Cause End -->

    <!-- Faq's Style Start -->
    <section class="wide-tb-100 feautred-faqs pb-0">
        <div class="container">
            <div class="pos-rel faqs-wrap">
                <div class="bg-overlay blue opacity-80"></div>
                <div class="row">
                    <div class="col-12 col-lg-6 col-md-12">
                        <h1 class="heading-main light-mode">
                            <small>Tem perguntas</small>
                            Perguntas frequentes
                        </h1>
                        <ul class="list-unstyled icons-listing theme-orange mb-0">
                            <li>Como a minha doação será utilizada?</li>
                            <li>Como posso acompanhar o impacto da minha doação?</li>
                            <li>Como posso cancelar ou alterar minha doação recorrente?</li>
                            <li>Vocês aceitam doações em forma de bens materiais ou apenas dinheiro?</li>
                            <li>Vocês têm alguma parceria com empresas que fazem doações correspondentes?</li>
                        </ul>
                    </div>

                    <!-- Spacer For Medium -->
                    <div class="w-100 d-none d-sm-block d-lg-none spacer-60"></div>
                    <!-- Spacer For Medium -->

                    <div class="col-12 col-lg-6 col-md-12">
                        <div class="theme-collapse light">
                            <!-- Toggle Links 1 -->
                            <div class="toggle arrow-down">
                                <span class="icon">
                                    <i class="icofont-plus"></i>
                                </span> Nossa filosofia
                            </div>
                            <!-- Toggle Links 1 -->

                            <!-- Toggle Content 1 -->
                            <div class="collapse show">
                                <div class="content">
                                Nossa filosofia é simples: conectamos corações generosos aos projetos e causas que mais necessitam. Valorizamos transparência, responsabilidade e ação direta. Aqui, cada doação é um passo em direção a um mundo mais compassivo e igualitário. Junte-se a nós e seja parte dessa jornada de impacto positivo.
                                </div>
                            </div>
                            <!-- Toggle Content 1 -->

                            <!-- Toggle Links 2 -->
                            <div class="toggle">
                                <span class="icon">
                                    <i class="icofont-plus"></i>
                                </span> Nossa Organização
                            </div>
                            <!-- Toggle Links 2 -->

                            <!-- Toggle Content 2 -->
                            <div class="collapse">
                                <div class="content">
                                Somos uma organização dedicada a causas humanitárias, trabalhando incansavelmente para criar um impacto duradouro em comunidades locais e globais. Com uma equipe comprometida e parcerias estratégicas, abordamos desafios complexos, desde a saúde e educação até a proteção ambiental e o desenvolvimento econômico.
                                </div>
                            </div>
                            <!-- Toggle Content 3 -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Faq's Style End -->


</main>
@endsection
