@extends('admin.layouts.master')
@section('title', 'Dashboard | Quotation')

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Display Flash Messages --}}
    @include('admin.includes.messages')

    {{-- Page Header --}}
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Quotation</h1>
            <p class="text-sm text-gray-500">Manage and view all existing quotations</p>
        </div>
        <a href="{{ route('quotations.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors duration-150">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Add Quotation
        </a>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        {{-- Card Header --}}
        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-800 uppercase">Quotation Information</h2>
            
            {{-- Search Form --}}
            <form method="GET" action="{{ route('brand.index') }}" class="flex items-center gap-2 max-w-xs w-full">
                <div class="relative w-full">
                    <input type="text" name="search" placeholder="Enter brand name to search..." autocomplete="off" required class="w-full pl-3 pr-10 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                    <button type="submit" class="absolute right-1 top-1/2 -translate-y-1/2 p-1.5 text-gray-500 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                </div>
            </form>
        </div>

        {{-- Table Container --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-600">
                <thead class="bg-gray-50 text-gray-700 uppercase text-xs font-semibold tracking-wider border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3.5">#</th>
                        <th class="px-6 py-3.5">Date</th>
                        <th class="px-6 py-3.5">Reference</th>
                        <th class="px-6 py-3.5">Biller</th>
                        <th class="px-6 py-3.5">Supplier</th>
                        <th class="px-6 py-3.5">Customer</th>
                        <th class="px-6 py-3.5">Discount</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($list as $key => $item)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ ++$key }}</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">-</td>
                            <td class="px-6 py-4">{{ $item->status }}</td>
                            <td class="px-6 py-4">{{ $item->status }}</td>
                            <td class="px-6 py-4">{{ $item->status }}</td>
                            <td class="px-6 py-4">{{ $item->status }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('quotations.edit', $item->id) }}" title="Edit Quotation" class="inline-flex items-center p-1.5 text-gray-500 hover:text-indigo-600 hover:bg-gray-100 rounded-lg transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-8 text-center text-gray-500">
                                No data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($list->hasPages())
            <div class="p-4 border-t border-gray-100 flex justify-end">
                {{ $list->links() }}
            </div>
        @endif
    </div>
</div>
@endsection