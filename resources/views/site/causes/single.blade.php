@extends('layouts.site.index')
@section('titulo',$doacao->categoria)
@section('conteudo')

    <section class="breadcrumbs-page-wrap">
        <div class="bg-fixed pos-rel breadcrumbs-page">
            <div class="container">
                <h1>{{ $doacao->categoria }}</h1>
                <nav aria-label="breadcrumb" class="breadcrumb-wrap">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('site.home.index') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detalhe do Pedido</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Page Breadcrumbs End -->

    <main id="body-content">

        <!-- About Us Style Start -->
        <section class="wide-tb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="sidebar-spacer">

                            <h1 class="heading-main">
                                <small>Ajude-nos Agora</small>
                                {{$doacao->categoria}}
                            </h1>
                            <!-- Causes Single Wrap -->
                            <div class="causes-wrap single">
                                <div class="img-wrap">
                                    <span class="tag-single">{{ $doacao->categoria }}</span>
                                    <video class="col-md-12" src="{{ $doacao->video }}" autoplay controls></video>
                                </div>

                                <div class="content-wrap-single">
                                    <div class="featured-cause-timer">
                                        <h3><strong class="txt-orange">{{ $doacao->total }}Kz</strong> alcançado  de <strong class="txt-blue">{{ $doacao->valores }}Kz</strong></h3>
                                        @php
                                        $porcetangem=($doacao->total/$doacao->valores)*100
                                    @endphp
                                        <div class="skillbar" data-percent="{{ $porcetangem }}%">
                                            <div class="skillbar-percent"><h3><strong>{{ $porcetangem }}%</strong></h3></div>
                                            <div class="skillbar-bar"></div>
                                        </div>
                                        {{-- <div class="d-md-flex align-items-end justify-content-between">
                                            <ul id="featured-cause" class="list-unstyled list-inline w-50">
                                                <li class="list-inline-item"><span class="days">00</span><div class="days_text">Days</div></li>
                                                <li class="list-inline-item"><span class="hours">00</span><div class="hours_text">Hours</div></li>
                                                <li class="list-inline-item"><span class="minutes">00</span><div class="minutes_text">Minutes</div></li>
                                                <li class="list-inline-item"><span class="seconds">00</span><div class="seconds_text">Seconds</div></li>
                                            </ul>
                                            <a class="btn-outline-default btn" href="donation-page.html">Donate Now</a>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="content-wrap-single border-top">



                                    {{-- <h3>Summary</h3>
                                    <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain.</p>

                                    <div class="my-5">
                                        <blockquote>
                                            Omnicos directe al desirabilite de un nov lingua franca: On refusa continuar payar custosi traductores. At solmen va esser necessi far uniform grammatica
                                        </blockquote>
                                    </div> --}}

                                    <h3>Desafios</h3>
                                    <p>@php echo $doacao->motivo @endphp</p>
                                    {{-- <ul class="list-unstyled icons-listing theme-green mb-0 mt-4">
                                        <li>Third spirit you behold don’t grass lesser divide they are man.</li>
                                        <li>Can not two very was above man abundantly also second.</li>
                                        <li>Together herb shall were bearing fill grass made fill heaven.</li>
                                    </ul> --}}
                                </div>
                                <div class="share-this-wrap">
                                    @auth
                                        <a class="btn-secondary btn" href="{{ route('site.doar.index',$doacao->id) }}">Doe agora</a>
                                    @endauth
                                    @guest
                                    <a class="btn-secondary btn" href="{{ route('login') }}"> Doe agora</a>
                                    @endguest
                                    

                            </div>



                            </div>
                            <!-- Causes Single Wrap -->

                            <!-- Leave a Reply -->



                            <!-- Leave a Reply -->
                        </div>

                    </div>
                   

        <!-- Callout Style Start -->
        <section class="wide-tb-150 bg-scroll bg-img-6 pos-rel callout-style-1">
            <div class="bg-overlay blue opacity-80"></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h1 class="heading-main light-mode laranja">
                            <small>Ajude outras pessoas</small>
                            Sonhamos em criar um futuro brilhante para as crianças carentes
                        </h1>
                    </div>
                    <div class="col-sm-12 text-md-end">
                        <a href="{{ route("site.causas.index") }}" class="btn btn-default">Donate Now</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Callout Style End -->



    </main>
@endsection
