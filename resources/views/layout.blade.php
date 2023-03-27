<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <img class="avatares" src="{{ auth()->user()->avatar }}" alt="avatar">
            <h4 class="user">{{ auth()->user()->last_name }} {{ auth()->user()->first_name }}</h4>
            <h2 class="empresa">SkinaTech</h2>
            <span class="navbar-text">
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </span>
            </div>
        </div>
    </nav>
    <div class="row">
        <div class="col">
            <nav class="navar-vertical">
                <ul class="item">
                    @if(auth()->user()->rol == 1)
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/usuarios">Usuarios</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/categorys">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/subcategorys">Subcategorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Productos</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="col">
            <article>
                @yield('content')
            </article>
        </div>
        
    </div>
    <footer>
        <p>creado por Adilson Cuevas Espid</p>
        <p>Ingeniero Electronico</p>
    </footer>
</body>
</html>