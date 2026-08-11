@extends('admin.layouts.master')

@section('title') Dashboard | Warehouse @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Display alert messages --}}
    @include('admin.includes.messages')

    <!-- Header Section -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">WAREHOUSE</h2>
            <p class="text-sm text-slate-500">Manage your warehouse information and locations</p>
        </div>

        <!-- Action / Add Button -->
        <a href="{{ route('warehouse.create') }}" 
           class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <i class="material-icons text-base mr-2">add</i>
            Add Warehouse
        </a>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        
        <!-- Card Header & Search Bar -->
        <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="text-lg font-semibold text-slate-700">WAREHOUSE INFORMATION</h3>

            <!-- Search Form -->
            <form method="GET" action="{{ route('warehouse.index') }}" class="flex items-center gap-2">
                <div class="relative flex-1 sm:w-64">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Enter warehouse to search..." 
                           autocomplete="off" 
                           required
                           class="w-full pl-3 pr-10 py-2 bg-white border border-slate-300 rounded-lg text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-colors">
                </div>
                <button type="submit" 
                        class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors flex items-center justify-center"
                        title="Search">
                    <i class="material-icons text-base">search</i>
                </button>
            </form>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wider">
                        <th class="px-6 py-4">#</th>
                        <th class="px-6 py-4">Warehouse</th>
                        <th class="px-6 py-4">Phone</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($list as $key => $item)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 font-medium text-slate-500">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $item->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $item->phone }}
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ $item->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if($item->status == 1)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('warehouse.edit', $item->id) }}" 
                                   class="inline-flex items-center justify-center p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors"
                                   title="Edit Warehouse">
                                    <i class="material-icons text-lg">edit</i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <!-- DataTables friendly empty row with exact 6 columns -->
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-400 font-medium">
                                No warehouse data found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($list->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex justify-end">
                {{ $list->links() }}
            </div>
        @endif
    </div>
</div>
@endsection