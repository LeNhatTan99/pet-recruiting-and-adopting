@php
    $currentRoute = \Request::route()->getName();
@endphp

<header class="main-header">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container content-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="list-unstyled d-flex">
                    <li class="nav-menu-item">
                        <a href="{{route('home')}}">
                            <span class="{{$currentRoute === 'home' ? 'nav-menu-active' : ''}}">Home</span>
                        </a>
                    </li>
                    <li class="nav-menu-item">
                        <a href="{{route('adoptionCases')}}">
                            <span class="{{$currentRoute === 'adoptionCases' ? 'nav-menu-active' : ''}}">Adoption Cases</span>
                        </a>
                    </li>
                    <li class="nav-menu-item">
                        <a href="{{route('donationCases')}}">
                            <span class="{{$currentRoute === 'donationCases' ? 'nav-menu-active' : ''}}">Donation Cases</span>
                        </a>
                    </li>
                    <li class="nav-menu-item" for='news'>
                        <a id="news" href="{{route('news')}}">
                            <span class="{{$currentRoute === 'news' ? 'nav-menu-active' : ''}}">News</span>
                        </a>
                    </li>
                </ul>
            </div>
            <a class="navbar-brand nav-title" href="{{ route('home') }}">ANIMAL RECRUITING AND ADOPTING</a>
            <div class="ml-auto nav-action">
                @if (Auth::check())                   
                <div class="font-weight-bold px-3 btn-nav-action">
                    <div class="flex-container">
                        <i class="fa-solid fa-user"></i>
                        <span class="p-2">{{ Auth::user()->username }}</span>
                    </div>
                </div>
                    <div class="nav-action-box" style="z-index: 9">
                        <a href="{{route('show.profile',Auth::user()->username)}}">View Profile</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                @else
                    <a href="{{ route('login') }}" class="btn-signin">Sign In</a>
                @endif
            </div>
        </div>
    </nav>
</header>

@include('layouts.script')
