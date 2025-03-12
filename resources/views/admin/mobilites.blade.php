<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestion des Mobilités') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">Étudiant</th>
                            <th class="py-2 px-4 border">Pays</th>
                            <th class="py-2 px-4 border">Université</th>
                            <th class="py-2 px-4 border">Statut</th>
                            <th class="py-2 px-4 border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mobilites as $mobilite)
                        <tr>
                            <td class="py-2 px-4 border">{{ $mobilite->user->name }}</td>
                            <td class="py-2 px-4 border">{{ $mobilite->pays_destination }}</td>
                            <td class="py-2 px-4 border">{{ $mobilite->universite_accueil }}</td>
                            <td class="py-2 px-4 border">{{ $mobilite->status }}</td>
                            <td class="py-2 px-4 border">
                                @if($mobilite->status == 'en attente')
                                    <form action="{{ route('admin.approve', $mobilite->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded text-xs">Approuver ✅</button>
                                    </form>
                                    <form action="{{ route('admin.reject', $mobilite->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        <input type="text" name="motif_refus" placeholder="Motif du refus" required class="border-gray-300 rounded p-1 text-xs">
                                        <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded text-xs">Refuser ❌</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
