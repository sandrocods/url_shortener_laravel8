@section('title', 'ADMIN SHORTURL')

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
            <div class="col-xl-10">

                <div class="card">
                    <div class="card-header">{{ __('Data Shorturl') }}</div>

                    <div class="card-body">
                        <div>
                            <a class="btn btn-primary" href="/short/create" role="button">Kembali</a>
                        </div>
                        <br>
                        <form method="POST" action="{{ route('short.update', $data_shorten->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <input type="text" class="form-control" id="exampleInputUrlHelp"
                                    aria-describedby="short_link" name="short_link"
                                    value="{{ Str::replace('/', '', parse_url($data_shorten->short_link, PHP_URL_PATH)) }}">
                                <div id="short_link" class="form-text"></div>
                                <div id="short_link" class="form-text">Masukan Custom Link di fields diatas tanpa
                                    {{ asset('/') }}</div>
                            </div>
                            <div class="mb-3">
                                <input type="url" class="form-control" id="exampleInputUrlHelp" aria-describedby="UrlHelp"
                                    name="Url_short" value="{{ $data_shorten->original_link }}">
                                <div id="UrlHelp" class="form-text"></div>
                                <div id="UrlHelp" class="form-text">Masukan Link yang akan disingkat di fields diatas</div>
                            </div>
                            @if (session('Pesan'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('Pesan') }}
                                </div>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                    @foreach ($errors->all() as $item_errors)
                                        <ul>
                                            <strong>{{ $item_errors }}</strong>
                                        </ul>
                                    @endforeach
                                </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection
@include('template.header')