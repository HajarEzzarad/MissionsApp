<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nom" class="block font-medium text-sm text-gray-700">Nom</label>
                            <input type="text" name="nom" id="nom" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value=" {{ old('nom', $user->nom) }}" />
                            @error('nom')
                       
                                <p class="text-sm text-red-600">{{ $message }}</p>
                           @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="prenom" class="block font-medium text-sm text-gray-700">Prénom</label>
                            <input type="text" name="prenom" id="prenom" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value=" {{ old('prenom', $user->prenom) }}" />
                            @error('prenom')
                       
                                <p class="text-sm text-red-600">{{ $message }}</p>
                           @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('email', $user->email) }}" />
                          @error('email')
                        
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="phone" class="block font-medium text-sm text-gray-700">Phone</label>
                            <input type="phone" name="phone" id="phone" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('phone', $user->phone) }}" />
                          @error('phone')
                        
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="pays" class="block font-medium text-sm text-gray-700">Pays</label>
                            <input type="pays" name="pays" id="pays" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('pays', $user->pays) }}" />
                          @error('pays')
                        
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="ville" class="block font-medium text-sm text-gray-700">Ville</label>
                            <input type="ville" name="ville" id="ville" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('ville', $user->ville) }}" />
                          @error('ville')
                        
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="CIN_path" class="block font-medium text-sm text-gray-700">CIN </label>
                            <input type="CIN_path" name="CIN_path" id="CIN_path" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('CIN_path', $user->CIN_path) }}" />
                          @error('CIN_path')
                        
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="RIB" class="block font-medium text-sm text-gray-700">RIB</label>
                            <input type="RIB" name="RIB" id="RIB" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('RIB', $user->RIB) }}" />
                          @error('RIB')
                        
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="NomBanque" class="block font-medium text-sm text-gray-700">Nom de banque</label>
                            <input type="NomBanque" name="NomBanque" id="NomBanque" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('NomBanque', $user->NomBanque) }}" />
                          @error('NomBanque')
                        
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                       

                        <div class="flex items-center justify-end px-4 py-3 bg-pueple-50 text-right sm:px-6">
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