<div class="w-full m-auto mb-5 px-2 py-2 text-center border rounded-sm shadow-lg">
    <span class="uppercase font-bold text-red-500">Top Autores</span>
    <div class="text-xs text-gray-600 uppercase py-2">
        @foreach ($authors as $author)
        <a href="{{ route('portal.books.author',$author) }}"
            class="flex items-center hover:text-gray-800 w-full text-left">
            <span class="w-full">{{$author->name}} {{$author->last_name}}</span>
            <span class="float-right">({{$author->count}})</span>
        </a>
        @endforeach
    </div>
</div>
