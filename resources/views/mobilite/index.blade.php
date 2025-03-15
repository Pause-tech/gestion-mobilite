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
                            <th class="py-2 px-4 border w-32">DATE DÉBUT</th>
                            <th class="py-2 px-4 border w-40">DATE FIN</th>
                            <th class="py-2 px-4 border w-1/4">MOTIVATION</th>
                            <th class="py-2 px-4 border">JUSTIFICATIF</th>
                            <th class="py-2 px-4 border w-32">STATUS</th>
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
                            <td class="py-2 px-4 border truncate w-48">
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
                                @elseif ($mobilite->status == 'validé')
                                     <span class="px-3 py-1 bg-green-500 text-white rounded-full text-xs">Validée</span>
                                @else
                                     <span class="px-3 py-1 bg-red-500 text-white rounded-full text-xs">Refusée</span>
                                     @if (!empty($mobilite->motif_refus))
                                         <br>
                                         <button onclick="openMotifModal(`{{ addslashes($mobilite->motif_refus) }}`)" 
                                                    class="text-blue-500 underline text-xs cursor-pointer">
                                           Voir le motif
                                         </button>

                                     @endif
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

<!-- MODAL Motif de Refus -->
<div id="motifModal" class="fixed inset-0 items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg w-full">
        <h2 class="text-lg font-semibold text-red-600 flex items-center">
            ❌ Refusé
        </h2>
        <textarea id="motifText" 
                  class="mt-2 text-gray-700 w-full border border-gray-300 rounded p-2" 
                  rows="4" 
                  readonly></textarea>

        <button 
            onclick="closeMotifModal()" 
            class="mt-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 w-full"
        >
            Fermer
        </button>
    </div>
</div>



<script>
    function openMotifModal(motif) {
        console.log("Motif reçu:", motif); // Debugging

        let motifTextElement = document.getElementById('motifText');
        let modalElement = document.getElementById('motifModal');

        if (motifTextElement && modalElement) {
            motifTextElement.value = motif; // Met le texte dans la zone
            modalElement.classList.remove('hidden');
            modalElement.classList.add('flex');
        } else {
            console.error("Erreur: L'élément modal ou texte introuvable !");
        }
    }

    function closeMotifModal() {
        let modalElement = document.getElementById('motifModal');
        if (modalElement) {
            modalElement.classList.add('hidden');
            modalElement.classList.remove('flex');
        }
    }
</script>



</x-app-layout>
