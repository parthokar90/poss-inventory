@extends('admin.layouts.master')
@section('title') Dashboard | Supplier @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Display alert and system messages --}}
    @include('admin.includes.messages')

    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wider">Supplier</h2>
    </div>

    <div class="w-full">
        <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
            
            {{-- Card Header: Contains Title, Search Bar & Action Menu --}}
            <div class="p-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 uppercase">Supplier Information</h2>
                </div>

                <div class="flex items-center gap-4">
                    {{-- Search Form --}}
                    <form method="GET" action="{{ route('supplier.index') }}" class="flex items-center gap-2">
                        <div class="relative w-full md:w-80">
                            <input type="text" 
                                   class="w-full px-4 py-2 pr-10 text-sm text-gray-700 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" 
                                   name="search" 
                                   placeholder="Enter name, phone, email, or postcode..." 
                                   autocomplete="off" 
                                   required>
                            <button type="submit" class="absolute right-1 top-1 bottom-1 px-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md transition-colors flex items-center justify-center">
                                <i class="material-icons text-sm">search</i>
                            </button>
                        </div>
                    </form>

                    {{-- Header Dropdown Menu --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full focus:outline-none">
                            <i class="material-icons">more_vert</i>
                        </button>
                        
                        {{-- Dropdown Links --}}
                        <div x-show="open" 
                             @click.away="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 z-10"
                             style="display: none;">
                            <a href="{{ route('supplier.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Add Supplier</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Table Body Section --}}
            <div class="p-5">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th class="p-3">#</th>
                                <th class="p-3">Supplier</th>
                                <th class="p-3">Phone</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Country</th>
                                <th class="p-3">City</th>
                                <th class="p-3">State</th>
                                <th class="p-3">Post Code</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                            @if($list->count() > 0)
                                @foreach($list as $key => $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="p-3">{{ ++$key }}</td>
                                    <td class="p-3 font-medium text-gray-900">{{ $item->supplier_name }}</td>
                                    <td class="p-3">{{ $item->supplier_phone }}</td>
                                    <td class="p-3">{{ $item->supplier_email }}</td>
                                    <td class="p-3">{{ $item->country }}</td>
                                    <td class="p-3">{{ $item->city }}</td>
                                    <td class="p-3">{{ $item->state }}</td>
                                    <td class="p-3">{{ $item->postcode }}</td>
                                    <td class="p-3">
                                        @if($item->status == 1)
                                            <span class="px-2.5 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">Active</span>
                                        @else
                                            <span class="px-2.5 py-1 text-xs font-medium bg-rose-100 text-rose-800 rounded-full">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="p-3 text-center">
                                        <a title="Edit Supplier" href="{{ route('supplier.edit', $item->id) }}" class="text-indigo-600 hover:text-indigo-900 transition-colors">
                                            <i class="material-icons text-base">edit</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach 
                            @else 
                                <tr>
                                    <td colspan="10" class="p-6 text-center text-gray-500 font-medium">
                                        No Data Found
                                    </td>
                                </tr>
                            @endif 
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links --}}
                <div class="mt-4 flex justify-end">
                    {{ $list->links() }}
                </div>
            </div>

        </div>
    </div>
</div>
@endsection