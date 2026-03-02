@extends('layouts.app')


@if($dejaMembre)

@section('page_title', 'COLOC 1')

@section('header_actions')
    @if($colocation->pivot->role === 'owner')
    <button class="flex items-center gap-2 px-4 py-2 text-red-500 border border-red-100 bg-white rounded-xl hover:bg-red-50 transition text-sm font-bold">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
        Annuler la colocation
    </button>
    @else
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-6 py-2 bg-gray-900 text-white rounded-xl hover:bg-gray-800 transition text-sm font-bold">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        Quitter
    </a>
    @endif
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    
    <div class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between">
            <button onclick="toggleModal('addCategory')" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-indigo-700 transition flex items-center gap-2">
                <span class="text-lg">+</span> Nouvelle categorie
            </button>
            <button onclick="toggleModal('addDepense')" class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-indigo-700 transition flex items-center gap-2">
                <span class="text-lg">+</span> Nouvelle dépense
            </button>

        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center gap-4">
                <div class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-lg text-indigo-600 font-medium text-sm">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"></path></svg>
                    Filtrer par mois :
                </div>
                <select class="bg-white border border-gray-200 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    <option>Tous les mois</option>
                </select>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50/50">
                        <tr>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-left">Titre / Catégorie</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Payeur</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Montant</th>
                            <th class="px-6 py-4 text-[10px] font-black text-gray-400 uppercase tracking-widest text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($colocation->depenses->isNotEmpty())
                            @foreach($colocation->depenses as $depense)
                                <tr class="hover:bg-gray-50 transition-colors text-sm">
                                    <td class="px-6 py-4">
                                        <p class="font-bold text-gray-800">{{ $depense->categorie->name }}</p>
                                        <span class="text-[10px] bg-indigo-50 text-indigo-500 px-2 py-0.5 rounded uppercase font-bold">{{ $depense->titre }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="p-2 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mx-auto text-xs font-black">{{ $depense->user->name }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center font-black text-gray-900">{{ $depense->amount }} DH</td>
                                    <td class="px-6 py-4 text-right">
                                        @php
                                            $userRole = $colocation->users
                                                ->firstWhere('id', auth()->id())?->pivot?->role;
                                        @endphp
                                        @if($userRole === 'owner' || $userRole === 'admin')
                                            <form action="{{ route('depenses.destroy', $depense->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-8 h-8 flex items-center justify-center bg-red-100 hover:bg-red-200 rounded-full text-red-600 hover:text-red-800 transition-all">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M1 7h22M8 7V4a1 1 0 011-1h6a1 1 0 011 1v3">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            Action
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="px-6 py-20 text-center text-gray-400 italic text-sm">
                                    Aucune dépense pour le moment.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="space-y-8">
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-6">Qui doit à qui ?</h3>
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-10 flex flex-col items-center justify-center text-center">
                <div class="bg-white rounded-3xl border border-gray-100 p-10 flex flex-col items-center justify-center text-center">
                    <p class="text-gray-400 text-sm italic font-medium">Aucun remboursement en attente.</p>
                </div>
            </div>
        </div>

        <div class="bg-[#1e293b] rounded-3xl p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-white font-bold">Membres de la coloc</h3>
                <span class="bg-gray-700 text-[10px] text-gray-300 px-2 py-1 rounded font-bold uppercase tracking-tighter">Actifs</span>
            </div>

            <div class="space-y-4">
                @foreach($colocation->users as $member)
                    <div class="flex items-center justify-between group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-gray-700 flex items-center justify-center text-white font-bold">A</div>
                            <div>
                                <p class="text-sm font-bold text-white">{{ $member->name }}</p>
                                <p class="text-[10px] text-orange-400 font-bold flex items-center gap-1 uppercase">
                                    @if ( $member->pivot->role === 'owner')
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endif
                                    {{ $member->pivot->role }}
                                </p>
                            </div>
                        </div>
                        <span class="text-emerald-400 font-bold text-sm">0</span>
                    </div>
                @endforeach
                <hr class="border-gray-400">

                <button onclick="toggleModal('inviteModal')" class="w-full py-3 bg-gray-700/50 hover:bg-gray-700 text-white rounded-xl text-sm font-bold transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    Inviter un membre
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Fenêtre Modale invitation --}}
    <div id="inviteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/20 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-2xl p-10 rounded-[2.5rem] shadow-2xl border border-gray-50 transform transition-all">
            <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest italic mb-8">Invitatiion par email</h2>
            <form action="{{ route('invitations.send', $colocation->id) }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-[11px] font-black text-indigo-900 uppercase tracking-wider mb-2 italic">Email d'utilisateur</label>
                    <input type="email" name="email" placeholder="ex: Résidence Les Lilas" required
                           class="w-full px-5 py-3 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>
                <div class="flex items-center gap-6">
                    <button type="submit" class="px-8 py-3 bg-[#4f46e5] text-white text-xs font-black rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all uppercase tracking-widest">
                        Créer la colocation
                    </button>
                    <button type="button" onclick="toggleModal('inviteModal')" class="text-xs font-black text-gray-400 hover:text-gray-600 uppercase tracking-widest transition-colors">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>


