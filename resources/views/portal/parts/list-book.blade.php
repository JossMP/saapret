@foreach ($books as $book)
<a href="{{ route('portal.books.show',$book) }}" class="" title="{{$book->title}}">
    <!--blog post card-->
    <article class="overflow-hidden rounded shadow-lg my-4 hover:bg-gray-200">
        <div class="sm:flex sm:flex-wrap p-2">
            <div class="sm:w-1/4 relative">
                <div class="flex justify-center">
                    @if ($book->cover_image!=null)
                    <img class="object-contain md:w-full rounded-lg shadow-image w-48" style="max-height:18rem"
                        src="{{ asset(Storage::disk('local')->url( 'books/portada/' . $book->cover_image )) }}"
                        alt="{{$book->title}}">
                    @else
                    <img class="object-contain md:w-full rounded-lg shadow-image"
                        src="{{ Storage::disk('local')->url( 'books/portada/default.jpg') }}" alt="{{$book->title}}">
                    @endif
                </div>
            </div>
            <div class="sm:w-3/4 sm:px-4">
                <!--Book category-->
                <div class="flex justify-between">
                    <div>
                        <span
                            class="uppercase tracking-wide inline-block px-4 rounded-lg text-xs font-bold bg-green-300 text-gray-600">
                            {{$book->publication_type->name}}
                        </span>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex items-center mt-1 text-red-500">
                            <i class="fa fa-download fa-fw"></i>
                            <time class="pl-3 text-sm text-gray-600">{{$book->download}}</time>
                        </div>
                        <div class="flex items-center mt-1 text-red-500">
                            <i class="fa fa-eye fa-fw"></i>
                            <time class="pl-3 text-sm text-gray-600">{{$book->view}}</time>
                        </div>
                    </div>
                </div>

                <!--Book title-->
                <h4 class="text-lg uppercase font-semibold text-gray-800 mt-2">
                    {{$book->title}}
                </h4>

                <!-- Start Book summary (excerpt)-->
                <p class="text-gray-700 mt-2">
                    {{substr($book->summary,0,200)}}...
                </p>
                <!-- End Book summary (excerpt)-->

                <!-- Start Book tags
                <div class="flex justify-between text-gray-700">
                    <div class="content-center">
                        @foreach ($book->tags as $tag)
                        <span class="text-xs font-medium bg-black mx-1 px-1 rounded text-gray-100 align-middle">
                            {{$tag->name}}
                        </span>
                        @endforeach
                    </div>
                </div>
                 End Book tags-->

                <!-- Start Book Author -->
                <div class="flex justify-between text-gray-700">
                    <div class="content-center">
                        @foreach ($book->authors as $author)
                        <div class="inline-block">
                            <div class="flex items-center space-x-1 pr-2 bg-red-500 rounded-full">
                                <img src="https://ui-avatars.com/api/?background=0D8ABC&color=fff&length=2&bold=true&name={{$author->name}}+{{$author->last_name}}"
                                    alt="{{$author->name}} {{$author->last_name}}" class="h-6 w-6 rounded-full">
                                <span class="block text-white font-bold text-xs truncate">
                                    {{$author->name}} {{$author->last_name}}
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- End Book Author -->
            </div>
        </div>
    </article>
</a>
@endforeach
{{ $books->links() }}
