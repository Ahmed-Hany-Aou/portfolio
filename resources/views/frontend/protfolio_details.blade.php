@php

$allfooter = App\Models\Footer::find(1);

@endphp
@extends('frontend.main_master')
@section('main')
 <main>
            <!-- breadcrumb-area -->
            <section class="breadcrumb__wrap">
                <div class="container custom-container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8 col-md-10">
                            <div class="breadcrumb__wrap__content">
                                <h2 class="title">{{ $portfolio->portfolio_name }}</h2>
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">{{ $portfolio->portfolio_name }}</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="breadcrumb__wrap__icon">
                    <ul>
                        <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon01.png') }}" alt=""></li>
                        <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon02.png') }}" alt=""></li>
                        <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon03.png') }}" alt=""></li>
                        <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon04.png') }}" alt=""></li>
                        <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon05.png') }}" alt=""></li>
                        <li><img src="{{ asset('frontend/assets/img/icons/breadcrumb_icon06.png') }}" alt=""></li>
                    </ul>
                </div>
            </section>
            <!-- breadcrumb-area-end -->
            <!-- portfolio-details-area -->
            <section class="services__details">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="services__details__thumb">
  <img src=" {{ asset($portfolio->portfolio_image) }} " alt="">
                            </div>
                            <div class="services__details__content">
                                <h2 class="title">{{ $portfolio->portfolio_title }}</h2>
                                <p> {!! $portfolio->portfolio_description !!} </p>
                                
                                 
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <aside class="services__sidebar">
                                <div class="widget" class="container mb-5">
                                    <h5 class="title">Get in Touch </h5>
                                    <form action="#" class="sidebar__contact">
                                        <input type="text" placeholder="Enter name*">
                                        <input type="email" placeholder="Enter your mail*">
                                        <textarea name="message" id="message" placeholder="Massage*"></textarea>
                                        <button type="submit" class="btn">send massage</button>
                                    </form>
                                </div>
                                <div class="container mb-5">
                                <div class="widget" >
                                    <h5 class="title">Project Information</h5>
                                    <ul class="sidebar__contact__info">
                                        <li><span>Date :</span> January, 2021</li>
                                        <li><span>Location :</span> East Meadow NY 11554</li>
                                        <li><span>Client :</span> American</li>
                                        <li class="cagegory"><span>Category :</span>
                                            <a href="portfolio.html">Photo,</a>
                                            <a href="portfolio.html">UI/UX</a>
                                        </li>
                                        <li><span>Project Link :</span> <a href="portfolio-details.html">https://www.yournews.com/</a></li>
                                    </ul>
                                </div>
                                <div class="widget">
                                    <h5 class="title">Contact Information</h5>
                                    <ul class="sidebar__contact__info">
                                        <li><span>Address :</span> {{$allfooter->adress}} 
                                        <li> <span>Email : </span> <a href="mailto:{{ $allfooter->email }}" class="mail">{{ $allfooter->email }}</a></li>
                                        <li><span>Phone :</span> {{ $allfooter->number }}</li>
                                    </ul>
                                    <ul class="sidebar__contact__social">
                                        <li><a href="{{ $allfooter->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                                     <li><a href="{{ $allfooter->linkedin }}"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="{{ $allfooter->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                      
                                        
                                    </ul>
                                </div>
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
            <!-- portfolio-details-area-end -->
            <!-- contact-area -->
            @include('frontend.partials.contact') 
            <!-- contact-area-end -->
        </main>
@endsection