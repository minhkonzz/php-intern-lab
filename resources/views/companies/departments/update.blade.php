<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('companies.edit', $viewData->company->id) }}">&larr; Back</a>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ __('Update department') }}</h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{ __("Update department information") }}</p>
                        </header>
                        <form action="{{ route('departments.update', $viewData->id) }}" method="POST" class="mt-6 space-y-6">
                            @csrf
                            @method("PUT")
                            @foreach([
                                ['name' => 'name', 'title' => 'Name', 'value' => $viewData->name],
                                ['name' => 'code', 'title' => 'Code', 'value' => $viewData->code]
                            ] as $field)
                                <div>
                                    <x-input-label :for="$field['name']" :value="__('Name')" />
                                    <x-text-input :id="$field['name']" :name="$field['name']" type="text" class="mt-1 block w-full" :value="$field['value']" required autofocus :autocomplete="$field['name']" />
                                    <x-input-error class="mt-2" :messages="$errors->get($field['name'])" />
                                </div>
                            @endforeach

                            @if (count($viewData->departments) > 0)
                                <div>
                                    <x-input-label for="parent" :value="__('Parent department')" />
                                    <x-dropdown-search 
                                        placeholder="Select parent department" 
                                        :options="$viewData->departments" 
                                        inputName="parent_department" 
                                        selectedId="{{ isset($viewData->parent) ? $viewData->parent->id : null }}" 
                                        selectedName="{{ isset($viewData->parent) ? $viewData->parent->name : null }}"/>
                                </div>
                            @endif
                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
