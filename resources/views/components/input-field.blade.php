<div>
    <label for="{{ $id }}" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">{{ $label }}</label>
    <input
        type="{{ $type }}"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        @if ($type == "password")
            minlength="6"
        @endif
        @required($isRequired == "1")
        @readonly($isReadOnly == "1")
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#307487] focus:border-[#307487] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-[#307487] dark:focus:border-[#307487]"
    >
</div>
