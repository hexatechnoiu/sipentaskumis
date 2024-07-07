@props([
    'name' => '',
    'placeholder' => '',
])
<div class="relative w-full">
<select name="{{ $name }}"
    {{ $attributes->merge([
        'class' =>
            'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 border bg-transparent rounded-lg border-1 appearance-none dark:focus:border-blue-500 focus:outline-none focus:ring-0 border-gray-300 valid:border-blue-600 peer',
    ]) }}
    placeholder="{{ $placeholder }}">
    {{ $slot }}
</select>
<label for="organisasi"
    class="absolute text-sm -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 text-gray-300 peer-valid:text-blue-600 start-1">
    {{ $placeholder }}
</label>
</div>
