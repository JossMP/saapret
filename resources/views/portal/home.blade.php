@extends('portal.layouts.app')

@section('title')
Sistema de Seguimiento de Egresados
@endsection

@section('content')

@include('portal.parts.slide')




<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">
    <div class="mx-auto px-8 py-8 lg:py-40 relative flex flex-col lg:flex-row items-center">
        <div class="lg:w-1/2 flex flex-col items-center lg:items-start">
            <h1 class="text-center lg:text-left text-3xl sm:text-5xl font-light text-blue-700 leading-tight mb-4">
                Bienvenido a
                <strong class="font-black text-3xl sm:text-4xl block uppercase">
                    [ {{ config('app.name_abrv') }} ]
                </strong>
            </h1>
            <p class="text-center lg:text-left sm:text-lg text-gray-500 lg:pr-40 leading-relaxed">
                {{ config('app.name') }}
            </p>
            <a href="{{ route('portal.graduate.index') }}"
                class="bg-blue-400 hover:bg-blue-500 my-4 lg:my-16 py-3 px-8 sm:text-lg rounded-full font-bold uppercase text-white tracking-widest">
                <i class="fa fa-search"></i> Profesionales
            </a>

        </div>
        <div class="w-full sm:w-2/3 lg:w-3/5 lg:absolute top-0 right-0 bottom-0 mt-16 lg:mr-8">
            <img src="{{asset('images/fondo-002.gif')}}" class="w-full">
        </div>
    </div>
</section>



<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">

    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
            <div class="col-span-6">
                <img src="{{ asset('images/slide/egresados.svg') }}" class="w-full" alt="Egresados">
            </div>
            <div class="col-span-6">
                <h1 class=" font-bold text-4xl md:text-5xl max-w-xl text-red-500 leading-tight">
                    ¿Egresado o Titulado?
                </h1>
                <hr class=" w-24 h-1 bg-red-400 rounded-full mt-4">
                <p class="text-gray-800 text-base leading-relaxed mt-4 font-semibold">
                    Solicite su usuario y clave para validar y verificar sus datos.
                </p>
                <div class="get-app flex space-x-5 mt-10 justify-center md:justify-start">
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
        </div>
    </div>

</section>

<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">
    <x-widget-statistics title=""></x-widget-statistics>
</section>

@endsection
