@extends('layouts.master')
@section('css')
   <link rel="stylesheet" href="{{asset('pages/home/css/style.css')}}">
@stop
@section('title')
   Home
@stop
@section('content')
   <div class="home">
      <div id="carousel" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-bs-target="#carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#carousel" data-bs-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <img class="d-block w-100" src="{{asset('/images/slide/slide1.png')}}" alt="First slide">
               <div class="carousel-container">
                  <div class="carousel-content">
                     <div class="pd-20">
                        <h2 class="text-align-center carousel-content-title">
                           <strong>Welcome to Our Animals Recruitment and Adoption Website!</strong>
                        </h2>
                        <p class="text-align-center">&nbsp;</p>
                        <p class="carousel-content-text">Are you looking for a furry companion to bring into 
                           your life? Or perhaps you're a kind-hearted soul eager to find loving homes for animals 
                           in need? You've come to the right place!</p>
                        <p class="carousel-content-text">Our Pet Recruitment and Adoption website is a heartwarming 
                           platform dedicated to connecting animals in search of forever homes with caring individuals 
                           and families. It's a place where compassion meets the love of animals, and where responsible 
                           pet adoption begins.&nbsp;</p>
                     </div>
                        <div class="text-align-center">
                           <a href="{{route('adoptionCases')}}" class="btn-read btn-carousel">
                              Ready to Adopt?
                           </a>
                        </div>
                  </div>
               </div>     
            </div>
            <div class="carousel-item">
               <img class="d-block w-100" src="{{asset('/images/slide/slide2.png')}}" alt="Second slide">
               <div class="carousel-container">
                  <div class="carousel-content">
                     <div class="pd-20">
                        <h1 class="text-align-center carousel-content-title">
                           <strong>What We Offer</strong>
                        </h1>
                        <p class="text-align-center">&nbsp;</p>
                        <p class="text-align-center carousel-content-text">&nbsp;<strong>A Haven for Animals</strong></p>
                        <p class="text-align-center carousel-content-text">&nbsp;<strong>Easy Adoption Process</strong></p>
                        <p class="text-align-center carousel-content-text">&nbsp;<strong>Comprehensive Information</strong></p>
                        <p class="text-align-center carousel-content-text">&nbsp;<strong>Community and Support </strong></p>
                        <p class="text-align-center carousel-content-text">&nbsp;<strong>Donation Opportunities</strong></p>
                        <p class="text-align-center carousel-content-text">&nbsp;<strong>Transparency and Accountability</strong></p>
                     </div>
                     <div class="text-align-center">
                        <a href="{{route('adoptionCases')}}" class="btn-read btn-carousel">
                           Ready to Foser?
                        </a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <img class="d-block w-100" src="{{asset('/images/slide/slide3.png')}}" alt="Third slide">
               <div class="carousel-container">
                  <div class="carousel-content">
                     <div class="pd-20">
                        <h1 class="text-align-center carousel-content-title">
                           <strong>Why Choose Us</strong>
                        </h1>
                        <p class="text-align-center">&nbsp;</p>
                        <p class="carousel-content-text">At our Pet Recruitment and Adoption website, we celebrate the joy of finding and giving forever homes. 
                           Join us in our mission to make the world a better place for pets and the people who love them. Adopt, 
                           share, support, and be part of a community that values compassion and responsibility.</p>
                        <p class="carousel-content-text">Start your adoption journey with us today, and let's make a difference, one furry friend at a time.&nbsp;</p>
                     </div>
                     <div class="text-align-center">
                        <a href="{{route('donationCases')}}" class="btn-read btn-carousel">
                           Willing to Donate?
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
      <div class="animal-case">
         <div class="pd-20">
            <h2 class="text-align-center font-weight-300">
               Animal Cases
            </h2>
         </div>
         <div class="pd-20">
            <p class="text-align-center font-weight-300 font-size-18">Visit to see each case of individual animal and choose to adopt or donate to them.</p>
         </div>
         <div class="text-align-center py-2 div-center">
            <a href="{{route('adoptionCases')}}" class="btn-go font-weight-300">
               Go
            </a>
         </div>
      </div>
      <div class="about-me">
         <div class="container">
            <div class="row about-me-padding">
               <div class="col-md-6">
                  <div class="about-me-thumbnail">
                     <div class="about-me-img">
                        <img src="{{asset('images/web/about-me-left.png')}}" alt="">
                     </div>
                     <div class="about-me-content">
                        <div class="pdy-20">
                           <h3 class="about-me-title">A Haven for Animals</h3>
                           <p class="about-me-description">
                              Our website serves as a haven for animals in search of loving homes. 
                              We work with reputable rescuers and shelters to list a wide variety of animals, 
                              from playful puppies and kittens to wise old companions.
                           </p>
                        </div>
                     </div>
                     <div class="about-me-btn">
                        <a href="{{route('adoptionCases')}}" class="btn-read btn-about-me">
                           Willing to Adopt?
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="about-me-thumbnail">
                     <div class="about-me-img">
                        <img src="{{asset('images/web/about-me-right.png')}}" alt="">
                     </div>
                     <div class="about-me-content">
                        <div class="pdy-20">
                           <h3 class="about-me-title">Community and Support</h3>
                           <p class="about-me-description">
                              Our platform is more than just a place to find pets. 
                              It's a community of animal lovers. Connect with others through our forum, 
                              share your adoption stories, and find the support and advice you need.
                           </p>
                        </div>
                     </div>
                     <div class="about-me-btn">
                        <a href="{{route('donationCases')}}" class="btn-read btn-about-me">
                           Willing to Donate?
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@stop
<script src="{{ asset('base/js/bootstrap.min.js') }}"></script>