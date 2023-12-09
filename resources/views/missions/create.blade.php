<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Créer Mission
        </h2>
    </x-slot>

    <div>
    <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="block mb-8">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                            <a href="{{ route('categories.show', $category->id) }}">Retour</a>
                            </button>
                        </div>
    @if(session('message'))
                <div class="bg-green-500 text-white p-4">{{ session('message')}}</div>
                @endif
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('store-mission', $category->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nom" class="block font-medium text-sm text-gray-700">NOM</label>
                            <input type="text" name="nom" id="nom" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('nom', '') }}" />
                          @if ($errors->has('nom'))
                                <p class="text-sm text-red-600">{{ $errors->first('nom') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="prix" class="block font-medium text-sm text-gray-700">PRIX</label>
                            <input type="text" name="prix" id="prix" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('prix', '') }}" />
                            @if ($errors->has('prix'))
                                <p class="text-sm text-red-600">{{ $errors->first('prix') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                            <input type="text" name="description" id="description" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('description', '') }}" />
                                   @if ($errors->has('description'))
                                <p class="text-sm text-red-600">{{ $errors->first('description') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="link" class="block font-medium text-sm text-gray-700">LINK</label>
                            <input type="text" name="link" id="link" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('link', '') }}" />
                                   @if ($errors->has('link'))
                                <p class="text-sm text-red-600">{{ $errors->first('link') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="duration" class="block font-medium text-sm text-gray-700">DURATION (in minutes)</label>
                            <input type="text" name="duration" id="link" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('duration', '') }}" />
                                   @if ($errors->has('duration'))
                                <p class="text-sm text-red-600">{{ $errors->first('duration') }}</p>
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
    <script>
        function togglePasswordVisibilty(){
            var passwordInput = document.getElementById("password");
            if(passwordInput.type == "password"){
                passwordInput.type = "text";
            }else{
                passwordInput.type = "password";
            }
        }
    </script>
</x-app-layout>