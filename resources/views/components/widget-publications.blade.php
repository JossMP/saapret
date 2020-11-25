<div class="w-full m-auto mb-5 px-2 py-2 text-center border rounded-sm shadow-lg">
    <span class=" uppercase font-bold text-red-500">Publicaciones</span>
    <div class="text-xs text-gray-600 uppercase py-2">
        @foreach ($publications as $publication)
        <a href="{{ route('portal.books.publication_type',$publication) }}"
            class="hover:text-gray-800 block w-full text-left">
            <span class="w-full">{{$publication->name}}</span>
            <span class="float-right">({{$publication->count}})</span>
        </a>
        @endforeach
    </div>
</div>
