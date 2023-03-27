<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/logins.css')}}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Sign in</title>
</head>
<body>
    <section class="text-center ">
        <div class="p-5 bg-image" style="background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg');
                height: 300px;">
        </div>

    <div class="card2 mx-5 mx-md-6 shadow-5-strong">
        <div class="card-body py-5 px-md-5">

        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
            <h2 class="fw-bold mb-5">Registrarse</h2>
            <form role="form" action="/registers" method="POST" id="login-form" autocomplete="off" class="mt-3" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Nombres</label>
                            <input type="text" id="last_name" name="last_name" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Apellidos</label>
                            <input type="text" id="first_name" name="first_name" class="form-control" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Nombre de Usuario</label>
                            <input type="text" id="username" name="username" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example3">Correo Electronico</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="@lang('entidades@gmail.com')"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example4">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" />
                    </div>
                    <div class="col-md-6 mb-8">
                        <label class="form-label" for="form3Example4">Confirmar Contraseña</label>
                        <input type="password" id="password2" name="password2" class="form-control" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="form3Example1">Telefono</label>
                            <input type="text" id="phone" name="phone" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example3">Rol</label>
                        <select class="form-select" id="rol" name="rol" aria-label="Default select example">
                            <option selected>Seleccionar rol</option>
                            <option value="1">Administrador</option>
                            <option value="2">Basico</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example1">Avatar</label>
                        <input class="form-control" type="file" id="avatar" name="avatar">
                    </div>
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="form3Example1">Estado</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="Status" name="Status">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Activo</label>
                        </div>
                    </div>
                </div>
                <div class="g-recaptcha" data-sitekey="6LeCEegiAAAAANr811kvBGY3kbrhJdmeIRYGsrue"></div>
                @if (Session::has('g-recaptcha-response'))
                    <p class="alert {{Session::get('alert-class', 'alert-info')}}">
                        {{ Session::get('g-recaptcha-response') }}
                    </p>
                @endif
                <br/>
                <button type="submit" class="btn btn-primary btn-block mb-4">Sign up</button>

                <div class="text-center"><a href="login">Inicio de sesión</a></div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </section>
    
</body>
</html>