@extends('layout')

@section('content')
    <div class="table">
        <div class="row sesiones">
            <div class="col titulo">
                <h4>Subcategorias</h4>
            </div>
            @if(auth()->user()->rol == 1)
                <div class="col registro">
                    <button class="btn btn-primary" onclick="window.modal.showModal();">Crear Subcategoria</button>

                    <dialog id="modal" class="modalaction">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear Subcategoria</h5>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" action="{{ route('guardarsubcatg') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-15 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Nombre de subcategoria</label>
                                                <input type="text" id="name" name="name" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example3">Categoria</label>
                                            <select class="form-select" id="rol" name="rol" aria-label="Default select example">
                                                <option selected>Seleccionar categoria</option>
                                                @foreach ($categorys as $categorys)
                                                    <option value="{{ $categorys->id }}">{{ $categorys->name_category }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label class="form-label" for="form3Example1">Estado</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="Status" name="Status">
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
                    <th scope="col">Categoria</th>
                    <th scope="col">cantidad de Productos</th>
                    <th scope="col">Estado</th>
                    @if(auth()->user()->rol == 1)
                        <th scope="col">Acciones</th>
                    @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategory as $subcategory)
                    <tr>
                        <th scope="row">{{ $subcategory->id }}</th>
                        <td>{{ $subcategory->name_subcategory }}</td>
                        <td>{{ $subcategory->category }}</td>
                        <td>{{ $subcategory->Npruducts }}</td>
                        <td>{{ $subcategory->status }}</td>
                        @if(auth()->user()->rol == 1)
                            <div class="row">
                                <td>
                                    <button class="btn btn-primary" onclick="window.modal{{ $subcategory->id }}.showModal();">Actualizar Subcategoria</button>

                                    <dialog id="modal{{ $subcategory->id }}" class="modalaction">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Subcategoria</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" id="form" action="{{ route('editsubcatg') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="text" name="id" value="{{ $subcategory->id }}" style="display: none">
                                                        <div class="col-md-15 mb-4">
                                                            <div class="form-outline">
                                                                <label class="form-label" for="form3Example1">Nombre de subcategoria</label>
                                                                <input value="{{$subcategory->name_subcategory}}" type="text" id="name" name="name" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label class="form-label" for="form3Example3">Categoria</label>
                                                            <select value="{{$subcategory->category}}" class="form-select" id="category" name="category" aria-label="Default select example">
                                                                <option selected>Seleccionar categoria</option>
                                                                @foreach ($categories as $categories)
                                                                    <option value="{{$categories->id}}">{{$categories->name_category}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label class="form-label" for="form3Example1">Estado</label>
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input" type="checkbox" id="Status" name="Status">
                                                                <label class="form-check-label" for="flexSwitchCheckDefault">Activo</label>
                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" onclick="window.modal{{ $subcategory->id }}.close();">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </dialog>
                                    <form action="{{ route('destroy_subc', $subcategory->id)}}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <input class="btn btn-danger" type="submit" value="Eliminar" />
                                    </form>
                                </td>
                            </div>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection