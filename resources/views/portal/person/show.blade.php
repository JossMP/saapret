@extends('portal.layouts.app')

@section('title')
{{ $person->name }} {{ $person->last_name }}
@endsection

@section('content')
<section class="w-full px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64">
    <div class="w-full relative mt-1 shadow-2xl rounded overflow-hidden">
        <div class="top h-64 w-full bg-red-200 overflow-hidden relative">
            @if(Auth::check() && (Auth::user()->can('people.create') ||
            Auth::user()->id==$person->user_id))
            <a href="{{ route('portal.person.edit', $person) }}"
                class="absolute bottom-0 right-0 text-xs text-blue-500 z-10 bg-gray-300 hover:bg-gray-400 font-bold py-1 px-2 m-2 rounded inline-flex items-center">
                <i class="fa fa-fw fa-edit mr-1"></i>
                <span>Editar</span>
            </a>
            @endif
            <img src="{{ asset('images/fondo-001.jpg') }}" alt=""
                class="w-full h-full object-cover object-center absolute z-0">
            <div class="flex flex-col justify-center items-center relative h-full bg-black bg-opacity-50 text-white">
                <div class="h-40 w-40 relative">
                    <img src="{{ $person->photo }}"
                        class="h-40 w-40 object-contain bg-white rounded-full border-white border-2"
                        title="{{ $person->name }} {{ $person->last_name }}">
                </div>
                <h1 class="text-2xl font-semibold">
                    {{ $person->name }} {{ $person->last_name }}
                </h1>
                <h4 class="text-sm font-semibold">{{ $person->doc_type }} {{ $person->doc_num }}</h4>
            </div>
        </div>
        <div class="grid justify-items-center bg-white" x-data={p1:true,p2:false,p3:false}>
            <div class="w-3/4 h-full pb-12">
                <!-- Grados y Titulos -->
                <div class="px-4 pt-4">
                    <div class="flex items-center">
                        <i class="text-red-800 fa fa-fw fa-graduation-cap"></i>
                        <h3 class="w-full text-xl tracking-wide uppercase font-semibold ml-2">
                            Titulo/Grado Obtenido
                        </h3>
                        @if(Auth::check() && (Auth::user()->can('graduates.create') ||
                        Auth::user()->id==$person->user_id))
                        <a href="{{ route('portal.person.graduate.create',$person) }}"
                            class="float-right text-xs text-blue-900 z-10 bg-blue-300 hover:bg-blue-400 font-bold py-1 px-2 rounded inline-flex items-center">
                            <i class="fa fa-fw fa-plus mr-1"></i>
                            <span>Añadir</span>
                        </a>
                        @endif
                    </div>
                    <hr class="bg-gradient-to-r from-red-300 to-white h-1">

                    @foreach ($person->graduates as $graduate)
                    <div class="bg-white shadow-md rounded pt-2 pb-8 mb-4 my-4">
                        <h3 class="flex font-bold uppercase pb-2 mx-8 items-center">
                            <i class="text-gray-600 fa fa-fw {{ $graduate->career->icon }}"></i>
                            <span class="w-full ml-4 md:ml-2">{{ $graduate->title }}</span>
                            @if(Auth::check() && (Auth::user()->can('graduates.delete') ||
                            Auth::user()->id==$person->user_id))
                            <form action="{{ route('portal.graduate.destroy',$graduate) }}" method="POST" x-data
                                x-ref="grad{{$graduate->id}}">
                                @csrf
                                @method('delete')
                                <button
                                    x-on:click.prevent="if (confirm('Seguro que desea borrarlo?')) $refs.grad{{$graduate->id}}.submit()"
                                    type="submit"
                                    class="float-right text-red-900 z-10 focus:outline-none hover:text-red-400 font-bold rounded inline-flex items-center">
                                    <i class="fa fa-fw fa-trash mr-1"></i>
                                </button>
                            </form>
                            @endif
                        </h3>
                        <div class="grid sm:grid-cols-3 gap-4 mx-8 pb-4">
                            <div class="col-span-2">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Carrera Profesional
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $graduate->career->name }}
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Num. Titulo
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $graduate->title_num }}
                                </div>
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-3 gap-4 mx-8 pb-4">
                            <div class="col-span-3 md:col-span-1">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Año de ingreso
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $graduate->start_year }}
                                </div>
                            </div>

                            <div class="col-span-3 md:col-span-1">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Año de Egreso
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $graduate->end_year }}
                                </div>
                            </div>

                            <div class="col-span-3 md:col-span-1">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Expedición de título
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $graduate->date_issued }}
                                </div>
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-3 gap-4 mx-8 pb-4">
                            <div class="md:col-span-1 col-span-3">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Grado obtenido
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    @if ($graduate->degree)
                                    {{ $graduate->degree->name }}
                                    @else
                                    -
                                    @endif
                                </div>
                            </div>

                            <div class="md:col-span-2 col-span-3">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Mención
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $graduate->mention }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Experiencia Laboral -->
                <div class="px-4 pt-4">
                    <div class="flex items-center">
                        <i class="text-red-800 fa fa-fw fa-user-tie"></i>
                        <h3 class="w-full text-xl tracking-wide uppercase font-semibold ml-2">Experiencia Laboral</h3>
                        @if(Auth::check() && (Auth::user()->can('experiences.create') ||
                        Auth::user()->id==$person->user_id))
                        <a href="{{ route('portal.person.experience.create',$person) }}"
                            class="float-right text-xs text-blue-900 z-10 bg-blue-300 hover:bg-blue-400 font-bold py-1 px-2 rounded inline-flex items-center">
                            <i class="fa fa-fw fa-plus mr-1"></i>
                            <span>Añadir</span>
                        </a>
                        @endif
                    </div>
                    <hr class="bg-gradient-to-r from-red-300 to-white h-1">

                    @foreach ($person->experiences as $experience)
                    <div class="bg-white shadow-md rounded pt-2 pb-8 mb-4 my-4">
                        <h3 class="flex font-bold uppercase pb-2 mx-8 items-center">
                            <span class="w-full">{{ $experience->institution }}</span>

                            @if(Auth::check() && (Auth::user()->can('experiences.delete') ||
                            Auth::user()->id==$person->user_id))
                            <form action="{{ route('portal.experience.destroy',$experience) }}" method="POST" x-data
                                x-ref="exp{{$experience->id}}">
                                @csrf
                                @method('delete')
                                <button
                                    x-on:click.prevent="if (confirm('Seguro que desea borrarlo?')) $refs.exp{{$experience->id}}.submit()"
                                    type="submit"
                                    class="float-right text-red-900 z-10 focus:outline-none hover:text-red-400 font-bold rounded inline-flex items-center">
                                    <i class="fa fa-fw fa-trash mr-1"></i>
                                </button>
                            </form>
                            @endif
                        </h3>
                        <div class="grid sm:grid-cols-5 gap-4 mx-8 pb-4">
                            <div class="col-span-5 md:col-span-3">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Cargo
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $experience->position }}
                                </div>
                            </div>
                            <div class="col-span-5 md:col-span-1">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Desde
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $experience->start_date }}
                                </div>
                            </div>

                            <div class="col-span-5 md:col-span-1">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Hasta
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $experience->end_date }}
                                </div>
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-3 gap-4 mx-8 pb-4">
                            <div class="col-span-3">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Tarea Desarrollada
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $experience->task }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Certificados y cursos -->
                <div class="px-4 pt-4">
                    <div class="flex items-center">
                        <i class="text-red-800 fa fa-fw fa-chalkboard-teacher"></i>
                        <h3 class="w-full text-xl tracking-wide uppercase font-semibold ml-2">Certificados y Cursos</h3>
                        @if(Auth::check() && (Auth::user()->can('certificates.create') ||
                        Auth::user()->id==$person->user_id))
                        <a href="{{ route('portal.person.certificate.create', $person) }}"
                            class="float-right text-xs text-blue-900 z-10 bg-blue-300 hover:bg-blue-400 font-bold py-1 px-2 rounded inline-flex items-center">
                            <i class="fa fa-fw fa-plus mr-1"></i>
                            <span>Añadir</span>
                        </a>
                        @endif
                    </div>
                    <hr class="bg-gradient-to-r from-red-300 to-white h-1">

                    @foreach ($person->certificates as $certificate)
                    <div class="bg-white shadow-md rounded pt-2 pb-8 mb-4 my-4">
                        <h3 class="flex font-bold uppercase pb-2 mx-8 items-center">
                            <span class="w-full">{{ $certificate->mention }}</span>

                            @if(Auth::check() && (Auth::user()->can('certificates.delete') ||
                            Auth::user()->id==$person->user_id))
                            <form action="{{ route('portal.certificate.destroy', $certificate) }}" method="POST" x-data
                                x-ref="cert{{$certificate->id}}">
                                @csrf
                                @method('delete')
                                <button
                                    x-on:click.prevent="if (confirm('Seguro que desea borrarlo?')) $refs.cert{{$certificate->id}}.submit()"
                                    type="submit"
                                    class="float-right text-red-900 z-10 focus:outline-none hover:text-red-400 font-bold rounded inline-flex items-center">
                                    <i class="fa fa-fw fa-trash mr-1"></i>
                                </button>
                            </form>
                            @endif
                        </h3>
                        <div class="grid sm:grid-cols-5 gap-4 mx-8 pb-4">
                            <div class="col-span-5 md:col-span-3">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Organizador
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $certificate->organizer }}
                                </div>
                            </div>

                            <div class="col-span-5 md:col-span-2">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Lugar Evento
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $certificate->place }}
                                </div>
                            </div>
                        </div>
                        <div class="grid sm:grid-cols-5 gap-4 mx-8 pb-4">
                            <div class="col-span-5 md:col-span-3">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Fecha Evento
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $certificate->start_date }}
                                    @if ($certificate->end_date!=null)
                                    al {{ $certificate->end_date }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-5 md:col-span-2">
                                <div class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2">
                                    Horas academicas
                                </div>
                                <div
                                    class="focus:outline-none appearance-none block w-full bg-grey-lighter text-grey-darker">
                                    {{ $certificate->hours }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
