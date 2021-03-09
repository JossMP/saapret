@extends('portal.layouts.app')


@section('title')
Busqueda de profesionales
@endsection

@section('content')

@include('portal.parts.slide')

<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">
    <h1 class="text-center font-bold text-4xl md:text-5xl text-red-500 leading-tight">
        ¿Egresado o Titulado?
    </h1>
    <p class="text-center text-gray-800 text-base leading-relaxed mt-4 font-semibold">
        Complete sus datos y regístrate en el sistema de Seguimiento de egresados.
    </p>
    <div class="grid justify-items-center bg-white">
        <form action="{{ route('portal.person.store') }}" method="POST" class="w-full md:w-5/6 h-full pb-12 px-4 pt-4"
            enctype="multipart/form-data">
            @csrf

            <div>
                <h3 class="text-xl tracking-wide uppercase font-semibold">Datos Personal</h3>
                <hr class="bg-gradient-to-r from-red-300 to-white h-1">
            </div>

            <div class="bg-white shadow-md rounded pt-6 pb-8 mb-4 my-3" x-data="SearchPerson()">
                <div class="grid sm:grid-cols-4 gap-4 mx-4 pb-4">
                    <div class="col-span-4 lg:col-span-1 text-center"
                        x-data={image:'{{ asset('images/photos/default.png') }}'}>
                        <div class="flex flex-col justify-center items-center">
                            <img :src="image"
                                class="h-40 w-40 object-contain bg-white rounded-full border-gray-500 border-4 mb-2"
                                title="Foto perfil">
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
                    <div class="col-span-4 lg:col-span-3 grid md:grid-cols-6 gap-4">
                        <div class="md:col-span-2 sm:col-span-3 col-span-6">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="doc_type">
                                Tipo Documento
                            </label>
                            <select
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('doc_type') border-red-500 @else border-gray-400 @enderror  text-grey-darker py-3 px-4 pr-8 rounded uppercase"
                                name="doc_type" id="doc_type" required>
                                <option value="DNI" @if (old('doc_type')=='DNI' ) selected @endif>DNI</option>
                                <option value="CE" @if (old('doc_type')=='CE' ) selected @endif>CE</option>
                                <option value="Pasaporte" @if (old('doc_type')=='Pasaporte' ) selected @endif>
                                    Pasaporte
                                </option>
                                <option value="Otros" @if (old('doc_type')=='Otros' ) selected @endif>Otros
                                </option>
                            </select>
                            @error('doc_type')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 sm:col-span-3 col-span-6">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="doc_num">
                                Nro. Documento <span :class="[isSuccess?'text-green-300':'text-red-300']"
                                    class="text-xs lowercase" x-text='message'></span>
                            </label>
                            <div class="flex">
                                <input
                                    class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-r-0 @error('doc_num') border-red-500 @else border-gray-400 @enderror rounded rounded-r-none py-3 px-4"
                                    id="doc_num" name="doc_num" type="text" placeholder="Numero Documento"
                                    value="{{ old('doc_num') }}" required x-model='doc_num'>
                                <button type="button" @click="fetchPerson()"
                                    class="w-14 focus:outline-none appearance-none block bg-grey-lighter text-grey-darker rounded rounded-l-none border border-l-0 @error('doc_num') border-red-500 @else border-gray-400 @enderror py-3 px-2">
                                    <i class="fa fa-search text-xl"
                                        :class="[ isLoading ? 'fas fa-spinner fa-pulse' : 'fa fa-search text-xl' ]"></i>
                                </button>
                            </div>
                            @error('doc_num')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2 sm:col-span-3 col-span-6">
                        </div>

                        <div class="md:col-span-2 col-span-6">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="name">
                                Nombres
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="name" name="name" type="text" placeholder="Nombres" value="{{ old('name') }}"
                                x-model="person.name" required>
                            @error('name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 sm:col-span-3 col-span-6">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="first_last_name">
                                Ap. Paterno
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('first_last_name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="first_last_name" x-model="person.first_last_name" name="first_last_name" type="text"
                                placeholder="Ap. Paterno" value="{{ old('first_last_name') }}" required>
                            @error('first_last_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2 sm:col-span-3 col-span-6">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="second_last_name">
                                Ap. Materno
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('second_last_name') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="second_last_name" x-model="person.second_last_name" name="second_last_name"
                                type="text" placeholder="Ap. Materno" value="{{ old('second_last_name') }}" required>
                            @error('second_last_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 col-span-6">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="birthday">
                                Fecha Nacimiento
                            </label>
                            <input
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('birthday') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                                id="birthday" name="birthday" type="date" placeholder="Cumpleaños"
                                value="{{ old('birthday') }}" required>
                            @error('birthday')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 col-span-6">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="gender">
                                Sexo
                            </label>
                            <select
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('gender') border-red-500 @else border-gray-400 @enderror  text-grey-darker py-3 px-4 pr-8 rounded uppercase"
                                id="gender" name="gender" required>
                                <option value="Masculino">Masculino</option>
                                <option value="Femenino">Femenino</option>
                            </select>
                            @error('gender')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="sm:col-span-2 col-span-6">
                            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                                for="marital_status">
                                Estado civil
                            </label>
                            <select
                                class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('marital_status') border-red-500 @else border-gray-400 @enderror  text-grey-darker py-3 px-4 pr-8 rounded uppercase"
                                id="marital_status" name="marital_status" required>
                                <option value="Soltero(a)">Soltero(a)</option>
                                <option value="Casado(a)">Casado(a)</option>
                            </select>
                            @error('marital_status')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="w-full mx-4">
                    <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Ubicacion Direccion
                    </div>
                </div>
                @livewire('select-location',[
                'district_id' => old('location_home'),
                'name' => 'home',
                ])
                <div class="grid sm:grid-cols-3 gap-4 mx-4 pb-4">
                    <div class="col-span-6">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="address">
                            Direccion
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('address') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                            id="address" x-model="person.address" name="address" type="text"
                            placeholder="Direccion actual" value="{{ old('address') }}">
                        @error('address')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="w-full mx-4">
                    <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Ubicacion de Nacimientos
                    </div>
                </div>

                @livewire('select-location',[
                'district_id' => old('location_birth'),
                'name' => 'birth',
                ])

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
                            id="phone" name="phone" type="text" placeholder="Telefono" value="{{ old('phone') }}">
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
                            value="{{ old('email') }}" required>
                        @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="w-full mx-4">
                    <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                        Datos de acceso
                    </div>
                </div>
                <div class="grid sm:grid-cols-6 gap-4 mx-4 pb-4">
                    <div class="col-span-6 sm:col-span-2">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="username">
                            Usuario
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('username') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                            id="username" name="username" type="text" placeholder="Usuario"
                            value="{{ old('username') }}">
                        @error('username')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="password">
                            Contraseña
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('password') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                            id="password" name="password" type="password" placeholder="Contraseña"
                            value="{{ old('password') }}" required>
                        @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
                            for="password_confirmation">
                            Repite Contraseña
                        </label>
                        <input
                            class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('password_confirmation') border-red-500 @else border-gray-400 @enderror rounded py-3 px-4"
                            id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="Contraseña" value="{{ old('password_confirmation') }}" required>
                        @error('password_confirmation')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="mx-4 pb-4">
                    <div class="w-full text-right">
                        <button type="submit"
                            class="border border-green-500 bg-green-500 text-white rounded-md px-4 py-2 m-1 transition duration-500 ease select-none hover:bg-green-600 focus:outline-none focus:shadow-outline uppercase">
                            <i class="fa fa-save"></i>
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
