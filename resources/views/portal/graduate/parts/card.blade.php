<a href="{{ route('portal.person.show', $graduate->person) }}"
    class="flex bg-gray-50 shadow-lg rounded-lg overflow-hidden">
    <div class="w-2 bg-red-500"></div>
    <div class="flex items-center px-2 py-3 w-full">
        <img class="bg-white w-24 h-24 object-contain rounded-full" src="{{ $graduate->person->photo }}">
        <div class="mx-3 w-full">
            <h2 class="text-xl font-semibold text-gray-800 uppercase">
                {{ $graduate->person->name }} {{ $graduate->person->first_last_name }}
                {{ $graduate->person->second_last_name }}
                {{ $graduate->person->namefull }}
            </h2>
            <p class="text-gray-600">
                {{ $graduate->career->name }}
            </p>
            <p class="text-gray-400 text-xs">
                {{ $graduate->person->email }}
            </p>
        </div>
    </div>
</a>
