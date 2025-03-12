<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la demande de mobilité') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('mobilite.update', $mobilite) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block font-medium text-sm text-gray-700">Pays de destination</label>
                        <input type="text" name="pays_destination" value="{{ $mobilite->pays_destination }}" class="border-gray-300 rounded w-full" required>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Université d'accueil</label>
                        <input type="text" name="universite_accueil" value="{{ $mobilite->universite_accueil }}" class="border-gray-300 rounded w-full" required>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Ville</label>
                        <input type="text" name="ville" value="{{ $mobilite->ville }}" class="border-gray-300 rounded w-full">
                    </div>

                    <div class="mt-4 flex space-x-4">
                        <div class="w-1/2">
                            <label class="block font-medium text-sm text-gray-700">Date de début</label>
                            <input type="date" name="date_debut" value="{{ $mobilite->date_debut }}" class="border-gray-300 rounded w-full">
                        </div>

                        <div class="w-1/2">
                            <label class="block font-medium text-sm text-gray-700">Date de fin</label>
                            <input type="date" name="date_fin" value="{{ $mobilite->date_fin }}" class="border-gray-300 rounded w-full">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Motivation</label>
                        <textarea name="motivation" rows="4" class="border-gray-300 rounded w-full">{{ $mobilite->motivation }}</textarea>
                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Justificatif (joindre un nouveau fichier si nécessaire)</label>
                        <input type="file" name="justificatif" class="border-gray-300 rounded w-full">
                        @if($mobilite->justificatif)
                            <p class="text-sm text-gray-500 mt-1">
                                Fichier actuel : <a href="{{ asset('storage/' . $mobilite->justificatif) }}" target="_blank" class="text-blue-500 underline">Voir le justificatif</a>
                            </p>
                        @endif
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Sauvegarder les modifications
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

