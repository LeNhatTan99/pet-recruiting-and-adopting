<header class="main-header">
    <nav class="navbar navbar-static-top">
        <div class="col-md-4 nav-menu">
            <ul class="list-unstyled d-flex">
                <li class="nav-menu-item"><a href="{{route('home')}}"><span class="nav-menu-active">Home</span></a></li>
                <li class="nav-menu-item"><a href="{{route('adoptionCases')}}"><span>Adoption Cases</span></a></li>
                <li class="nav-menu-item"><span>Donation Cases</span></li>
                <li class="nav-menu-item"><span>News</span></li>
            </ul>
        </div>
        <div class="col-md-3 nav-title">
            <span>ANIMAL RECRUITING AND ADOPTING</span>
        </div>
        <div class="col-md-4 nav-action">
            @if (Auth::check())                   
                <div class="font-weight-bold px-3 btn-nav-action"><i class="fa-solid fa-user "></i> <span class="p-2">{{ Auth::user()->username }}</span> 
                    <div class="nav-action-box" style="z-index: 9">
                        <a href="{{route('show.profile',Auth::user()->username)}}">View Profile</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            @else
                <a href="{{route('login')}}" class="btn-signin">Sign In</a>
            @endif
        </div>
    </nav>
</header>
@include('layouts.script')
