<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Category
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('categories.update', $categories->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nom" class="block font-medium text-sm text-gray-700">NOM</label>
                            <input type="text" name="nom" id="nom" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('nom', $categories->nom) }}" />
                                   @if ($errors->has('nom'))
                                <p class="text-sm text-red-600">{{ $errors->first('nom') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="icon_path" class="block font-medium text-sm text-gray-700">IMAGE</label>
                            <input type="file" name="icon_path" id="icon_path" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $categories->icon_path}}" />
                               
                                   @if ($errors->has('icon_path'))
                                <p class="text-sm text-red-600">{{ $errors->first('icon_path') }}</p>
                         @endif
                        </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-purple-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>