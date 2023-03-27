@extends('layout')

@section('content')
<div class="table">
        <div class="row sesiones">
            <div class="col titulo">
                <h4>Categorias</h4>
            </div>
            @if(auth()->user()->rol == 1)
                <div class="col registro">
                    <button class="btn btn-primary" onclick="window.modal.showModal();">Crear Categoria</button>

                    <dialog id="modal" class="modalaction">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear Categoria</h5>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" action="{{ route('guardarcatg') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-15 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Nombre de categoria</label>
                                                <input type="text" id="name" name="name" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example1">Estado</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="status" name="status">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">Activo</label>
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
        <div class="contenido useres">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Estado</th>
                    @if(auth()->user()->rol == 1)
                        <th scope="col">Acciones</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $category)
                    <tr>
                        <th scope="row">{{ $category->id }}</th>
                        <td>{{ $category->name_category }}</td>
                        <td>{{ $category->status }}</td>
                        @if(auth()->user()->rol == 1)
                            <td>
                                <button class="btn btn-primary" onclick="window.modal{{ $category->id }}.showModal();">actualizarCategoria</button>

                                <dialog id="modal{{ $category->id }}" class="modalaction">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Actualizar Categoria</h5>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" id="form" action="{{ route('editcatg') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="text" name="id" value="{{ $category->id }}" style="display: none">
                                                    <div class="col-md-15 mb-4">
                                                        <div class="form-outline">
                                                            <label class="form-label" for="form3Example1">Nombre de categoria</label>
                                                            <input value="{{ $category->name_category }}" type="text" id="name" name="name" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-4">
                                                        <label class="form-label" for="form3Example1">Estado</label>
                                                        <div class="form-check form-switch">
                                                            <input class="form-check-input" type="checkbox" id="status" name="status">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">Activo</label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" onclick="window.modal{{ $category->id }}.close();">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </dialog> 
                                <form action="{{ route('destroy_categ', $category->id)}}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <input class="btn btn-danger" type="submit" value="Eliminar" />
                                </form>
                            </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection