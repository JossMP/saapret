<div class="text-center" x-data="{'all':false}">
    <h1 class="font-bold text-3xl md:text-4xl text-red-500 mb-6 pt-8 uppercase">
        {{ $title }}
    </h1>
    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-3">

        @foreach ($careers as $career)
        <a href="{{ route('portal.graduates.career', $career) }}"
            class="w-full mx-auto rounded-lg hover:bg-gray-50 bg-white shadow-lg px-5 pt-5 pb-6 mt-16 text-blue-500"
            style="max-width: 500px" @if($loop->iteration>3) :class="{hidden:!all}" @endif>
            <div class="w-full pt-1 pb-5">
                <div class="bg-blue-100 overflow-hidden rounded-full w-20 h-20 -mt-16 mx-auto shadow-lg text-center">
                    <i class="pt-4 text-5xl {{ $career->icon }} fa-fw"></i>
                </div>
            </div>

            <div class="w-full">
                <p class="text-md text-indigo-500 font-bold text-center">{{ $career->name }}</p>
                <p class="text-xs text-gray-500 text-center">{{ $career->graduates()->count() }} Registros</p>
            </div>
        </a>
        @endforeach

    </div>
    <div class="border-t-4 border-red-300 w-full" :class="{hidden:all}">
        <div class="bg-red-300 rounded-full w-10 h-10 -mt-6 mx-auto text-center cursor-pointer" @click="all=true">
            <i class="fa fa-chevron-down fa-fw text-2xl pt-3"></i>
        </div>
    </div>
</div>
