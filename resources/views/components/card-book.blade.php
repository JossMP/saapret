@foreach ($books as $book)
<a href="#">
    <!--blog post card-->
    <article class="overflow-hidden rounded shadow-lg my-4">
        <div class="sm:flex sm:flex-wrap p-2">
            <div class="sm:w-1/3 h-56 sm:h-auto relative">
                <img class="w-full h-full absolute inset-0 object-contain rounded"
                    src="{{asset('images/portada/portada_0002.jpg')}}" alt="image">
            </div>
            <div class="sm:w-2/3 p-2 sm:px-4">
                <!--post category-->
                <div class="flex justify-between">
                    <div>
                        <span
                            class="uppercase tracking-wide inline-block px-4 rounded-full text-xs bg-gray-300 text-gray-600">Tipo
                            libro</span>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex items-center mt-1 text-red-500">
                            <i class="fa fa-download fa-fw"></i>
                            <time class="pl-3 text-sm text-gray-600">245</time>
                        </div>
                        <div class="flex items-center mt-1 text-red-500">
                            <i class="fa fa-eye fa-fw"></i>
                            <time class="pl-3 text-sm text-gray-600">245</time>
                        </div>
                    </div>
                </div>
                <!--post title-->
                <h4 class="text-lg uppercase font-semibold text-gray-800 mt-2">
                    Titulo de libro o tesis o lo que venga al caso
                </h4>
                <!--post excerpt-->
                <p class="text-gray-700 mt-2">
                    {{dd($book)}}
                </p>
                <!--post user info-->
                <div class="flex justify-between text-gray-700">
                    <div class="content-center ">
                        <span
                            class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500 align-middle">Paid</span>
                        <span
                            class="text-sm font-medium bg-red-100 py-1 px-2 rounded text-red-500 align-middle">Overdue</span>
                        <span
                            class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500 align-middle">Paid</span>
                        <span
                            class="text-sm font-medium bg-red-100 py-1 px-2 rounded text-red-500 align-middle">Overdue</span>
                        <span
                            class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500 align-middle">Paid</span>
                        <span
                            class="text-sm font-medium bg-red-100 py-1 px-2 rounded text-red-500 align-middle">Overdue</span>
                        <span
                            class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500 align-middle">Paid</span>
                        <span
                            class="text-sm font-medium bg-red-100 py-1 px-2 rounded text-red-500 align-middle">Overdue</span>
                        <span
                            class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500 align-middle">Paid</span>
                        <span
                            class="text-sm font-medium bg-red-100 py-1 px-2 rounded text-red-500 align-middle">Overdue</span>
                        <span
                            class="text-sm font-medium bg-green-100 py-1 px-2 rounded text-green-500 align-middle">Paid</span>
                        <span
                            class="text-sm font-medium bg-red-100 py-1 px-2 rounded text-red-500 align-middle">Overdue</span>
                    </div>

                </div>
            </div>
        </div>
    </article>
</a>
@endforeach