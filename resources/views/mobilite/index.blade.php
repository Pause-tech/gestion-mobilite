<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes demandes de mobilité') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('mobilite.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                    Faire une demande
                </a>

                <table class="w-full mt-4 border-collapse border border-gray-200 text-center">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="py-2 px-4 border">PAYS</th>
                            <th class="py-2 px-4 border">UNIVERSITÉ</th>
                            <th class="py-2 px-4 border">VILLE</th>
                            <th class="py-2 px-4 border w-32">DATE DÉBUT</th> <!-- ✅ Gardé normal -->
                            <th class="py-2 px-4 border w-40">DATE FIN</th> <!-- ✅ Élargi -->
                            <th class="py-2 px-4 border w-1/4">MOTIVATION</th> <!-- ✅ Réduit -->
                            <th class="py-2 px-4 border">JUSTIFICATIF</th>
                            <th class="py-2 px-4 border w-32">STATUS</th> <!-- ✅ Élargi -->
                            <th class="py-2 px-4 border">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mobilites as $mobilite)
                        <tr>
                            <td class="py-2 px-4 border">{{ $mobilite->pays_destination }}</td>
                            <td class="py-2 px-4 border">{{ $mobilite->universite_accueil }}</td>
                            <td class="py-2 px-4 border">{{ $mobilite->ville ?? 'Non renseignée' }}</td>
                            <td class="py-2 px-4 border">{{ $mobilite->date_debut ?? 'Non renseignée' }}</td>
                            <td class="py-2 px-4 border">{{ $mobilite->date_fin ?? 'Non renseignée' }}</td>
                            <td class="py-2 px-4 border truncate w-48"> <!-- ✅ Réduction de la largeur -->
                                {{ Str::limit($mobilite->motivation, 40, '...') }}
                                @if(strlen($mobilite->motivation) > 40)
                                    <button onclick="showFullMotivation('{{ $mobilite->id }}')" class="text-blue-500 text-xs underline">Voir plus</button>
                                    <span id="fullMotivation-{{ $mobilite->id }}" class="hidden">{{ $mobilite->motivation }}</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border">
                                 @if ($mobilite->justificatif)
                                    <a href="{{ asset('storage/' . $mobilite->justificatif) }}" target="_blank" class="text-blue-500 underline">Voir</a>
                                 @else
                                      <span class="text-gray-500">Aucun</span>
                                 @endif
                            </td>

                            <td class="py-2 px-4 border">
                                @if ($mobilite->status == 'en attente')
                                    <span class="px-3 py-1 bg-yellow-500 text-white rounded-full text-xs">En attente</span>
                                @elseif ($mobilite->status == 'validée')
                                    <span class="px-3 py-1 bg-green-500 text-white rounded-full text-xs">Validée</span>
                                @else
                                    <span class="px-3 py-1 bg-red-500 text-white rounded-full text-xs">Refusée</span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border flex gap-2 justify-center">
                                <a href="{{ route('mobilite.edit', $mobilite) }}" class="px-3 py-1 bg-blue-500 text-white rounded text-xs">
                                    Modifier 📝
                                </a>
                                <form action="{{ route('mobilite.destroy', $mobilite) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette demande ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded text-xs">
                                        Supprimer 🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function showFullMotivation(id) {
            let fullText = document.getElementById('fullMotivation-' + id);
            if (fullText.classList.contains('hidden')) {
                alert(fullText.textContent);
            }
        }
    </script>
</x-app-layout>