{{-- Fenêtre Modale depense --}}
<div id="addDepense" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/40 backdrop-blur-sm transition-opacity">
    <div class="bg-white w-full max-w-2xl p-10 rounded-[2.5rem] shadow-2xl border border-gray-50 transform transition-all">
        
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Nouvelle dépense</h2>
        
        <form action="{{ route('depenses.store') }}" method="POST">
            @csrf
            
            <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Titre</label>
                <input type="text" name="titre" placeholder="ex: Courses Intermarché" required
                    class="w-full px-5 py-4 rounded-2xl border-gray-200 bg-white text-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder:text-gray-300">
            </div>

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Montant (€)</label>
                    <input type="number" step="0.01" name="amount" placeholder="0.00" required
                        class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-600 focus:ring-2 focus:ring-indigo-500 transition-all">
                </div>
                
            </div> 
      
            <div class="grid grid-cols-2 gap-6 mb-10">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Payé par</label>
                    <select name="user_id" class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-600 focus:ring-2 focus:ring-indigo-500 transition-all appearance-none">
                        <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                        </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catégorie</label>
                    <select name="categorie_id" class="w-full px-5 py-4 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-600 focus:ring-2 focus:ring-indigo-500 transition-all appearance-none">
                        <option value="" disabled selected>Choisissez une catégorie</option>
                       @foreach($colocation->categories as $categorie)
                            <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                        @endforeach 
                   
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <button type="button" onclick="toggleModal('addDepense')"
                    class="px-8 py-4 text-gray-500 font-bold hover:bg-gray-100 rounded-2xl transition-all">
                    Annuler
                </button>
                <button type="submit" 
                    class="px-8 py-4 bg-[#4f46e5] text-white font-bold rounded-2xl shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">
                    Enregistrer la dépense
                </button>
            </div>
        </form>
    </div>
</div>


{{-- Fenêtre Modale category --}}
<div id="addCategory" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/20 backdrop-blur-sm transition-opacity">
    <div class="bg-white w-full max-w-2xl p-10 rounded-[2.5rem] shadow-2xl border border-gray-50 transform transition-all">
        <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest italic mb-8">Nouvelle categorie</h2>
        <form action="{{ route('categories.store', $colocation->id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-[11px] font-black text-indigo-900 uppercase tracking-wider mb-2 italic">Categorie</label>
                <input type="text" name="name" placeholder="ex: Résidence Les Lilas" required
                        class="w-full px-5 py-3 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
            </div>
            <div class="flex items-center gap-6">
                <button type="submit" class="px-8 py-3 bg-[#4f46e5] text-white text-xs font-black rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all uppercase tracking-widest">
                    Créer categorie
                </button>
                <button type="button" onclick="toggleModal('addCategory')" class="text-xs font-black text-gray-400 hover:text-gray-600 uppercase tracking-widest transition-colors">
                    Annuler
                </button>
            </div>
        </form>

    </div>
</div>

@endsection


@else

{{-- 1. Titre dynamique passé au Layout --}}
@section('page_title', 'Mes colocations')

