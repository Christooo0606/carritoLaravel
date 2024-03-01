@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #333;
        color: rgb(0, 0, 0);
    }

    .card {
        margin-top: 50px;
        background-color: #ffffff;
        color: rgb(0, 0, 0);
    }

    .card-header {
        background-color: #222;
        border-bottom: 1px solid #ffffff;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table img {
        max-width: 100px;
        height: auto;
    }

    .subtotal,
    .tax,
    .total {
        font-weight: bold;
    }

    .btn-update,
    .btn-remove {
        padding: 0.25rem 0.5rem;
    }

    @media (max-width: 576px) {
        .table th:nth-child(1),
        .table td:nth-child(1) {
            display: none;
        }

        .btn-update,
        .btn-remove {
            margin-top: 5px;
        }
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <div class="card-header">
                <h4 class="text-center">Carrito</h4>
            </div>
            <div class="card-body">
                @if (Cart::count())
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Cart::content() as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><img src="/img/{{ $item->options->image }}" alt="{{ $item->name }}"></td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>${{ number_format($item->price, 2) }}</td>
                                    <td>${{ number_format($item->subtotal(), 2) }}</td>
                                    <td>
                                        <form action="{{ route('update', $item->rowId) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="number" name="qty" value="{{ $item->qty }}" min="1">
                                            <button type="submit" class="btn btn-primary btn-update">Actualizar</button>
                                        </form>
                                        <form action="{{ route('removeitem', $item->rowId) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-remove">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="subtotal text-right">Subtotal:</td>
                                <td class="subtotal">${{ number_format(Cart::subtotal(), 2) }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="tax text-right">IVA (16%):</td>
                                <td class="tax">${{ number_format(Cart::tax(), 2) }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="total text-right">Total:</td>
                                <td class="total">${{ number_format(Cart::total(), 2) }}</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="{{ route('clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Vaciar Carrito</button>
                    </form>
                @else
                    <p class="text-center">Agrega un producto <a href="/">aquí</a>.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<br><br>
<br><br>
<br><br>
@endsection
