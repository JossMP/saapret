@extends('portal.layouts.app')

@section('title')
{{ $person->name }} {{ $person->last_name }}
@endsection

@section('content')

<section class="w-full px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64">
    <div class="w-full relative mt-1 shadow-2xl rounded overflow-hidden">
        <div class="top h-64 w-full bg-red-200 overflow-hidden relative">
            <img src="{{ asset('images/fondo-001.jpg') }}" alt=""
                class="w-full h-full object-cover object-center absolute z-0">
            <div class="flex flex-col justify-center items-center relative h-full bg-black bg-opacity-50 text-white">
                <img src="{{ $person->photo }}"
                    class="h-40 w-40 object-contain bg-white rounded-full border-white border-2"
                    title="{{ $person->name }} {{ $person->last_name }}">
                <h1 class="text-2xl font-semibold">{{ $person->name }} {{ $person->last_name }}</h1>
                <h4 class="text-sm font-semibold">{{ $person->doc_type }} {{ $person->doc_num }}</h4>
            </div>
        </div>
        <div class="grid justify-items-center bg-white">
            <form action="{{ route('portal.person.experience.store',$person) }}" method="POST"
                class="w-full md:w-3/4 h-full pb-12 px-4 pt-4" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div>
                    <h3 class="text-xl tracking-wide uppercase font-semibold">
                        Experiencia Laboral
                    </h3>
                    <hr class="bg-gradient-to-r from-red-300 to-white h-1">
                </div>

                <div class="bg-white shadow-md rounded pt-6 pb-8 mb-4 my-3">
                    <div class="grid grid-cols-4 gap-4 mx-4 pb-4">
                        <div class="md:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="institution">
                                Institucion
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('institution') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="institution" name="institution" type="text"
                                placeholder="Ejem.: Colegio y academia Nicola Tesla" value="{{ old('institution') }}"
                                required>
                            @error('institution')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-1 col-span-2">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="start_date">
                                Fecha Inicio
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('start_date') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="start_date" name="start_date" type="date" placeholder="facha inicio"
                                value="{{ old('start_date') }}" required>
                            @error('start_date')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-1 col-span-2">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="end_date">
                                Fecha Culminacion
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('end_date') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="end_date" name="end_date" type="date" placeholder="Fecha fin"
                                value="{{ old('end_date') }}" required>
                            @error('end_date')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="position">
                                Cargo ocupado
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('position') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="position" name="position" type="text" placeholder="Ejem.: Asesor estudiantil"
                                value="{{ old('position') }}" required>
                            @error('position')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="mention">
                                Tarea desempeñada
                            </label>
                            <textarea name="mention" id="mention"
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('mention') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                rows="5"
                                placeholder="Descripcion de tarea desarrollada en la institucion">{{ old('mention') }}</textarea>
                            @error('mention')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @auth
                    @if(Auth::user()->can('people.update') || Auth::user()->id==$person->user_id)
                    <div class="mx-4 pb-4">
                        <div class="w-full text-right">
                            <a href="{{ route('portal.person.show', $person) }}" class="text-red-400">Cancelar</a>
                            <button type="submit"
                                class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase">
                                <i class="fa fa-save"></i>
                                Guardar
                            </button>
                        </div>
                    </div>
                    @endif
                    @endauth
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
