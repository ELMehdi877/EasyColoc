@extends('layouts.app')

@section('page_title', 'Table de Bord')

@section('header_actions')
    <button class="bg-indigo-600 text-white px-5 py-2.5 rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition flex items-center">
        <span class="mr-2">+</span> Nouvelle colocation
    </button>
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <div class="bg-white p-8 rounded-[2rem] border border-gray-50 shadow-sm flex flex-col justify-center">
            <div class="p-3 bg-emerald-50 w-fit rounded-2xl mb-4 text-emerald-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p class="text-gray-400 font-bold text-sm uppercase">Mon score réputation</p>
            <h3 class="text-4xl font-black text-gray-900 mt-2">0</h3>
        </div>
        
        <div class="bg-white p-8 rounded-[2rem] border border-gray-50 shadow-sm">
            <div class="p-3 bg-indigo-50 w-fit rounded-2xl mb-4 text-indigo-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p class="text-gray-400 font-bold text-sm uppercase">Dépenses Globales (Fév)</p>
            <h3 class="text-4xl font-black text-gray-900 mt-2">389,00 €</h3>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-[2rem] border border-gray-50 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                <h3 class="text-lg font-black text-gray-800 uppercase tracking-tight italic">Dépenses récentes</h3>
                <a href="#" class="text-indigo-600 font-bold text-sm hover:underline">Voir tout</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50/50 text-[10px] uppercase font-black text-gray-400">
                        <tr>
                            <th class="px-6 py-4 text-left tracking-widest">Titre / Catégorie</th>
                            <th class="px-6 py-4 text-center tracking-widest">Payeur</th>
                            <th class="px-6 py-4 text-center tracking-widest">Montant</th>
                            <th class="px-6 py-4 text-right tracking-widest">Coloc</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr class="hover:bg-gray-50/30 transition text-sm">
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-800">facture wifi</p>
                                <span class="text-[10px] bg-indigo-50 text-indigo-500 px-2 py-0.5 rounded uppercase font-bold">Internet</span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center mx-auto text-xs font-black">A</span>
                            </td>
                            <td class="px-6 py-4 text-center font-black text-gray-900">90,00 €</td>
                            <td class="px-6 py-4 text-right text-xs text-gray-400 font-bold italic underline">coloc 1</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-[#1e293b] text-white p-6 rounded-[2rem] shadow-xl">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold uppercase tracking-tight text-sm">Membres de la coloc</h3>
                    <span class="text-[10px] bg-gray-700 px-2 py-0.5 rounded font-black tracking-widest">ACTIFS</span>
                </div>
                <div class="flex justify-between items-center bg-white/5 p-3 rounded-2xl">
                    <div class="flex items-center">
                        <div class="w-2 h-2 bg-green-500 rounded-full mr-3 animate-pulse"></div>
                        <span class="text-sm font-medium">user 2 (Owner)</span>
                    </div>
                    <span class="text-green-400 font-black">0</span>
                </div>
            </div>

            <div class="bg-white p-6 rounded-[2rem] border border-gray-50 shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-bold text-gray-800 uppercase tracking-tight">Catégories</h3>
                    <button class="text-[10px] bg-indigo-600 text-white px-3 py-1 rounded-lg font-black">+ AJOUTER</button>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-2xl group transition hover:bg-indigo-50">
                        <div class="flex items-center">
                            <span class="p-2 bg-white rounded-xl shadow-sm mr-3">🏷️</span>
                            <span class="text-sm font-bold text-gray-700">Courses</span>
                        </div>
                        <button class="text-red-400 opacity-0 group-hover:opacity-100 transition">🗑️</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection