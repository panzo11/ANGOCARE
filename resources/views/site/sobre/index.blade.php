@extends('layouts.site.index')
@section('titulo','Sobre Nós')
@section('conteudo')
    <!-- Page Breadcrumbs Start -->
    <section class="breadcrumbs-page-wrap">
        <div class="bg-fixed pos-rel breadcrumbs-page">
            <div class="container">
                <h1>Sobre Nós</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-wrap">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('site.home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sobre Nós</script></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Breadcrumbs End -- -->

    <!-- Main Body Content Start -->
    <main id="body-content">

            <!-- About Us Style Start -->
            <section class="wide-tb-100 bg-white shadow">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-7 col-md-12">
                            <div class="text-center">
                                <img src="{{asset('asset/images/about_img.png')}}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <h1 class="heading-main">
                                <small>Sobre nós</small>
                                Dê um passo à frente, sirva a humildade, alcance e ajude
                            </h1>

                            <p>O segredo da felicidade está em ajudar os outros. Nunca subestime a diferença que VOCÊ pode fazer nas vidas dos pobres, dos abusados ​​e dos desamparados. Espalhe a luz do sol em suas vidas, não importa o clima.</p>

                            <div class="d-flex">
                                <a class="btn btn-default me-3" href="{{ route('login') }}">Inscreva-se agora</a>
                                <div class="sobre-telefone">
                                    <i data-feather="phone-call"></i>
                                    Contate-nos <br> +244 911 111 111
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </section>
            <!-- About Us Style Start -->

        <!-- Get to Know Us Style End -->



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

       <!-- Callout Style Start -->
       <section class="wide-tb-100 bg-scroll bg-img-1 pos-rel callout-style-1">
        <div class="bg-overlay black opacity-50"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h1 class="heading-main light-mode laranja">
                        <small>Ajude outras pessoas</small>
                        Sonhamos em criar um futuro brilhante para as crianças carentes
                    </h1>

                </div>
            </div>
        </div>
    </section>


    </main>
@endsection
