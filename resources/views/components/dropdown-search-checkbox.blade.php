@props(['class', 'placeholder', 'options', 'selectedIds', 'inputName'])

<div class="{{ isset($class) ? $class : '' }}" x-data="{ open: false, checkedCount: {{ isset($selectedIds) ? count($selectedIds) : 0 }} }">
    <button  
        @click="open = ! open"
        id="dropdownSearchButton" 
        class="max-h-[38px] relative text-black border-gray-300 border-2 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-blue-800" type="button">
        
        <span x-text="checkedCount + ' selected'"></span>
        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
        </svg>
    </button>

    <div x-show="open" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        @click.outside="open = false" 
        style="display: none;" 
        class="absolute z-10 ml-48 mt-[-100px] bg-white rounded-lg shadow-lg w-60 dark:bg-gray-700">
        <div class="p-3">
            <label for="input-group-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="input-group-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search">
            </div>
        </div>
        <ul class="px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200">
            <script>
                function onCheck(t, checkedCount, isClickCheckbox) 
                {
                    let newCount = checkedCount;
                    if (isClickCheckbox) 
                        return newCount + (t.checked ? 1 : -1);

                    newCount += t.checked ? -1 : 1;
                    t.checked = !t.checked;
                    return newCount;
                }
            </script>
            @foreach ($options as $id => $name)
                @php $key = str_replace('=', '', base64_encode('zk' . $id . $name))  @endphp 
                <li class="flex items-center cursor-pointer">
                    <input
                        @click="checkedCount = onCheck($event.target, checkedCount, true)"
                        x-ref="cb{{ $key }}" 
                        {{ isset($selectedIds) && in_array($id, $selectedIds) ? 'checked' : '' }} 
                        id="checkbox-item-{{ $key }}" 
                        type="checkbox" 
                        value="{{ base64_encode($id) }}" 
                        name="{{ $inputName }}[]" 
                        class="w-4 h-4 rounded text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">

                    <div class="w-full ml-2 p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600" @click="checkedCount = onCheck($refs.cb{{ $key }}, checkedCount)">
                        <span class="w-full ms-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">{{ $name }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

