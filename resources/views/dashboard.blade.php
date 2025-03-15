<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight bg-indigo-600 py-4 px-6 rounded-md shadow-md">
            {{ __('Tableau de bord') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto px-6">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="font-semibold text-lg text-gray-800 mb-4 flex items-center">
                    <svg class="h-6 w-6 text-indigo-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('Description des travaux de recherche et résultats attendus durant la mobilité') }}
                </h3>

                <!-- Message de succès -->
                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md shadow-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Formulaire -->
                <form method="POST" action="{{ route('dashboard.description') }}">
                    @csrf

                    <textarea name="description" rows="5" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 p-3"
                        placeholder="Décrivez ici vos travaux et résultats attendus..."></textarea>

                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg shadow-md hover:bg-indigo-700 transition-all duration-200 ease-in-out">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

