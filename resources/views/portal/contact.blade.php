@extends('portal.layouts.app')

@section('title')
Repositorio Digital
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
                                Contactenos
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
    <form class="w-full md:w-1/2" method="POST" action="{{ route('portal.contact.save') }}">
        @csrf
        <div class="flex gap-x-2 mb-6">
            <div class="w-full md:w-1/2 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                    Nombres
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('name') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="name" name="name" type="text" placeholder="Nombres" value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
            <div class="w-full md:w-1/2">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="last-name">
                    Apellidos
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('last_name') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                    id="last-name" name="last_name" type="text" placeholder="Apellidos" value="{{ old('last_name') }}">
                @error('last_name')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex gap-x-2 mb-6">
            <div class="w-full">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                    E-mail
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border @error('email') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="email" name="email" type="email" placeholder="Correo electronico" value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex gap-x-2 mb-6">
            <div class="w-full">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Mensaje
                </label>
                <textarea
                    class=" no-resize appearance-none block w-full bg-gray-200 text-gray-700 border @error('message') border-red-500 @else border-gray-200 @enderror rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white h-48 resize-none"
                    id="message" name="message"
                    placeholder="Cuentenos su inquietud o sugerencia.">{{ old('message') }}</textarea>
                @error('message')
                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="flex gap-x-2 mb-6 justify-center">
            <div class="w-full">
                <button
                    class="block shadow bg-blue-500 hover:bg-blue-700 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-8 rounded"
                    type="submit">
                    Enviar
                </button>
            </div>
        </div>
    </form>
    <div class="hidden md:block md:w-1/2">
        {{-- <iframe src="https://www.google.com/maps/d/embed?mid=1SN7oDfT5DRWyB2SIgss6z3l12Sy4PWLZ" width="100%"
            height="480"></iframe> --}}
        Visitenos en:
        <img src="https://d500.epimg.net/cincodias/imagenes/2015/10/29/lifestyle/1446136907_063470_1446137018_noticia_normal.jpg"
            alt="Ubicacion">
    </div>
</section>

@endsection
