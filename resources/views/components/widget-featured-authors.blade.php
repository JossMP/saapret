<div class="min-w-full divide-y divide-gray-200">
    <div class="px-6 py-3 bg-red-500 tracking-wider">
        <h2 class="text-center text-sm leading-4 font-bold text-gray-100 uppercase">Autores Populares</h2>
        <h2 class="text-center text-xs leading-4 font-bold text-gray-300 uppercase">
            @if ($type=='download')
            (Descargas)
            @endif
            @if ($type=='view')
            (Visualizaciones)
            @endif
            @if ($type=='count')
            (Publicaciones)
            @endif
        </h2>
    </div>
    <div class="divide-y divide-gray-200">
        @foreach ($authors as $author)
        <a href="{{ route('portal.books.author', $author) }}" class="hover:bg-gray-300 flex items-center px-2 py-1"
            title="{{$author->name}} {{$author->last_name}}">
            <div class="flex-shrink-0 h-10 w-10">
                <img class="h-10 w-10 rounded-full"
                    src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&length=2&bold=true&name={{$author->name}}+{{$author->last_name}}"
                    alt="{{$author->name}} {{$author->last_name}}">
            </div>
            <div class="w-5/6 ml-2">
                <div class="text-sm font-bold text-gray-700 uppercase truncate">
                    {{$author->name}} {{$author->last_name}}
                </div>
                <div class="text-xs">
                    <div class="flex gap-1 font-semibold">

                        <div class="flex items-center px-1 mt-1 text-purple-600 bg-purple-400 rounded-lg">
                            <i class="fa fa-book fa-fw"></i>
                            <time class="text-gray-200 pl-1">{{$author->count}}</time>
                        </div>
                        <div class="flex items-center px-1 mt-1 text-green-600 bg-green-400 rounded-lg">
                            <i class="fa fa-download fa-fw"></i>
                            <time class="text-gray-200 pl-1">{{$author->download}}</time>
                        </div>
                        <div class="flex items-center px-1 mt-1 text-blue-600 bg-blue-400 rounded-lg">
                            <i class="fa fa-eye fa-fw"></i>
                            <time class="text-gray-200 pl-1">{{$author->view}}</time>
                        </div>

                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</div>
