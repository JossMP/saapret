<div x-data="{toggle:false, open:false}" class="pb-20 z-10">
    <!-- start header -->
    <header
        class="w-full bg-white shadow-lg text-black fixed top-0 left-0 z-20 px-4 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4"
        id="navbar">
        <nav class=" mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between md:w-auto  px-4 md:static md:block md:justify-start">
                <a class="flex text-sm font-bold leading-relaxed mr-4 py-2 whitespace-no-wrap uppercase"
                    href="{{ route('portal.home') }}">
                    <img src="{{asset('/images/logo.png')}}" class="h-10" />
                    <span class="pl-2">
                        <span class="block">Seguimiento</span> egresados
                    </span>
                </a>
                <button
                    class="text-blue-400 opacity-75 cursor-pointer text-xlg leading-none border border-solid border-transparent rounded bg-transparent block md:hidden outline-none focus:outline-none"
                    @click="toggle = !toggle, scrollTop=false" type="button" id="btn-toggler">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                    </svg>
                </button>
            </div>

            <div class="navbar-toggler md:flex flex-grow items-center hidden"
                :class="{ 'hidden':!toggle,'bg-white text-black':toggle }">
                <ul class="flex flex-col md:flex-row list-none md:ml-auto h-full font-bold">
                    <li class="h-full px-2">
                        <a href="{{ route('portal.graduate.index') }}"
                            class="px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:border-red-700 border-b uppercase">
                            <span>Lista Egresados</span>
                        </a>
                    </li>
                    <li class="h-full px-2">
                        <div class="relative" x-data="{ career: false }" @click.away="career = false">
                            <button @click="career = !career"
                                class="font-bold focus:outline-none px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:border-red-700 border-b uppercase">
                                <span>Carreras Profesionales</span>
                            </button>
                            <div x-show="career" class="origin-top-left absolute left-0 pt-0 rounded-md shadow-lg"
                                style="display: none;">
                                <div class="absolute -ml-2 transform px-2 w-100 max-w-md sm:px-0 lg:ml-0 md:left-1/2">
                                    <div class="rounded-lg shadow-lg">
                                        <div class="rounded-lg shadow-xs overflow-hidden">
                                            <div class="z-20 relative grid bg-white px-0 py-2">
                                                @foreach (\App\Models\Career::limit(10)->get() as $career)
                                                <a href="{{ route('portal.graduate.career', $career) }}"
                                                    class="px-2 m-0 py-2 flex items-center hover:bg-gray-500 transition ease-in-out duration-150">
                                                    <i class="fa fa-graduation-cap text-red-500"></i>
                                                    <div class="pl-2">
                                                        <p
                                                            class="block font-semibold text-xs uppercase truncate text-gray-900">
                                                            {{ $career->name }}
                                                        </p>
                                                    </div>
                                                </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="h-full px-2">
                        <a href="{{ route('portal.contact.index') }}"
                            class="px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:border-red-700 border-b uppercase">
                            <span>Contactenos</span>
                        </a>
                    </li>
                    @auth
                    <li class="h-full px-2">
                        <div @click.away="userMenu = false" class="ml-3 relative" x-data="{ userMenu: false }">
                            <div>
                                <button @click="userMenu = !userMenu" x-bind:aria-expanded="userMenu"
                                    class="flex text-sm focus:outline-none items-center">

                                    <div class="bg-gray-800 flex text-sm rounded-full">
                                        <img class="h-8 w-8 rounded-full"
                                            src="{{ asset('images/photos/'.Auth::user()->avatar) }}"
                                            alt="{{ Auth::user()->username }}">
                                    </div>
                                    <span class="block uppercase font-semibold pl-2">{{ Auth::user()->username }}</span>
                                </button>
                            </div>
                            <div x-show="userMenu"
                                x-description="Profile dropdown panel, show/hide based on dropdown state."
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu"
                                style="display: none;">
                                @role('super-admin')
                                <a href="{{ route('portal.faq') }}"
                                    class="px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:bg-gray-100 uppercase">
                                    <span>Registar Nuevo</span>
                                </a>
                                @endrole
                                <a href="#"
                                    class="px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:bg-gray-100 uppercase">
                                    <span>Perfil</span>
                                </a>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="w-full focus:outline-none border-red-300 border-t-2 block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 uppercase font-bold">
                                        Cerrar Sesion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </li>
                    @else
                    <li class="h-full px-2">
                        <a href="{{route('panel.index')}}"
                            class="mt-4 md:mt-auto px-3 py-2 text-xs flex items-center h-full hover:opacity-75 bg-blue-600 text-white rounded-lg hover:bg-blue-800 uppercase">
                            Iniciar Sesion
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>
    <!-- end header -->
</div>
