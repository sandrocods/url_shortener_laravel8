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
                    <div class="card-header">{{ __('Admin ShortUrl') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('short.store') }}">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <input type="text" class="form-control" id="exampleInputUrlHelp"
                                    aria-describedby="short_link" name="short_link"
                                    placeholder="{{ asset('/CUSTOM_LINK') }}">
                                <div id="short_link" class="form-text"></div>
                                <div id="short_link" class="form-text">Masukan Custom Link di fields diatas tanpa
                                    {{ asset('/') }}</div>
                            </div>
                            <div class="mb-3">
                                <input type="url" class="form-control" id="exampleInputUrlHelp" aria-describedby="UrlHelp"
                                    name="Url_short">
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
                            <button type="submit" class="btn btn-primary">Shorten</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card">
                    <div class="card-header">{{ __('Data Shorturl') }}</div>

                    <div class="card-body">
                        <div>
                            <form class="form-inline" action="{{ route('search.data') }}" method="GET">
                                @method('GET')
                                @csrf
                                <input class="form-control mr-sm-2" type="search" placeholder="Data by Original Link"
                                    aria-label="Search" name="kata">
                                <br>
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                                <br>
                            </form>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Short Link</th>
                                    <th scope="col">Original Link</th>
                                    <th scope="col">Created At </th>
                                    <th scope="col">Handle </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_shorten as $item_data_shorten)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item_data_shorten->short_link }}</td>
                                        <td>{{ Str::limit($item_data_shorten->original_link, '20', '...') }}</td>
                                        <td>{{ $item_data_shorten->created_at }}</td>
                                        <td>
                                            <form action="{{ route('short.destroy', $item_data_shorten->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <div class="d-grid gap-2 d-md-block">
                                            <a class="btn btn-info" href="{{ route('short.show', $item_data_shorten->id)}}" role="button">Info</a>
                                            <a class="btn btn-warning" href="{{ route('short.edit', $item_data_shorten->id)}}" role="button">Edit</a>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $data_shorten->links()}}
                </div>
            </div>
        </div>
    </div>
    </div>
    <br>
    <br>
@endsection
@include('template.header')
