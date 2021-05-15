@section('title', 'ADMIN')
    @extends('template.header')
@section('content')
    <br>
    <br>
    <br>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Url Shortener</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/login">Admin Panel</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/short/create">Admin Shorten</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Auth::check())
                                {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="/user">Edit Profile</a>
                            </li>
                            <li> <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                                          document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </ul>


                    @else
                        Guest
                        @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-md-8 g-4">
                            <div class="col-md-5">
                                <div class="card text-dark bg-light mb-3" style="width: 20rem;">
                                    <div class="card-header">Count All Shorten Links</div>
                                    <div class="card-body">

                                        @if (!empty($countShorten && $lastShorten))
                                            <h5 class="card-title">{{ $countShorten }} Links</h5>
                                            <p class="card-text"> Last Short : {{ $lastShorten[0] }}</p>
                                        @else

                                        @endif


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card text-dark bg-light mb-3" style="width: 20rem;">
                                    <div class="card-header">Last Shorten Url</div>
                                    <div class="card-body">

                                        @if (!empty($lastshortenLink && $lastshortenLink->short_link))
                                            <p> Original Link :
                                                {{ Str::limit($lastshortenLink->original_link, '20', '...') }}</p>
                                            <p class="card-text"> To : {{ $lastshortenLink->short_link }}</p>
                                        @else

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

    </div>
@endsection
