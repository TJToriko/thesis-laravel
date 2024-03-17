@extends('users.user_layouts.app')

@section('page_title', 'Hillside Memorial Garden')
@section('home', 'active')

@section('hero')

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

            <!-- Slides -->
            @foreach ($carousels as $key => $carousel)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" style="background-image: url({{ asset('images/carousel_images/' . $carousel->image) }})">
                    <div class="carousel-container">
                        <div class="container"> 
                            <h2 class="animate__animated animate__fadeInDown">{{ $carousel->header }}</h2>
                            <p class="animate__animated animate__fadeInUp">{{ $carousel->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        </div>
    </section><!-- End Hero -->

@endsection

@section('content')

        <!-- ======= Featured Services Section ======= -->
        <section id="featured-services" class="featured-services section-bg">
            <div class="container">
    
            <div class="row no-gutters">
                <div class="col-lg-4 col-md-6">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-door-open"></i></div>
                    <h4 class="title"><a href="">Accessibility</a></h4>
                    <p class="description">Hillside Memorial Garden is conveniently located and accessible to both public and private transportation. This makes it easy for family and friends to visit the gravesite</p>
                </div>
                </div>
                <div class="col-lg-4 col-md-6">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-wallet"></i></div>
                    <h4 class="title"><a href="">Affordable</a></h4>
                    <p class="description">Hillside Memorial Garden offers a variety of burial options at affordable prices. This makes it a good option for families of all budgets</p>
                </div>
                </div>
                <div class="col-lg-4 col-md-6">
                <div class="icon-box">
                    <div class="icon"><i class="bi bi-calendar4-week"></i></div>
                    <h4 class="title"><a href="">Flexible</a></h4>
                    <p class="description">Hillside Memorial Garden is flexible and accommodating to the needs of each family. They offer a variety of payment options and can work with families to create a personalized funeral and cemetery plan</p>
                </div>
                </div>
            </div>
    
            </div>
        </section><!-- End Featured Services Section -->
  
        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container">
    
            <div class="section-title">
                <h2>About Us</h2>
                <p>{{ $aboutus->about_us_desc }}</p>
            </div>
    
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2">
                <img src="{{ asset('images/aboutus_images/' . $aboutus->about_us_image) }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                <h3>{{ $aboutus->header }}</h3>
                    <ul>
                        <ul>
                            @foreach (explode("\n", $aboutus->description) as $line)
                                <li><i class="bi bi-check-circled"></i>{{ $line }}</li>
                            @endforeach
                        </ul>
                    </ul>
                </div>
            </div>
    
            </div>
        </section><!-- End About Us Section -->
  
        <!-- ======= Why Us Section ======= -->
        <section id="why-us" class="why-us">
            <div class="container">
    
            <div class="section-title">
                <h2>Why Invest in Memorial Lots?</h2>
            </div>
    
            <div class="row no-gutters">
    
                <div class="col-lg-3 col-md-6 content-item">
                <span>01</span>
                <h4>Stable Investment</h4>
                </div>
    
                <div class="col-lg-3 col-md-6 content-item">
                <span>02</span>
                <h4>You Can Have An Asset</h4>
                </div>
    
                <div class="col-lg-3 col-md-6 content-item">
                <span>03</span>
                <h4>Extra Source of Income</h4>
                </div>
    
                <div class="col-lg-3 col-md-6 content-item">
                <span>04</span>
                <h4>Value Increase Overtime</h4>
                </div>
    
            </div>
    
            </div>
        </section><!-- End Why Us Section -->
  
        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">
    
                <div class="section-title">
                    <h2>Services</h2>
                </div>

                <div class="row">
                    @foreach ($services as $service)
                        <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
                            <div class="icon-box iconbox-blue">
                                <h4><a href="">{{ $service->service_name }}</a></h4>
                                <p>{{ $service->service_desc }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
    
            </div>
        </section><!-- End Services Section -->
    
        <!-- ======= policies and guidelines Section ======= -->
        <section id="why-us" class="why-us" style="margin-bottom: 2em;">
            <div class="container">
    
                <div class="section-title">
                    <h2>Policies and Guidelines</h2>
                </div>
        
                <div id="accordion">
        
                    <div class="accordion" id="accordionExample">
                        @foreach ($policys as $key => $policy)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $policy->id }}">
                                    <button class="accordion-button {{ $key === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $policy->id }}" aria-expanded="{{ $key === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $policy->id }}">
                                        <strong>{{ $policy->policy_name }}</strong>
                                    </button>
                                </h2>
                                <div id="collapse{{ $policy->id }}" class="accordion-collapse collapse {{ $key === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $policy->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>{{ $policy->policy_name }}</strong> {{ $policy->policy_desc}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
        
                </div>
    
            </div>
        </section><!-- End policies and guidelines Section -->
  
        <!----======= Cta Section ======= -->
        <section id="cta" class="cta">
          <div class="container">
  
            <div class="row">
              <div class="col-lg-12 text-center text-lg-start">
                <h3>Interment Requirements</h3>
                <h6>Please have the following documents with you when you go to the office for scheduling of interment.</h6>
                <ul>
                  <li>Certificate of Rights. Lot must be fully paid. Please settle your account by clicking on this link.</li>
                  <li>2 Valid ID’s of authorized transactee/ heirs.</li>
                  <li>Proof of Relationship (Birth Certificate/ Marriage Contract of transactee) *if applicable</li>
                  <li>Senior ID of deceased</li>
                  <li>PWD ID (if applicable)</li>
                  <li>Certified true copy of the Death Certificate</li>
                  <li>Burial Permit issued by the city or municipality</li>
                </ul>
  
                <h6>In the absence of Lot Owner</h6>
                <ul>
                  <li>Authorization letter of Lot Owner for his/her representatives to sign the interment documents</li>
                  <li>2 Valid ID’s from the Lot Owner (Photocopy/ Scanned Copy with 3 specimen signatures)</li>
                  <li>2 Valid ID’s of authorized representative (Actual signing the office)</li>
                  <li>Undertaking/ Extrajudicial Settlement (If applicable)</li>
                </ul>
  
                <h6>Bones</h6>
                  <ul>
                    <li>Exhumation Permit per set of bones</li>
                    <li>Certificate of Cadaver/ Exhumation</li>
                    <li>Exhumation Receipts</li>
                    <li>Burial Permit per bone</li>
                  </ul>
  
                  <h6>Ash</h6>
                  <ul>
                    <li>Cremation Certificate</li>
                    <li>Burial Permit</li>
                  </ul>
                <p style="font-style: italic;">Note: The foregoing rules and regulations are subject to revisions, alterations or amendments from time to time for the best interest of all parties concerned.</p>
                </div>
            </div>  
  
          </div>
        </section>

@endsection