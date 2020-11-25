<!-- start footer -->
<footer
    class="relative bg-indigo-100 mt-5 px-4 sm:px-8 lg:px-16 xl:px-40 2xl:px-64 pt-12 pb-10 text-center sm:text-left">
    <div class="flex flex-col sm:flex-row sm:flex-wrap">
        <div class="sm:w-1/2 md:w-1/3">
            <h6 class="text-sm text-gray-600 font-bold uppercase">Politicas</h6>
            <ul class="mt-4">
                <li>
                    <a href="{{ route('portal.terms') }}">Terminos de Uso</a>
                </li>
                <li class="mt-2">
                    <a href="{{ route('portal.policy') }}">Politicas de Privacidad</a>
                </li>
            </ul>
        </div>
        <div class="sm:w-1/2 md:w-1/3">
            <h6 class="text-sm text-gray-600 font-bold uppercase">Contact</h6>
            <ul class="mt-4">
                <li><a href="#">webmaster@dominio.com</a></li>
                <li class="mt-2"><a href="#">(+51) 971 718 714</a></li>
            </ul>
        </div>
    </div>

    <hr class="mt-2">
    <div class="flex justify-between mt-3 sm:text-center">
        <div class="text-gray-700 text-center w-full sm:w-auto">
            <p class="text-sm text-gray-600">2020 ©JossMP. All rights reserved.</p>
        </div>

        <div class="text-gray-700 hidden sm:block">
            <div class="sm:block w-full">
                <div class="flex justify-center">
                    <a class="flex text-sm font-bold inline-block whitespace-no-wrap uppercase"
                        href="{{ route('portal.home') }}">
                        <img src="{{asset('/images/logo.png')}}" class="h-10" />
                        <span class="pl-2 text-left">
                            <span class="block">Seguimiento</span> egresados
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
