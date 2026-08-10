@extends('admin.layouts.master')

@section('title', 'Dashboard | Expense Amount')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Flash Messages Include -->
    @include('admin.includes.messages')

    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Expense Amount</h1>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        
        <!-- Card Header & Filter Section -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
                <h2 class="text-lg font-semibold text-gray-700 uppercase">Expense Amount Information</h2>
                
                <!-- Action Dropdown / Add Button -->
                <div class="flex justify-end">
                    <a href="{{ route('expense_amount.create') }}" 
                       class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium px-4 py-2 rounded-md transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Expense
                    </a>
                </div>
            </div>

            <!-- Search / Filter Form -->
            <form method="GET" action="{{ route('expense_amount.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 items-end">
                <!-- Expense Category Filter -->
                <div>
                    <label for="cat_id" class="block text-sm font-medium text-gray-700 mb-1">Expense Category</label>
                    <select id="cat_id" name="cat_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2 px-3 border">
                        <option value="">All Categories</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}" {{ request('cat_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Date Filter -->
                <div>
                    <label for="search_date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" 
                           id="search_date" 
                           name="search_date" 
                           value="{{ request('search_date', date('Y-m-d')) }}" 
                           autocomplete="off" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2 px-3 border">
                </div>

                <!-- Search Button -->
                <div>
                    <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-sm px-5 py-2 rounded-md transition-colors shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Search
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Body Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-left text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase font-medium text-xs tracking-wider">
                    <tr>
                        <th scope="col" class="px-6 py-3">#</th>
                        <th scope="col" class="px-6 py-3">Category</th>
                        <th scope="col" class="px-6 py-3">Amount</th>
                        <th scope="col" class="px-6 py-3">Date</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @if($list->count() > 0)
                        @foreach($list as $key => $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-500 font-medium">
                                    {{ $list->firstItem() ? $list->firstItem() + $key : ++$key }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-800">
                                    {{ optional($item->ExpenseCategorys)->category_name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">
                                    {{ number_format($item->expense_amount) }} Tk
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">
                                    {{ date('d-F-Y', strtotime($item->expense_date)) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($item->status == 1)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('expense_amount.edit', $item->id) }}" 
                                       title="Edit" 
                                       class="text-indigo-600 hover:text-indigo-900 inline-flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00-2 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach 
                    @else 
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500 font-medium">
                                No Data Found
                            </td>
                        </tr>
                    @endif 
                </tbody>
            </table>
        </div>

        <!-- Pagination Footer -->
        <div class="p-4 border-t border-gray-200">
            <div class="flex justify-end">
                {{ $list->links() }}
            </div>
        </div>

    </div>
</div>
@endsection