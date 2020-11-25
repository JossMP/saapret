@extends('portal.layout.portal')

@section('title')
Términos de Uso
@endsection

@section('content')

<section class="w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4 bg-center bg-cover"
    style="background-image: url({{asset('images/slide/contact-banner.png')}})">
    <div class="pt-16">
        <div class="max-w-screen-xl mx-auto py-16 lg:flex lg:items-center lg:justify-center">
            <div class="leading-9 font-extrabold tracking-tight">
                <header class="pb-5">
                    <div class="items-center flex flex-wrap">
                        <div class="w-full ml-auto mr-auto text-center">
                            <h1 class="text-3xl text-gray-100 sm:text-4xl sm:leading-10 uppercase">
                                Términos de Uso
                            </h1>
                        </div>
                    </div>
                    <div class="flex justify-center items-">
                        <div class="w-32 border-solid border-b-2 border-gray-400 "></div>
                        <div class="w-20 border-solid border-b-4 border-red-600"></div>
                        <div class="w-32 border-solid border-b-2 border-gray-400"></div>
                    </div>
                </header>
            </div>
        </div>
    </div>
</section>

@include('portal.parts.message')

<section class="flex bg-transparent w-full px-5 sm:px-8 pt-8 lg:px-16 xl:px-40 2xl:px-64 gap-x-2">
    AQUI HTML DE TERMINOS DE USO
</section>

@endsection
