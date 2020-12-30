<div class="absolute z-50 top-0 right-0 flex" x-data="{'alert':true}" :class="{'hidden':!alert}" x-init="setTimeout(function () {
    alert = false
  }, 2000)">
    <div class="mr-2 mt-24">
        <div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">
            <div class="flex flex-row items-center">
                <div class="px-2">
                    <i class="text-2xl text-red-600 fa fa-times-circle"></i>
                </div>
                <div class="ml-2 mr-6">
                    <span class="font-semibold">ERROR!</b> </span>
                    <span class="block text-gray-500">{{$slot}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
