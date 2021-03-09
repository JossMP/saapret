@extends('portal.layouts.app')
@section('title')
{{ __('Pagina de inicio') }}
@endsection
@section('content')
<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">
    <div class="w-full mx-auto py-6 sm:px-6 lg:px-8">
        <div class="grid grid-cols-4 gap-4">
            <div class="col-span-4 sm:col-span-2 lg:col-span-1">
                <div
                    class="widget w-full p-4 rounded-lg bg-white border border-gray-300 shadow-lg dark:bg-gray-900 dark:border-gray-800">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col">
                            <div class="text-xs uppercase font-light text-gray-500">
                                Usuarios
                            </div>
                            <div class="text-xl font-bold">
                                {{ \App\models\User::count() }}
                            </div>
                        </div>
                        <i class="fa fa-users text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="col-span-4 sm:col-span-2 lg:col-span-1">
                <div
                    class="widget w-full p-4 rounded-lg bg-white border border-gray-300 shadow-lg dark:bg-gray-900 dark:border-gray-800">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col">
                            <div class="text-xs uppercase font-light text-gray-500">
                                Carreras
                            </div>
                            <div class="text-xl font-bold">
                                {{ \App\models\Career::count() }}
                            </div>
                        </div>
                        <i class="fa fa-graduation-cap text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="col-span-4 sm:col-span-2 lg:col-span-1">
                <div
                    class="widget w-full p-4 rounded-lg bg-white border border-gray-300 shadow-lg dark:bg-gray-900 dark:border-gray-800">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col">
                            <div class="text-xs uppercase font-light text-gray-500">
                                Egresados
                            </div>
                            <div class="text-xl font-bold">
                                {{ \App\models\Graduate::count() }}
                            </div>
                        </div>
                        <i class="fa fa-user-graduate text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="col-span-4 sm:col-span-2 lg:col-span-1">
                <div
                    class="widget w-full p-4 rounded-lg bg-white border border-gray-300 shadow-lg dark:bg-gray-900 dark:border-gray-800">
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-col">
                            <div class="text-xs uppercase font-light text-gray-500">
                                Profesionales
                            </div>
                            <div class="text-xl font-bold">
                                {{ \App\models\Person::count() }}
                            </div>
                        </div>
                        <i class="fa fa-users text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- card -->
        <div class="rounded overflow-hidden shadow-lg bg-white mt-4 w-full">
            <div class="px-6 py-2 border-b border-gray-100 bg-gray-300">
                <div class="font-bold text-xl uppercase">Ultimos usuarios registrados</div>
            </div>
            <div class="table-responsive">
                <table class="border-collapse w-full">
                    <thead>
                        <tr>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Nombres y Apellidos
                            </th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                Carrera Profesional
                            </th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">
                                e-mail
                            </th>
                            <th
                                class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($graduates as $graduate)
                        <tr
                            class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    Nombres y Apellidos
                                </span>
                                {{ $graduate->person->name }} {{ $graduate->person->first_last_name }}
                                {{ $graduate->person->second_last_name }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">
                                    Carrera Profesional
                                </span>
                                {{ $graduate->career->name }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">E-mail</span>
                                {{ $graduate->person->email }}
                            </td>
                            <td
                                class="w-full lg:w-auto p-3 text-gray-800 border border-b text-center block lg:table-cell relative lg:static">
                                <span
                                    class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                                <a href="{{ route('portal.person.edit',$graduate->person) }}"
                                    class="text-blue-400 hover:text-blue-600 underline">Editar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="px-3 my-2">
                    {{$graduates->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
        <!-- /card -->
    </div>

    <main class="bg-white-300 flex-1 p-3 overflow-hidden">
        <div class="flex flex-col">
            <!-- Progress Bar -->
            <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 mt-2">
                <div class="rounded overflow-hidden shadow bg-white mx-2 w-full pt-2">
                    <div class="px-6 py-2 border-b border-light-grey">
                        <div class="font-bold text-xl">Progress Among Projects</div>
                    </div>
                    <div class="">
                        <div class="w-full">

                            <div class="shadow w-full bg-grey-light">
                                <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white"
                                    style="width: 45%">45%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-teal-500 text-xs leading-none py-1 text-center text-white"
                                    style="width: 55%">55%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-light mt-2">
                                <div class="bg-orange-500 text-xs leading-none py-1 text-center text-white"
                                    style="width: 65%">65%
                                </div>
                            </div>


                            <div class="shadow w-full bg-grey-300 mt-2">
                                <div class="bg-red-800 text-xs leading-none py-1 text-center text-white"
                                    style="width: 75%">75%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Profile Tabs-->
            <div
                class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 p-1 mt-2 mx-auto lg:mx-2 md:mx-2 justify-between">
                <!--Top user 1-->
                <div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3">
                    <img src="https://i.imgur.com/w1Bdydo.jpg" alt="" class="w-full" />
                    <div class="flex justify-center -mt-8">
                        <img src="https://i.imgur.com/8Km9tLL.jpg" alt=""
                            class="rounded-full border-solid border-white border-2 -mt-3">
                    </div>
                    <div class="text-center px-3 pb-6 pt-2">
                        <h3 class="text-black text-sm bold font-sans">Olivia Dunham</h3>
                        <p class="mt-2 font-sans font-light text-grey-700">Hello, i'm from another the other
                            side!</p>
                    </div>
                    <div class="flex justify-center pb-3 text-grey-dark">
                        <div class="text-center mr-3 border-r pr-3">
                            <h2>34</h2>
                            <span>Photos</span>
                        </div>
                        <div class="text-center">
                            <h2>42</h2>
                            <span>Friends</span>
                        </div>
                    </div>
                </div>
                <!--Top user 2-->
                <div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3">
                    <img src="https://i.imgur.com/w1Bdydo.jpg" alt="" class="w-full" />
                    <div class="flex justify-center -mt-8">
                        <img src="https://i.imgur.com/8Km9tLL.jpg" alt=""
                            class="rounded-full border-solid border-white border-2 -mt-3">
                    </div>
                    <div class="text-center px-3 pb-6 pt-2">
                        <h3 class="text-black text-sm bold font-sans">Olivia Dunham</h3>
                        <p class="mt-2 font-sans font-light text-grey-dark">Hello, i'm from another the other
                            side!</p>
                    </div>
                    <div class="flex justify-center pb-3 text-grey-dark">
                        <div class="text-center mr-3 border-r pr-3">
                            <h2>34</h2>
                            <span>Photos</span>
                        </div>
                        <div class="text-center">
                            <h2>42</h2>
                            <span>Friends</span>
                        </div>
                    </div>
                </div>
                <!--Top user 3-->
                <div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3">
                    <img src="https://i.imgur.com/w1Bdydo.jpg" alt="" class="w-full" />
                    <div class="flex justify-center -mt-8">
                        <img src="https://i.imgur.com/8Km9tLL.jpg" alt=""
                            class="rounded-full border-solid border-white border-2 -mt-3">
                    </div>
                    <div class="text-center px-3 pb-6 pt-2">
                        <h3 class="text-black text-sm bold font-sans">Olivia Dunham</h3>
                        <p class="mt-2 font-sans font-light text-grey-dark">Hello, i'm from another the other
                            side!</p>
                    </div>
                    <div class="flex justify-center pb-3 text-grey-dark">
                        <div class="text-center mr-3 border-r pr-3">
                            <h2>34</h2>
                            <span>Photos</span>
                        </div>
                        <div class="text-center">
                            <h2>42</h2>
                            <span>Friends</span>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Profile Tabs-->
        </div>
    </main>
    <!--/Main-->
</section>
@endsection
