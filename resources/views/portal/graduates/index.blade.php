@extends('portal.layout.portal')


@section('title')
Lista de Graduados
@endsection

@section('content')

@include('portal.parts.slide')

<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">
    <div class="text-center">
        <h1 class="font-bold text-4xl md:text-2xl text-red-500 leading-tight">
            Lista de Graduados
        </h1>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 pt-3">

            @foreach ($graduates as $graduate)
            @include('portal.graduates.parts.card')
            @endforeach

        </div>
        <div class="py-4">
            {{ $graduates->onEachSide(1)->links() }}
        </div>
    </div>
</section>

<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">
    <x-widget-statistics title="Ver por carrera"></x-widget-statistics>
</section>

@endsection
