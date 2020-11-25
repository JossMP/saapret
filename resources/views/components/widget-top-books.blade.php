<div class="w-full m-auto mb-5 px-2 py-2 text-center border rounded-sm shadow-lg">
    <a href="{{ route('portal.books.show',$most_view) }}">
        <span class=" uppercase font-bold text-red-500">Mas Visto</span>
        <div class="relative w-full  shadow rounded overflow-hidden mt-2">
            <div class="h-0 relative flex" style="padding-top: 130%">
                @if ($most_view->cover_image!=null)
                <img src="{{ Storage::disk('local')->url( 'books/portada/' . $most_view->cover_image ) }}"
                    class="object-cover object-bottom absolute h-full w-full top-0 left-0" alt="{{$most_view->title}}">
                @else
                <img class="object-cover object-bottom absolute h-full w-full top-0 left-0"
                    src="{{ Storage::disk('local')->url( 'books/portada/default.jpg' ) }}" alt="{{$most_view->title}}">
                @endif
                <div class="absolute left-0 top-0 z-20">
                    <span
                        class="relative transform -rotate-45 px-2 bg-green-600 bg-opacity-50 uppercase rounded-md font-semibold text-xs text-yellow-500">
                        {{$most_view->publication_type->name}}
                    </span>
                </div>
                <div class="bg-black absolute bg-opacity-50 rounded right-0 top-0 z-20 px-2">
                    <div class="flex items-center mt-1 text-red-500 opacity-100 text-xs">
                        <i class="fa fa-eye"></i>
                        <time class="pl-1 font-bold text-white opacity-75 text-bold">{{$most_view->view}}</time>
                    </div>
                </div>
                <div class="bg-black bg-opacity-50 absolute bottom-0 z-20">
                    <div class="z-10 text-gray-400 font-semibold text-xs relative py-2 px-2 uppercase">
                        {{$most_view->title}}
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>

<div class="w-full m-auto mb-5 px-2 py-2 text-center border rounded-sm shadow-lg">
    <a href="{{ route('portal.books.show',$most_download) }}">
        <span class=" uppercase font-bold text-red-500">Mas Descargado</span>
        <div class="relative w-full  shadow rounded overflow-hidden mt-2">
            <div class="h-0 relative flex" style="padding-top: 130%">
                @if ($most_download->cover_image!=null)
                <img src="{{ Storage::disk('local')->url( 'books/portada/' . $most_download->cover_image ) }}"
                    class="object-cover object-bottom absolute h-full w-full top-0 left-0"
                    alt="{{$most_download->title}}">
                @else
                <img class="object-cover object-bottom absolute h-full w-full top-0 left-0"
                    src="{{ Storage::disk('local')->url( 'books/portada/default.jpg' ) }}"
                    alt="{{$most_download->title}}">
                @endif
                <div class="absolute left-0 top-0 z-20">
                    <span
                        class="relative transform -rotate-45 px-2 bg-green-600 bg-opacity-50 uppercase rounded-md font-semibold text-xs text-yellow-500">
                        {{$most_download->publication_type->name}}
                    </span>
                </div>
                <div class="bg-black absolute bg-opacity-50 rounded right-0 top-0 z-20 px-2">
                    <div class="flex items-center mt-1 text-red-500 opacity-100 text-xs">
                        <i class="fa fa-download"></i>
                        <time class="pl-1 font-bold text-white opacity-75 text-bold">{{$most_download->download}}</time>
                    </div>
                </div>
                <div class="bg-black bg-opacity-50 absolute bottom-0 z-20">
                    <div class="z-10 text-gray-400 font-semibold text-xs relative py-2 px-2 uppercase">
                        {{$most_download->title}}
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