{{-- 2. Bouton d'action passé au Header du Layout --}}
@section('header_actions')
<button onclick="toggleModal('createModal')" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition flex items-center transform active:scale-95">
    <span class="mr-2 text-base">+</span> {{ __('Nouvelle colocation') }}
</button>
@endsection

@section('content')

@empty($colocations )
    {{-- Grille des cartes --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
        @foreach($colocations as $colocation)
        <div class="relative bg-white p-8 rounded-[2.5rem] border border-indigo-100/50 shadow-xl shadow-indigo-100/20 group transition-all">
            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                <span class="flex items-center gap-1 px-4 py-1.5 bg-orange-500 text-white text-[10px] font-black rounded-full shadow-lg shadow-orange-200 uppercase">
                    👑 OWNER
                </span>
            </div>
            <div class="absolute top-6 right-8">
                <span class="px-3 py-1 bg-green-50 text-green-500 text-[10px] font-black rounded-lg uppercase tracking-widest">Active</span> 
            </div>

            <div class="mt-4 flex flex-col items-start">
                <div class="p-2 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-6 shadow-lg shadow-indigo-200">{{ $colocation->creator->name }}</div>
                <h3 class="text-xl font-black text-indigo-700 mb-1 tracking-tight italic">{{ $colocation->name }}</h3>
                <p class="text-[11px] font-bold text-indigo-400 uppercase tracking-widest italic">{{ $colocation->users()->count() }} Membres</p>
            </div>

            <div class="mt-12 flex justify-between items-end border-t border-gray-50 pt-6">
                <div>
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1 italic">Dépenses</p>
                    <p class="text-2xl font-black text-indigo-900 leading-none">0</p>
                </div>
                <form action="{{ route('colocations.rejoindre', $colocation->id) }}" method="POST">
                    @csrf

                    <button class="w-11 h-11 bg-[#111827] rounded-2xl flex items-center justify-center text-white shadow-lg shadow-gray-200 transform group-hover:translate-x-1 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
        
        <!-- <div class="relative bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm opacity-90">
            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                <span class="flex items-center gap-1 px-4 py-1.5 bg-orange-500 text-white text-[10px] font-black rounded-full shadow-lg shadow-orange-200 uppercase opacity-80">
                    👑 OWNER
                </span>
            </div>
            <div class="absolute top-6 right-8">
                <span class="px-3 py-1 bg-gray-50 text-gray-400 text-[10px] font-black rounded-lg uppercase tracking-widest border border-gray-100">Cancelled</span>
            </div>
            <div class="mt-4 flex flex-col items-start text-gray-400">
                <div class="w-14 h-14 bg-indigo-500/80 rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-6 shadow-md">C</div>
                <h3 class="text-xl font-black text-indigo-900 mb-1 tracking-tight italic">coloc 2</h3>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest italic">2 Membres</p>
            </div>
            <div class="mt-12 flex justify-between items-end border-t border-gray-50 pt-6">
                <div>
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1 italic">Dépenses</p>
                    <p class="text-2xl font-black text-indigo-900/50 leading-none">1</p>
                </div>
                <button class="w-11 h-11 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>
        
        <div class="relative bg-white/40 p-8 rounded-[2.5rem] border border-dashed border-gray-200 opacity-60 grayscale-[0.5]">
            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                <span class="flex items-center gap-1 px-4 py-1.5 bg-slate-400 text-white text-[10px] font-black rounded-full shadow-md uppercase">🚪 QUITTÉE</span>
            </div>
            <div class="mt-4 flex flex-col items-start opacity-40">
                <div class="w-14 h-14 bg-gray-200 rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-6">C</div>
                <h3 class="text-xl font-black text-gray-400 mb-1 tracking-tight italic">coloc 1</h3>
                <p class="text-[11px] font-bold text-gray-300 uppercase tracking-widest italic">1 Membres</p>
            </div>
            <div class="mt-12 flex justify-between items-end pt-6 opacity-30">
                <div><p class="text-2xl font-black">2</p></div>
                <div class="w-11 h-11 border border-gray-100 rounded-full flex items-center justify-center text-gray-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                </div>
            </div>
        </div> -->
    </div>
    @endempty
    
    {{-- Fenêtre Modale ajouter une colocation --}}
    <div id="createModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/20 backdrop-blur-sm transition-opacity">
        <div class="bg-white w-full max-w-2xl p-10 rounded-[2.5rem] shadow-2xl border border-gray-50 transform transition-all">
            <h2 class="text-sm font-black text-gray-800 uppercase tracking-widest italic mb-8">NOUVELLE COLOCATION</h2>
            <form action="/cree_coloc" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-[11px] font-black text-indigo-900 uppercase tracking-wider mb-2 italic">Nom de la colocation</label>
                    <input type="text" name="name" placeholder="ex: Résidence Les Lilas" required
                           class="w-full px-5 py-3 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                </div>
                <div class="mb-10">
                    <label class="block text-[11px] font-black text-indigo-900 uppercase tracking-wider mb-2 italic">Description (optionnel)</label>
                    <textarea name="description" rows="4" placeholder="Décrivez brièvement votre colocation..."
                              class="w-full px-5 py-3 rounded-2xl border-gray-100 bg-gray-50/50 text-gray-600 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all resize-none"></textarea>
                </div>
                <div class="flex items-center gap-6">
                    <button type="submit" class="px-8 py-3 bg-[#4f46e5] text-white text-xs font-black rounded-2xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all uppercase tracking-widest">
                        Créer la colocation
                    </button>
                    <button type="button" onclick="toggleModal('createModal')" class="text-xs font-black text-gray-400 hover:text-gray-600 uppercase tracking-widest transition-colors">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@endif
@push('scripts')
<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        modal.classList.toggle('hidden');

        document.body.style.overflow =
            modal.classList.contains('hidden') ? 'auto' : 'hidden';
    }

    window.onclick = function(event) {
        const createModal = document.getElementById('createModal');
        const inviteModal = document.getElementById('inviteModal');

        if (event.target == createModal) {
            toggleModal('createModal');
        }

        if (event.target == inviteModal) {
            toggleModal('inviteModal');
        }
    }
</script>
@endpush


