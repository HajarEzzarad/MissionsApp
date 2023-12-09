<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier Manager
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('managers.update', $managers->id) }}">
                    @csrf
                    @method('put')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="nom" class="block font-medium text-sm text-gray-700">NOM</label>
                            <input type="text" name="nom" id="nom" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('nom', $managers->nom) }}" />
                                   @if ($errors->has('nom'))
                                <p class="text-sm text-red-600">{{ $errors->first('nom') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="prenom" class="block font-medium text-sm text-gray-700">PRENOM</label>
                            <input type="text" name="prenom" id="prenom" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('prenom', $managers->prenom ) }}" />
                                   @if ($errors->has('prenom'))
                                <p class="text-sm text-red-600">{{ $errors->first('prenom') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                            <input type="text" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('email', $managers->email) }}" />
                                   @if ($errors->has('email'))
                                <p class="text-sm text-red-600">{{ $errors->first('email') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="phone" class="block font-medium text-sm text-gray-700">PHONE</label>
                            <input type="text" name="phone" id="phone" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('phone', $managers->phone) }}" />
                                   @if ($errors->has('phone'))
                                <p class="text-sm text-red-600">{{ $errors->first('phone') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="pays" class="block font-medium text-sm text-gray-700">PAYS</label>
                            <input type="text" name="pays" id="pays" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('pays', $managers->pays) }}" />
                                   @if ($errors->has('pays'))
                                <p class="text-sm text-red-600">{{ $errors->first('pays') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="ville" class="block font-medium text-sm text-gray-700">VILLE</label>
                            <input type="text" name="ville" id="ville" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('ville', $managers->ville) }}" />
                                   @if ($errors->has('ville'))
                                <p class="text-sm text-red-600">{{ $errors->first('ville') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="CIN_recto_path" class="block font-medium text-sm text-gray-700">CIN RECTO</label>
                            <input type="file" wire:model="photo" name="CIN_recto_path" id="CIN_recto_path" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('CIN_recto_path', $managers->CIN_recto_path) }}" />
                                   <button wire:click="uploadPhoto">upload CIN RECTO</button>
                                   @if ($errors->has('CIN_recto_path'))
                                <p class="text-sm text-red-600">{{ $errors->first('CIN_recto_path') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="CIN_verso_path" class="block font-medium text-sm text-gray-700">CIN VERSO</label>
                            <input type="file" wire:model="photo" name="CIN_verso_path" id="CIN_verso_path" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('CIN_verso_path', $managers->CIN_verso_path) }}" />
                                   <button wire:click="uploadPhoto">upload CIN VERSO</button>
                                   @if ($errors->has('CIN_verso_path'))
                                <p class="text-sm text-red-600">{{ $errors->first('CIN_verso_path') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="RIB" class="block font-medium text-sm text-gray-700">RIB</label>
                            <input type="text" name="RIB" id="RIB" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('RIB', $managers->RIB) }}" />
                                   @if ($errors->has('RIB'))
                                <p class="text-sm text-red-600">{{ $errors->first('RIB') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="NomBanque" class="block font-medium text-sm text-gray-700">Nom de Banque</label>
                            <input type="text" name="NomBanque" id="NomBanque" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('NomBanque', $managers->NomBanque) }}" />
                            @if ($errors->has('NomBanque'))
                                <p class="text-sm text-red-600">{{ $errors->first('NomBanque') }}</p>
                         @endif
                        </div>
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                            <input type="password" name="password" id="password" class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('password')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex items-center justify-end px-4 py-3 bg-purple-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-purple-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:border-purple-900 focus:shadow-outline-purple disabled:opacity-25 transition ease-in-out duration-150">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>