@extends('layout')

@section('content')
    <div class="contenido">
        <div class="row sesiones">
            <div class="col titulo">
                <h4>Productos Activos</h4>
            </div>
            @if(auth()->user()->rol == 1)
                <div class="col registro">
                    <button class="btn btn-primary" onclick="window.modal.showModal();">Registrar productos</button>

                    <dialog id="modal" class="modalaction">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Registrar productos</h5>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="form" action="{{ route('guardarproduc') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-md-14 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Nombre de producto</label>
                                                <input type="text" id="name" name="name" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-14 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Descripcion</label>
                                                <input type="textarea" id="description" name="description" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-14 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Precio</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">$</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="valor" name="valor">
                                                    <span class="input-group-text">COP</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-14 mb-4">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">Cantidad</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">Total</span>
                                                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="cantidad" name="cantidad">
                                                    <span class="input-group-text">unidades</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-9 mb-4">
                                            <label class="form-label" for="form3Example3">SubCategoria</label>
                                            <select class="form-select" id="subcategory" name="subcategory" aria-label="Default select example">
                                                <option selected>Seleccionar categoria</option>
                                                @foreach ($subcategory as $subcategory)
                                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name_subcategory }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-14 mb-4">
                                            <label class="form-label" for="form3Example1">Imagen</label>
                                            <input class="form-control" type="file" id="imagen" name="imagen">
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
        <div class="products useres row">
            @foreach ($productos as $producto)
                <div class="card">
                    <img src="{{ $producto->imagen }}" class="card-img-top imagenes" alt="{{ $producto->imagen }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->name_product }}</h5>
                        <p class="card-text">{{ $producto->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Subcategoria: {{ $producto->subcategory }}</li>
                        <li class="list-group-item">Precio: {{ $producto->valor }}</li>
                        <li class="list-group-item">Cantidad: {{ $producto->cantidad }}</li>
                    </ul>
                    @if(auth()->user()->rol == 1)
                        <div class="card-body">
                            <button class="btn btn-primary" onclick="window.modal{{ $producto->id }}.showModal();">Actualizar productos</button>

                            <dialog id="modal{{ $producto->id }}" class="modalaction">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Actualizar productos</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" id="form" action="{{ route('editproduc') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                                                @csrf
                                                <input type="text" name="id" value="{{ $producto->id }}" style="display: none">
                                                <div class="col-md-14 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">Nombre de producto</label>
                                                        <input value="{{ $producto->name_product }}" type="text" id="name" name="name" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-14 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">Descripcion</label>
                                                        <input value="{{ $producto->description }}" type="textarea" id="description" name="description" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-md-14 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">Precio</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">$</span>
                                                            <input value="{{ $producto->valor }}" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="valor" name="valor">
                                                            <span class="input-group-text">COP</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-14 mb-4">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">Cantidad</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text">Total</span>
                                                            <input value="{{ $producto->cantidad }}" type="text" class="form-control" aria-label="Amount (to the nearest dollar)" id="cantidad" name="cantidad">
                                                            <span class="input-group-text">unidades</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 mb-4">
                                                    <label class="form-label" for="form3Example3">SubCategoria</label>
                                                    <select value="{{ $producto->subcategory }}" class="form-select" id="subcategory" name="subcategory" aria-label="Default select example">
                                                        <option selected>Seleccionar categoria</option>
                                                        @foreach ($subcategories as $subcategories)
                                                            <option value="1">limpieza</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-14 mb-4">
                                                    <label class="form-label" for="form3Example1">Imagen</label>
                                                    <input value="{{ $producto->imagen }}" class="form-control" type="file" id="imagen" name="imagen">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" onclick="window.modal{{ $producto->id }}.close();">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </dialog>
                            <form action="{{ route('destroy_produc', $producto->id)}}" method="post">
                                @method('DELETE')
                                @csrf
                                <input class="btn btn-danger" type="submit" value="Eliminar" />
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection