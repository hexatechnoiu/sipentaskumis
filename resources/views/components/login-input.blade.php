<input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
    {{ $attributes->merge([
        'class' =>
            'peer transition-all duration-500 border border-gray-300 text-gray-900 placeholder-transparent focus:outline-none h-full auto px-2.5 pb-2.5 pt-4  text-sm  bg-transparent rounded-lg border-1  appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:border-2 focus:border-blue-600',
    ]) }}
    placeholder="{{ $placeholder }}" />
<label for="{{ $placeholder }}"
    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto
     ">{{ $placeholder }}</label>
