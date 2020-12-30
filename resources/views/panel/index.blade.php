@extends('portal.layouts.app')
@section('title')
{{ __('Pagina de inicio') }}
@endsection
@section('content')
<section class="bg-white w-full px-5 sm:px-8 xl:pt-6 lg:px-16 xl:px-40 2xl:px-64 pt-4">

    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">

    </button>
    <button
        class="w-64 block px-4 py-2 text-center text-white transition bg-green-800 rounded shadow ripple waves-light hover:shadow-lg hover:bg-black focus:outline-none waves-effect">
        <i class="fa fa-fw fa-users text-8xl block"></i>
        <span class="block uppercase font-bold text-gray-100">largue name</span>
    </button>
</section>
@endsection
