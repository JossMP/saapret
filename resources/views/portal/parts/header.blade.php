<div x-data="{toggle:false, open:false}">
    <!-- start header -->
    <header
        class="w-full bg-white shadow-lg text-black fixed top-0 left-0 z-50 px-4 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4"
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
                        <a href="{{ route('portal.policy') }}"
                            class="px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:border-red-700 border-b uppercase">
                            <span>Politicas de privacidad</span>
                        </a>
                    </li>
                    <li class="h-full px-2">
                        <a href="{{ route('portal.faq') }}"
                            class="px-3 py-2 text-xs flex items-center h-full hover:text-blue-600 hover:border-red-700 border-b uppercase">
                            <span>Preguntas frecuentes</span>
                        </a>
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
            </div>
        </nav>
    </header>
    <!-- end header -->
</div>
