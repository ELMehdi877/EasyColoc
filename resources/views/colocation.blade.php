@extends('layouts.app')

{{-- 1. Titre dynamique passé au Layout --}}
@section('page_title', 'Mes colocations')

{{-- 2. Bouton d'action passé au Header du Layout --}}
@section('header_actions')
    <button onclick="toggleModal()" class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition flex items-center transform active:scale-95">
        <span class="mr-2 text-base">+</span> {{ __('Nouvelle colocation') }}
    </button>
@endsection

@section('content')
    {{-- Grille des cartes --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        
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
                <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-black mb-6 shadow-lg shadow-indigo-200">C</div>
                <h3 class="text-xl font-black text-indigo-700 mb-1 tracking-tight italic">coloc 3</h3>
                <p class="text-[11px] font-bold text-indigo-400 uppercase tracking-widest italic">1 Membres</p>
            </div>

            <div class="mt-12 flex justify-between items-end border-t border-gray-50 pt-6">
                <div>
                    <p class="text-[10px] font-black text-gray-300 uppercase tracking-widest mb-1 italic">Dépenses</p>
                    <p class="text-2xl font-black text-indigo-900 leading-none">0</p>
                </div>
                <button class="w-11 h-11 bg-[#111827] rounded-2xl flex items-center justify-center text-white shadow-lg shadow-gray-200 transform group-hover:translate-x-1 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </button>
            </div>
        </div>

        <div class="relative bg-white p-8 rounded-[2.5rem] border border-gray-100 shadow-sm opacity-90">
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
        </div>
    </div>

    {{-- Fenêtre Modale --}}
    <div id="colocModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-slate-900/20 backdrop-blur-sm transition-opacity">
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
                    <button type="button" onclick="toggleModal()" class="text-xs font-black text-gray-400 hover:text-gray-600 uppercase tracking-widest transition-colors">
                        Annuler
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function toggleModal() {
        const modal = document.getElementById('colocModal');
        modal.classList.toggle('hidden');
        document.body.style.overflow = modal.classList.contains('hidden') ? 'auto' : 'hidden';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('colocModal');
        if (event.target == modal) toggleModal();
    }
</script>
@endpush