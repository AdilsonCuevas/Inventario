<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link media="all" type="text/css" rel="stylesheet" href="{{asset('css/logins.css')}}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Login</title>
</head>
<body>
    <div style="width:100%; margin: 6% 8%; justify-content: center;">
        <div class="row" >
            <div class="col-md-6 card">
                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
                    class="img-fluid" alt="Sample image">
            </div>
            <div class="col-md-4 card">
                <div class="p-5">
                    <h5 class="card-title text-center mt-2 mb-5 text-uppercase">
                        @lang('Iniciar Sesión')
                    </h5>
                    <form role="form" action="/logins" method="POST" id="login-form" autocomplete="off" class="mt-3">
                        @csrf
                        <div class="form-group mb-3 ">
                            <input type="email" name="email" id="email" class="form-control input-solid"
                                placeholder="@lang('Correo Electrónico o Username')">
                            @error('email') <div>{{ $message}}</div> @enderror
                        </div>

                        <div class="form-group password-field mb-3 " >
                            <input type="password"name="password"id="password"class="form-control input-solid"
                                placeholder="@lang('Contraseña')">
                            @error('password') <div>{{ $message}}</div> @enderror
                        </div>
                        <div class="g-recaptcha" data-sitekey="6LeCEegiAAAAANr811kvBGY3kbrhJdmeIRYGsrue"></div>
                        @if (Session::has('g-recaptcha-response'))
                            <p class="alert {{Session::get('alert-class', 'alert-info')}}">
                                {{ Session::get('g-recaptcha-response') }}
                            </p>
                        @endif
                        <br/>
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <div class="form-check">
                                    <input class="form-check-input1" name="remember" type="checkbox" value="" id="form2Example31" checked />
                                    <label class="form-check-label" for="form2Example31">¿Mantener session activa?</label>
                                </div>
                            </div>
                            @if (Route::has('password.request'))
                                <div class="col">
                                    <a href="">¿Se te olvido su contraseña?</a>
                                </div>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

                        <div class="text-center">
                            <p>¿Aun no eres miembro? <a href="register">Registrate</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<style>
    body {
    background-color: #BDBDBD
    }
    </style>
</html>