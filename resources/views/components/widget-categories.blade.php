<div class="w-full m-auto mb-5 px-2 py-2 text-center border rounded-sm shadow-lg">
    <span class=" uppercase font-bold text-red-500">Categorias</span>
    <div class="text-xs text-gray-600 uppercase py-2">
        @foreach ($categories as $category)
        <a href="{{ route('portal.books.category', $category) }}" class="hover:text-gray-800 block w-full text-left">
            <span class="w-full">{{$category->name}}</span>
            <span class="float-right">({{$category->count}})</span>
        </a>
        @endforeach
    </div>
</div>
