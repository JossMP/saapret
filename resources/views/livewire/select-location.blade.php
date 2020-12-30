<div class="grid sm:grid-cols-3 gap-4 mx-4 pb-4">
    <div class="col-span-3 md:col-span-1">
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2"
            for="department_{{ $name }}">
            Departamento
        </label>
        <select wire:model="department_id"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('department_{{ $name }}') border-red-500 @else border-gray-400 @enderror text-grey-darker py-3 px-4 pr-8 rounded"
            id="department_{{ $name }}" required>
            <option value="" selected>Seleccione un departamento</option>
            @foreach ($departments as $department)
            <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-span-3 md:col-span-1">
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="province_{{ $name }}">
            Provincia
        </label>
        <select wire:model="province_id"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('province_{{ $name }}') border-red-500 @else border-gray-400 @enderror text-grey-darker py-3 px-4 pr-8 rounded"
            id="province_{{ $name }}" required>
            <option value="" selected>Seleccione un Provincia</option>
            @foreach ($provinces as $province)
            <option value="{{ $province->id }}">{{ $province->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-span-3 md:col-span-1">
        <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="district_{{ $name }}">
            Distrito
        </label>
        <select wire:model="district_id"
            class="appearance-none block w-full bg-grey-lighter text-grey-darker border @error('district_{{ $name }}') border-red-500 @else border-gray-400 @enderror text-grey-darker py-3 px-4 pr-8 rounded"
            id="district_{{ $name }}" name="location_{{ $name }}" required>
            <option value="" selected>Seleccione un Distrito</option>
            @foreach ($districts as $district)
            <option value="{{ $district->id }}">{{ $district->name }}</option>
            @endforeach
        </select>
    </div>
</div>
