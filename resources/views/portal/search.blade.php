@extends('portal.layout.portal')


@section('title')
Busqueda de profesionales
@endsection

@section('content')

@include('portal.parts.slide')

<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">
    <div class="text-center">
        <h1 class="font-bold text-4xl md:text-5xl  text-red-500 leading-tight">
            ¿Egresado o Titulado?
        </h1>
        <hr class=" w-24 h-1 bg-red-400 rounded-full mt-4">
        <p class="text-gray-800 text-base leading-relaxed mt-4 font-semibold">
            Solicite su usuario y clave para validar y verificar sus datos.
        </p>
        <div class="flex space-x-5 mt-10 justify-center md:justify-start">
            <a href="#" class="bg-white shadow-md px-3 py-2 rounded-lg flex items-center space-x-4">
                <div class="logo">
                    <i class="fa fa-user-graduate text-red-700 text-2xl"></i>
                </div>
                <div class="text">
                    <p class=" text-xs text-gray-600" style="font-size: 0.8rem;">
                        ¿Aun no estas registrado?
                    </p>
                    <p class=" text-sm font-semibold text-gray-900">
                        Registrate
                    </p>
                </div>
            </a>
            <a href="#" class="bg-white shadow-md px-3 py-2 rounded-lg flex items-center space-x-4">
                <div class="image">
                    <i class="fa fa-key text-red-700 text-2xl"></i>
                </div>
                <div class="text">
                    <p class="text-xs text-gray-600" style="font-size: 0.8rem;">
                        ¿Olvidaste tu clave?
                    </p>
                    <p class="text-sm font-semibold text-gray-900">
                        Pidelo aqui
                    </p>
                </div>
            </a>
        </div>
    </div>
</section>

@endsection
