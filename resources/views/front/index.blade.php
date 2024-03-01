@extends('layouts.app')

@section('content')
<style>
    .card.product-card {
        background-color: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card.product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
    }

    .about-section {
        background-color: #f9f9f9;
        padding: 30px;
        border-radius: 10px;
    }

    .about-section h2 {
        color: #000; /* Cambio de color a negro */
        font-size: 28px;
    }

    .about-section p {
        color: #000; /* Cambio de color a negro */
        font-size: 16px;
        line-height: 1.6;
    }

    .product-card img {
        width: 100%; /* Para que todas las imágenes tengan el mismo ancho */
        height: auto; /* Para mantener la proporción */
        filter: grayscale(100%) saturate(0); /* Convertir las imágenes a escala de grises y reducir la saturación */
        transition: filter 0.5s ease; /* Transición para suavizar el cambio de saturación */
    }

    .product-card:hover img {
        filter: grayscale(0) saturate(100%); /* Al pasar el cursor sobre la tarjeta, revertir la escala de grises y aumentar la saturación */
    }

    .product-card .card-body {
        color: #000; /* Cambiar color de texto a negro */
    }

    /* Animation for product card */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card {
        animation: fadeInUp 0.5s ease forwards;
    }

    /* Animation for "Quiénes somos" section */
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-20px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    .about-section {
        animation: slideInLeft 0.5s ease forwards;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
                @include('front.partial.msg')
                @foreach ($products as $item)
                <div class="col-md-4 mb-4">
                    <div class="card product-card">
                        <img src="/img/{{$item->image}}" class="card-img-top" alt="{{$item->name}}">
                        <div class="card-body">
                            <h5 class="card-title">{{$item->name}}</h5>
                            <p class="card-text">$ {{$item->price}}</p>
                            <form action="{{route('add')}}" method="post">
                                @csrf
                                <input type="hidden" name="id" value="{{$item->id}}">
                                <button type="submit" class="btn btn-success btn-block">Agregar al Carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-10 mt-4">
            <div class="about-section">
                <h2 class="text-center mb-4">¿Quiénes somos?</h2>
                <p>Somos una empresa dedicada a la venta de productos de alta calidad. Contamos con una amplia gama de productos que se adaptan a las necesidades de nuestros clientes. Nuestra misión es proporcionar productos de calidad y una experiencia de compra excepcional.</p>
            </div>
        </div>
    </div>
</div>
@endsection
