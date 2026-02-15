@extends('layouts.admin')

@section('content')
<div class="bg-[#f8f9fc] min-h-screen p-8 font-sans">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-black text-[#1a2e5a]">Trial Bookings</h1>
                <p class="text-sm text-gray-500">Manage all free trial submissions from website & Google Sheets</p>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Total Leads</span>
                <p class="text-xl font-black text-[#10AF13]">{{ $trials->count() }}</p>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 bg-green-50 border-l-4 border-[#10AF13] p-4 text-[#10AF13] text-sm font-bold rounded shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#eef1f6] border-b border-gray-100">
                            <th class="px-6 py-4 text-[11px] font-black text-[#1a2e5a] uppercase tracking-wider">Date</th>
                            <th class="px-6 py-4 text-[11px] font-black text-[#1a2e5a] uppercase tracking-wider">Student & Parent</th>
                            <th class="px-6 py-4 text-[11px] font-black text-[#1a2e5a] uppercase tracking-wider">Contact Info</th>
                            <th class="px-6 py-4 text-[11px] font-black text-[#1a2e5a] uppercase tracking-wider">Kids Details</th>
                            <th class="px-6 py-4 text-[11px] font-black text-[#1a2e5a] uppercase tracking-wider text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($trials as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm font-bold text-[#1a2e5a]">{{ $item->created_at->format('d M Y') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-black text-[#1a2e5a]">{{ $item->prefix }} {{ $item->name }}</div>
                                <div class="text-[11px] text-[#10AF13] font-bold uppercase">{{ $item->country }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-medium text-gray-600">{{ $item->phone }}</span>
                                </div>
                                <div class="text-xs text-gray-400 italic">{{ $item->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-xs text-gray-600 leading-relaxed max-w-xs">
                                    {{ Str::limit($item->kids_list, 50) }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
    {{-- Kita tembak langsung ke URL aslinya --}}
    <form action="{{ route('admin.free-trials.destroy', $item->id) }}" method="POST">
    @csrf
        {{-- @method('DELETE') --}}
        <button type="submit" 
                onclick="return confirm('Yakin hapus data ini?')"
                class="bg-red-50 hover:bg-red-100 text-red-600 p-2 rounded-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
        </button>
    </form>
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($trials->isEmpty())
            <div class="p-12 text-center">
                <p class="text-gray-400 font-medium">No trial bookings found yet.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection