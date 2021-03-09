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
            <form action="{{ route('portal.person.update',$person) }}" method="POST"
                class="w-full md:w-3/4 h-full pb-12 px-4 pt-4" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div>
                    <h3 class="text-xl tracking-wide uppercase font-semibold">Datos Personal</h3>
                    <hr class="bg-gradient-to-r from-red-300 to-white h-1">
                </div>

                <div class="bg-white shadow-md rounded pt-6 pb-8 mb-4 my-3">
                    <div class="grid sm:grid-cols-3 gap-4 mx-4 pb-4">
                        <div class="col-span-3 sm:col-span-1 text-center" x-data={image:'{{ $person->photo }}'}>
                            <div class="flex flex-col justify-center items-center">
                                <img :src="image"
                                    class="h-40 w-40 object-contain bg-white rounded-full border-gray-500 border-4 mb-2"
                                    title="{{ $person->name }} {{ $person->first_last_name }} {{ $person->second_last_name }}">
                            </div>
                            <label for="photo" type="button"
                                class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium">
                                <i class="fa fa-camera fa-fw"></i>
                                Buscar foto
                            </label>
                            @error('photo')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror

                            <input name="photo" id="photo" accept="image/*" class="hidden" type="file" @change="let file = document.getElementById('photo').files[0];
                                var reader = new FileReader();
                                reader.onload = (e) => image = e.target.result;
                                reader.readAsDataURL(file);">
                        </div>
                        <div class="col-span-3 sm:col-span-2 grid md:grid-cols-2 gap-4">
                            <div class="md:col-span-1 col-span-2">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                    for="name">
                                    Nombres
                                </label>
                                <input
                                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                    id="name" name="name" type="text" placeholder="Nombres"
                                    value="{{ old('name',$person->name) }}" required>
                                @error('name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-1 col-span-2">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                    for="last_name">
                                    Apellidos
                                </label>
                                <input
                                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('last_name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                    id="last_name" name="last_name" type="text" placeholder="Apellidos"
                                    value="{{ $person->first_last_name }}" required>
                                @error('last_name')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                    for="address">
                                    Direccion
                                </label>
                                <input
                                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('address') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                    id="address" name="address" type="text" placeholder="Direccion actual"
                                    value="{{$person->address}}">
                                @error('address')
                                <p class="text-red-500 text-xs italic">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    @livewire('select-location',[
                    //'department_id' => $person->district_home->province->department->id,
                    //'province_id' => $person->district_home->province->id,
                    'district_id' => old('location_home',$person->district_home->id),
                    'name' => 'home',
                    ])

                    <div class="w-full mx-4">
                        <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                            Lugar de Nacimientos
                        </div>
                    </div>

                    @livewire('select-location',[
                    //'department_id' => $person->district_birth->province->department->id,
                    //'province_id' => $person->district_birth->province->id,
                    'district_id' => old('location_birth',$person->district_birth->id),
                    'name' => 'birth',
                    ])

                    <div class="grid sm:grid-cols-3 gap-4 mx-4 pb-4">
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="birthday">
                                Fecha Nacimiento
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('birthday') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="birthday" name="birthday" type="date" placeholder="Cumpleaños"
                                value="{{ $person->birthday }}">
                            @error('birthday')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="doc_type">
                                Tipo Documento
                            </label>
                            <select
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('doc_type') border-red-500 @else border-gray-400 @enderror text-grey-darker py-3 px-4 pr-8 rounded"
                                id="doc_type" name="doc_type" required>
                                <option value="DNI" @if ($person->doc_type=='DNI') selected @endif>DNI</option>
                                <option value="CE" @if ($person->doc_type=='CE') selected @endif>CE</option>
                                <option value="Pasaporte" @if ($person->doc_type=='Pasaporte') selected
                                    @endif>Pasaporte
                                </option>
                                <option value="Otros" @if ($person->doc_type=='Otros') selected @endif>Otros
                                </option>
                            </select>
                            @error('doc_type')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="doc_num">
                                Numero Documento
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('doc_num') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="doc_num" name="doc_num" type="text" placeholder="Numero de Documento"
                                value="{{ $person->doc_num }}" required>
                            @error('doc_num')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="w-full mx-4">
                        <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                            Datos de contato
                        </div>
                    </div>
                    <div class="grid sm:grid-cols-2 gap-4 mx-4 pb-4">
                        <div class="col-span-2 sm:col-span-1">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="phone">
                                Telefono
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('phone') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="phone" name="phone" type="text" placeholder="Telefono" value="{{ $person->phone }}">
                            @error('phone')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-span-2 sm:col-span-1">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="email">
                                E-mail
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('email') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="email" name="email" type="email" placeholder="Correo electronico"
                                value="{{ $person->email }}" required>
                            @error('email')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    @auth
                    @if(Auth::user()->can('people.update') || Auth::user()->id==$person->user_id)
                    <div class="mx-4 pb-4">
                        <div class="w-full text-right">
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
