<div x-data="{scrollTop:true,toggle:false, open:false}">
    <!-- start header -->
    <header class="w-full bg-transparent fixed top-0 left-0 z-50 px-4 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4"
        id="navbar" :class="{'bg-white shadow-lg text-black':!scrollTop,'text-white':scrollTop}"
        @scroll.window="scrollTop = ( window.pageYOffset > 1||toggle==true ) ? false:true">
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
                :class="{ 'hidden':!toggle,'bg-white text-black':toggle }" @click.away="toggle = false">
                <ul class="flex flex-col md:flex-row list-none md:ml-auto h-full font-bold">
                    <li class="h-full px-2">
                        <a href="#list-books"
                            class="px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:border-red-700 border-b uppercase">
                            <span>Recientes</span>
                        </a>
                    </li>
                    <li class="h-full px-2">
                        <div class="dropdown relative" @click.away="open = false">
                            <a href="#" @click.prevent="open=!open"
                                class="px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:border-red-700 border-b uppercase">
                                <span>Profesiones</span>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </a>
                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="dropdown-menu origin-top-left absolute left-0 pt-0 rounded-md shadow-lg"
                                style="display: none;">
                                <div class="absolute -ml-2 transform px-2 w-100 max-w-md sm:px-0 lg:ml-0 md:left-1/2">
                                    <div class="rounded-lg shadow-lg">
                                        <div class="rounded-lg shadow-xs overflow-hidden">
                                            <div class="z-20 relative grid bg-white px-0 py-2">
                                                @foreach (\App\Models\Profession::limit(10)->get() as $profession)
                                                <a href="{{ route('portal.books.publication_type', $profession) }}"
                                                    class="px-2 m-0 py-2 flex items-center hover:bg-gray-500 transition ease-in-out duration-150">
                                                    <i class="fa fa-graduation-cap text-red-500"></i>
                                                    <div class="pl-2">
                                                        <p
                                                            class="block font-semibold text-xs uppercase truncate text-gray-900">
                                                            {{ $profession->name }}
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
                    <li class="h-full px-2">
                        <a href="{{route('panel.index')}}"
                            class="mt-4 md:mt-auto px-3 py-2 text-xs flex items-center h-full hover:opacity-75 bg-blue-600 text-white rounded-lg hover:bg-blue-800 uppercase">
                            Intranet
                        </a>
                    </li>
                </ul>
                {{--
             <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                 <li class="nav-item">
                     <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug hover:opacity-75"
                         href="#pablo">
                         <i class="fab fa-facebook-square text-lg leading-lg opacity-75"></i><span
                         class="ml-2">Share</span>
                        </a>
                    </li>
                 <li class="nav-item">
                     <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug hover:opacity-75"
                         href="#pablo">
                         <i class="fab fa-twitter text-lg leading-lg opacity-75"></i><span
                         class="ml-2">Tweet</span>
                     </a>
                    </li>
                    <li class="nav-item">
                        <a class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug hover:opacity-75"
                        href="#pablo">
                         <i class="fab fa-pinterest text-lg leading-lg opacity-75"></i><span
                         class="ml-2">Pin</span>
                     </a>
                    </li>
                    <li class="nav-item">
                     <a href="#"
                     class="px-3 py-2 flex items-center text-xs uppercase font-bold leading-snug hover:opacity-75 bg-blue-600 text-white rounded-lg ml-4 hover:bg-blue-800 ">
                         Intranet
                        </a>
                 </li>
                </ul> --}}
            </div>
        </nav>
    </header>
    <!-- end header -->
</div>
