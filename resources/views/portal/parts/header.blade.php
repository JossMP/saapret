<div class="pb-20" x-data="{showNav:false}" @click.away="showNav=false">
    <!-- start header -->
    <header class="fixed z-20 bg-white w-full shadow-md">
        <nav class="mx-auto lg:px-32 sm:flex sm:justify-between">
            <div class="relative">
                <a href="{{ route('portal.home') }}" class="flex items-center p-6">
                    <img src="{{ asset('/images/logo.png') }}" class="h-10">
                    <span class="font-bold uppercase">Seguimiento Egresados</span>
                </a>
                <span class="absolute right-4 top-6 cursor-pointer sm:hidden" @click="showNav=!showNav">
                    <svg class="fill-current h-6 w-6 text-gray-400 hover:text-gray-500" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                    </svg>
                </span>
            </div>
            <div class="border sm:border-none sm:block hidden" :class="{'hidden':!showNav}">
                <ul class="transition duration-500 font-medium sm:flex sm:items-center" x-data="{showSubMenu1:false,showSubMenu2:false}">
                    
                    <li>
                        <a href="{{ route('portal.graduate.index') }}" 
                            class="flex px-6 py-3 sm:py-8 hover:text-indigo-700 cursor-pointer block">
                            <span>Lista de egresados</span>
                        </a>
                    </li>

                    <li @click.away="showSubMenu1=false">
                        <a class="px-6 py-3 sm:py-8 hover:text-indigo-700 sm:hover-none cursor-pointer block" @click="showSubMenu1=!showSubMenu1"><span>Carreras profesionales</span><span class="icon-down-open-1"></span></a>
                        <ul class="bg-gray-100 text-gray-500 sm:absolute"  x-show.transition.in.duration.100ms.out.duration.75ms="showSubMenu1" style="display:none;">
                            @foreach (\App\Models\Career::limit(10)->get() as $career)
                                <li>
                                    <a href="{{ route('portal.graduate.career', $career) }}" 
                                        class="px-8 py-3 hover:bg-gray-200 hover:text-indigo-700 cursor-pointer block">
                                        {{ $career->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @auth
                    <li @click.away="showSubMenu2=false">
                        <a class="flex px-6 py-3 sm:py-8 hover:text-indigo-700 cursor-pointer block" @click="showSubMenu2=!showSubMenu2">
                            <span class="pr-2">
                                <div class="rounded-full">
                                    <img class="h-6 w-6 rounded-full" 
                                        src="{{ asset('images/photos/'.Auth::user()->avatar) }}" 
                                        alt="{{ Auth::user()->username }}">
                                </div>
                            </span>
                            <span>{{ Auth::user()->username }}</span>
                            <span class="icon-down-open-1"></span>
                        </a>
                        <ul class="bg-gray-100 text-gray-500 sm:absolute" x-show.transition.in.duration.100ms.out.duration.75ms="showSubMenu2" style="display:none;">
                            @role('super-admin')
                            <li>
                                <a href="{{ route('portal.faq') }}" class="px-8 py-3 hover:bg-gray-200 hover:text-indigo-700 cursor-pointer block">
                                    Registrar nuevo
                                </a>
                            </li>
                            @endrole
                            <li>
                                <a class="px-8 py-3 hover:bg-gray-200 hover:text-indigo-700 cursor-pointer block">Perfil</a>
                            </li>
                            <li>
                                <a class="px-8 py-3 hover:bg-gray-200 hover:text-indigo-700 cursor-pointer block">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="font-medium">Cerrar Sesión</button>                                        
                                    </form>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('panel.index') }}"
                            class="bg-blue-600 hover:bg-opacity-75 transition-colors duration-200 text-blue-50 text-xs font-semibold rounded-full px-4 py-2 ml-6 my-2 sm:m-0 inline-block cursor-pointer uppercase">
                            Iniciar sesión
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>
    <!-- end header -->
</div>