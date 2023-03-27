@extends('layout')

@section('content')
    <div class="contenido">
        <div class="row sesiones">
            <div class="col titulo">
                <h4>Usuarios Registrados</h4>
            </div>
            @if(auth()->user()->rol == 1)
                <div class="col registro">
                    <button class="btn btn-primary" onclick="window.modal.showModal();">Registrar usuarios</button>

                    <dialog id="modal" class="modalaction">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar Usuarios</h5>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" action="{{ route('createUser') }}" accept-charset="UTF-8" enctype="multipart/form-data">
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
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" onclick="window.modal.close();">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </dialog>
                </div>
            @endif
        </div>
        <div class="useres row">
            @foreach ($users as $user)
                <div class="card">
                    <img src="{{ $user->avatar }}" class="card-img-top avat" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->last_name }} {{ $user->first_name }}</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{ $user->email }}</li>
                        <li class="list-group-item">{{ $user->phone }}</li>
                        <li class="list-group-item">
                            @if ( $user->rol == 1)
                                Administrador
                            @else
                                Basico
                            @endif
                        </li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Estado</a>
                        <button class="card-link" onclick="window.modal{{ $user->id }}.showModal();">Editar</button>

                        <dialog id="modal{{ $user->id }}" class="modalaction">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Actualizar Usuarios</h5>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" id="form" action="{{ route('actualizar') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                        @csrf
                                            <input type="text" name="id" value="{{ $user->id }}" style="display: none">
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">Nombres</label>
                                                        <input value="{{ $user->last_name }}" type="text" id="last_name" name="last_name" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">Apellidos</label>
                                                        <input value="{{ $user->first_name }}" type="text" id="first_name" name="first_name" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">Nombre de Usuario</label>
                                                        <input value="{{ $user->username }}" type="text" id="username" name="username" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label" for="form3Example3">Correo Electronico</label>
                                                    <input value="{{ $user->email }}" type="email" id="email" name="email" class="form-control" placeholder="@lang('entidades@gmail.com')"/>
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
                                                        <input value="{{ $user->phone }}" type="text" id="phone" name="phone" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label" for="form3Example3">Rol</label>
                                                    <select value="{{ $user->rol }}" class="form-select" id="rol" name="rol" aria-label="Default select example">
                                                        <option selected>Seleccionar rol</option>
                                                        <option value="1">Administrador</option>
                                                        <option value="2">Basico</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label" for="form3Example1">Avatar</label>
                                                    <input value="{{ $user->avatar }}" class="form-control" type="file" id="avatar" name="avatar">
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <label class="form-label" for="form3Example1">Estado</label>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="Status" name="Status">
                                                        <label class="form-check-label" for="flexSwitchCheckDefault">Activo</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" onclick="window.modal{{ $user->id }}.close();">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </dialog>
                        <form action="{{ route('destroy', $user->id)}}" method="post">
                            @method('DELETE')
                             @csrf
                            <input class="btn btn-danger" type="submit" value="Eliminar" />
                        </form>
                    </div>
                </div>
            @endforeach
            <div class="card">
                <img src="/avatars/avatar.jfif" class="card-img-top avat" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Adilson Cuevas</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Mail: cuevasadilson@gmail.com</li>
                    <li class="list-group-item">Telefono: 1234567890</li>
                    <li class="list-group-item">Rol: Administrador</li>
                </ul>
                <div class="card-body">
                    <a href="#" class="card-link">Estado</a>
                    <a href="#" class="card-link">Editar</a>
                    <a href="#" class="card-link">Eliminar</a>
                </div>
            </div>

            <div class="card">
                <img src="/avatars/avatar.jfif" class="card-img-top avat" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Adilson Cuevas</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Mail: cuevasadilson@gmail.com</li>
                    <li class="list-group-item">Telefono: 1234567890</li>
                    <li class="list-group-item">Rol: Administrador</li>
                </ul>
                @if(auth()->user()->rol == 1)
                    <div class="card-body">
                        <a href="#" class="card-link">Estado</a>
                        <a href="#" class="card-link">Editar</a>
                        <a href="#" class="card-link">Eliminar</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection