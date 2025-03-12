<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouvelle demande de mobilité') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('mobilite.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Pays de destination -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Pays de destination</label>
                        <input type="text" name="pays_destination" class="border-gray-300 rounded w-full" required>
                    </div>

                    <!-- Université d'accueil -->
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Université d'accueil</label>
                        <input type="text" name="universite_accueil" class="border-gray-300 rounded w-full" required>
                    </div>

                    <!-- Ville -->
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Ville</label>
                        <input type="text" name="ville" class="border-gray-300 rounded w-full" required>
                    </div>

                    <!-- Dates du séjour -->
                    <div class="mt-4 flex space-x-4">
                        <div class="w-1/2">
                            <label class="block font-medium text-sm text-gray-700">Date de début</label>
                            <input type="date" name="date_debut" class="border-gray-300 rounded w-full" required>
                        </div>
                        <div class="w-1/2">
                            <label class="block font-medium text-sm text-gray-700">Date de fin</label>
                            <input type="date" name="date_fin" class="border-gray-300 rounded w-full" required>
                        </div>
                    </div>

                    <!-- Motivation -->
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Motivation</label>
                        <textarea name="motivation" rows="4" class="border-gray-300 rounded w-full" required></textarea>
                    </div>

                    <!-- Justificatif + Invitation -->
                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">Cadre de la mobilité (Joindre le justificatif + Invitation)</label>
                        <input type="file" name="justificatif" class="border-gray-300 rounded w-full">
                    </div>

                    <!-- Bouton d'envoi -->
                    <div class="mt-6">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Envoyer la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
@if ($errors->has('justificatif'))
    <p class="text-red-500 text-sm">{{ $errors->first('justificatif') }}</p>
@endif


