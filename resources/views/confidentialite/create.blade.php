<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Confidentialité
        </h2>
    </x-slot>
    <div>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
<div class="block mb-8">
                <a href="{{ route('confidentialite.index') }}" class="text-purple font-bold py-2 px-4 rounded"><i class="fas fa-arrow-left"></i>Retour</a>
            </div>
@if(session('message'))
                <div class="bg-green-500 text-white p-4">{{ session('message')}}</div>
                @endif
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('confidentialite.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="text" class="block font-medium text-sm text-gray-700">Text</label>
                            <textarea name="text" id="text" class="form-input rounded-md shadow-sm mt-1 block w-full h-48 resize-none"
                                   value="{{ old('text', '') }}" ></textarea>
                          @if ($errors->has('text'))
                                <p class="text-sm text-red-600">{{ $errors->first('text') }}</p>
                         @endif
                        </div>
                       
                        <div class="flex items-center justify-end px-4 py-3 bg-purple-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                                Créer
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>