@extends('admin.layouts.master')
@section('title') Dashboard | Expense Report @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    @include('admin.includes.messages')

    <!-- Header Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Expense</h2>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Expense Report</h2>

            <!-- Action Dropdown -->
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none p-1 rounded-full hover:bg-gray-200 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10" style="display: none;">
                    <div class="py-1">
                        <a href="{{ route('units.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Add</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            
            <!-- Filter Form Section -->
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-200 mb-8">
                <form method="post" action="{{ route('expense_reports_date') }}">
                    @csrf 
                    <!-- Date Input Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <!-- Start Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" type="date" name="start" value="{{ date('Y-m-d') }}">
                        </div>

                        <!-- End Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" type="date" name="end" value="{{ date('Y-m-t') }}"> 
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-sm transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search
                        </button>

                        <button type="submit" name="pdf" value="pdf_download" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-sm transition">
                            Download PDF
                        </button>
                    </div> 
                </form>
            </div>

            <!-- Company Header Info Block -->
            <div class="text-center my-8 p-6 bg-white rounded-lg border border-gray-100 shadow-sm">
                <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide mb-1">{{ $company->company_name }}</h1>
                <p class="text-sm text-gray-600">{{ $company->company_email }}</p>
                <p class="text-sm text-gray-600">{{ $company->company_phone }}</p>
                <p class="text-sm text-gray-600 mb-3">{{ $company->company_address }}</p>
                
                <div class="inline-block border-t border-gray-200 pt-3 mt-1">
                    <span class="text-base font-semibold text-gray-700 block uppercase">Expense Report</span>
                    <span class="inline-block mt-1 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium">
                        From {{ date('d-m-Y', strtotime($start)) }} To {{ date('d-m-Y', strtotime($end)) }}
                    </span>
                </div>
            </div>

            <!-- Report Table Container -->
            <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold tracking-wider">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Expense Date</th>
                            <th scope="col" class="px-6 py-3">Warehouse</th>
                            <th scope="col" class="px-6 py-3">Category</th>
                            <th scope="col" class="px-6 py-3">Amount</th>
                            <th scope="col" class="px-6 py-3">Expense By</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @php $total_expense = 0; @endphp
                        @foreach($data as $key => $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 font-medium">{{ ++$key }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ date('d-m-Y', strtotime($item->expense_date)) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $item->Warehouses->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $item->ExpenseCategorys->category_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-800 font-semibold">
                                {{ number_format($item->expense_amount) }} Tk 
                                @php $total_expense += $item->expense_amount; @endphp
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $item->users->name }}</td>
                        </tr>
                        @endforeach   
                    </tbody>
                    <tfoot class="bg-gray-100 font-bold text-gray-800 border-t-2 border-gray-300">
                        <tr>
                            <td colspan="4" class="px-6 py-3 text-right uppercase tracking-wider text-xs">Total Expense:</td>
                            <td class="px-6 py-3 text-green-700 text-base font-extrabold">{{ number_format($total_expense) }} Tk</td>
                            <td class="px-6 py-3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection