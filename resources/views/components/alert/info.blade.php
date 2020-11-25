<section class="grid bg-transparent w-full px-5 sm:px-8 pt-8 lg:px-16 xl:px-40 2xl:px-64 gap-x-2" x-data="{alert:false}"
    :class="{'hidden':alert}">
    <div class="justify-self-center text-white px-6 py-4 border-0 rounded relative mb-4 bg-blue-500">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fa fa-exclamation-circle"></i>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize">INFO!</b> {{$slot}}
        </span>
        <button @click.prevent="alert=true"
            class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
            <span>×</span>
        </button>
    </div>
</section>
