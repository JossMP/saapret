@extends('portal.layout.app')

@section('title')
{{ $book->title }}
@endsection

@section('content')

<section class="w-full px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 pt-32">
    <div class="grid grid-cols-4">
        <div class="hidden md:block col-span-1 pb-3">
            @include('portal.parts.sidebar')
        </div>
        <div class="col-span-4 md:col-span-3">
            <section class="w-full md:pl-2 py-2">
                <article class="text-white w-full">
                    <section class="flex bg-transparent w-full gap-x-2">
                        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                            <div class="px-4 py-5 border-b border-green-500 sm:px-6">
                                <div class="w-full ml-auto mr-auto text-center">

                                    <div
                                        class="flex items-stretch px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                                        <dd
                                            class="self-center mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2 items-top">
                                            <h1 class="text-gray-600 font-bold text-xl text-indigo-600 uppercase">
                                                {{ $book->title }}
                                            </h1>
                                        </dd>
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            <img class="object-contain md:w-full rounded-lg shadow-image w-48"
                                                style="max-height:18rem"
                                                src="{{ Storage::disk('local')->url( 'books/portada/' . $book->cover_image ) }}"
                                                alt="{{$book->title}}">
                                        </dt>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <dl>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Resumen
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ nl2br($book->summary) }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Especialidad o Carrera
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->specialty->name }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Tipo de Publicacion
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->publication_type->name }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Editorial
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->editorial }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Paginas
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->pages }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Año Edicion
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->year_edition }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Pais
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->country }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            ISBN/ISSN
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->isbn_issn }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Codigo Interno
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->internal_code }}
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Codigo de Barras
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->barcode }}
                                        </dd>
                                    </div>
                                    @if ($book->authors->count())
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Autor(es)
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            @foreach ($book->authors as $author)
                                            <div
                                                class="border border-gray-400 rounded-md pl-4 flex items-center py-2 mt-1">
                                                <div class="flex-shrink-0 h-8 w-8">
                                                    <img class="h-8 w-8 rounded-full"
                                                        src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&length=2&bold=true&name={{$author->name}}+{{$author->last_name}}"
                                                        alt="{{ $author->name }} {{ $author->last_name }}">
                                                </div>
                                                <div class="ml-2">
                                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                                        {{ $author->name }} {{ $author->last_name }}
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </dd>
                                    </div>
                                    @endif
                                    @if ( $book->file_path )
                                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Descarga
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            <ul class="border border-gray-400 rounded-md">
                                                <li
                                                    class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                                                    <div class="w-0 flex-1 flex items-center">
                                                        <svg class="flex-shrink-0 h-5 w-5 text-gray-400"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor">
                                                            <path fill-rule="evenodd"
                                                                d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="ml-2 flex-1 w-0 truncate">
                                                            {{ $book->slug }}
                                                        </span>
                                                    </div>
                                                    <div class="ml-4 flex-shrink-0">
                                                        <a href="{{ route('portal.books.download', $book) }}"
                                                            target="_blank"
                                                            class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                                                            Descargar
                                                        </a>
                                                    </div>
                                                </li>
                                            </ul>
                                        </dd>
                                    </div>
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Nro. Descargas
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->download }}
                                        </dd>
                                    </div>
                                    @endif
                                    <div
                                        class="px-4 py-2 border-b border-green-200 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm leading-5 font-medium text-gray-500">
                                            Nro. Vistas
                                        </dt>
                                        <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{ $book->view }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </section>
                </article>
            </section>
        </div>
    </div>
</section>

<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">
    <div class="bg-gray-50 md:grid grid-cols-3 sm:gap-x-3">
        <dt class="overflow-hidden rounded-md border mt-1">
            <x-widget-featured-authors type="download"></x-widget-featured-authors>
        </dt>
        <dt class="overflow-hidden rounded-md border mt-1">
            <x-widget-featured-authors type="view"></x-widget-featured-authors>
        </dt>
        <dt class="overflow-hidden rounded-md border mt-1">
            <x-widget-featured-authors type="count"></x-widget-featured-authors>
        </dt>
    </div>
</section>

@endsection
