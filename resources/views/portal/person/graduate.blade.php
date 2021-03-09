@extends('portal.layouts.app')

@section('title')
{{ $person->name }} {{ $person->first_last_name }} {{ $person->second_last_name }}
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
                    title="{{ $person->name }} {{ $person->first_last_name }} {{ $person->second_last_name }}">
                <h1 class="text-2xl font-semibold">{{ $person->name }} {{ $person->first_last_name }}
                    {{ $person->second_last_name }}</h1>
                <h4 class="text-sm font-semibold">{{ $person->doc_type }} {{ $person->doc_num }}</h4>
            </div>
        </div>
        <div class="grid justify-items-center bg-white">
            <form action="{{ route('portal.person.graduate.store',$person) }}" method="POST"
                class="w-full md:w-3/4 h-full pb-12 px-4 pt-4" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div>
                    <h3 class="text-xl tracking-wide uppercase font-semibold">Nuevo Titulo/Grado Obtenido
                    </h3>
                    <hr class="bg-gradient-to-r from-red-300 to-white h-1">
                </div>

                <div class="bg-white shadow-md rounded pt-6 pb-8 mb-4 my-3">
                    <div class="grid grid-cols-4 gap-4 mx-4 pb-4">
                        <div class="md:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="career_id">
                                Carrera Profesional
                            </label>
                            <select
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('career_id') border-red-500 @else border-gray-400 @enderror text-grey-darker py-3 px-4 pr-8 rounded"
                                id="career_id" name="career_id" required>
                                @foreach ($careers as $career)
                                <option value="{{$career->id}}" @if ( $career->id=='DNI' ) selected @endif>
                                    {{ $career->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('career_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-1 col-span-2">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="start_year">
                                Año Inicio
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('start_year') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="start_year" name="start_year" type="number" placeholder="Ejem.: 2015"
                                value="{{ old('start_year') }}" required>
                            @error('start_year')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-1 col-span-2">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="end_year">
                                Año Culminacion
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('end_year') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="end_year" name="end_year" type="number" placeholder="Ejem.: 2020"
                                value="{{ old('end_year') }}" required>
                            @error('end_year')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="title">
                                Titulo
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('title') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="title" name="title" type="text"
                                placeholder="Ejem.: Profesor de Educacion Secundaria" value="{{ old('title') }}"
                                required>
                            @error('title')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="mention">
                                Mención <span class="text-xs text-gray-400">(Opcional)</span>
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('mention') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="mention" name="mention" type="text" placeholder="Ejem.: Ciencias Sociales"
                                value="{{ old('mention') }}">
                            @error('mention')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 col-span-4">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="title_num">
                                Numero <span class="text-xs text-gray-400">(Titulo, Resolucion)</span>
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('title_num') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="title_num" name="title_num" type="text"
                                placeholder="Numero de documento que acredite" value="{{ old('title_num') }}" required>
                            @error('title_num')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-1 col-span-2">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="date_issued">
                                Fecha de expedicion
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('date_issued') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="date_issued" name="date_issued" type="date" placeholder="Fecha de expedicion"
                                value="{{ old('date_issued') }}" required>
                            @error('date_issued')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-1 col-span-2">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="degree_id">
                                Grado obtenido
                            </label>
                            <select
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('degree_id') border-red-500 @else border-gray-400 @enderror text-grey-darker py-3 px-4 pr-8 rounded"
                                id="degree_id" name="degree_id">
                                <option value="" selected disabled>Grado obtenido</option>
                                @foreach ($degrees as $degree)
                                <option value="{{ $degree->id }}" @if ($degree->id == old('degree_id')) selected
                                    @endif>{{ $degree->name }} ( {{ $degree->short }} )
                                </option>
                                @endforeach
                                </option>
                            </select>
                            @error('degree_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @auth
                    @if(Auth::user()->can('graduates.update') || Auth::user()->id==$person->user_id)
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
