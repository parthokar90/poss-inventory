@extends('admin.layouts.master')

@section('title') Dashboard | Sales List @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Display Alert Messages --}}
    @include('admin.includes.messages')

    {{-- Page Header --}}
    <div class="mb-6 flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Sales</h2>
        <a href="{{ route('sales.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-150">
            <i class="material-icons text-base mr-1">add</i> Add Sale
        </a>
    </div>

    {{-- Main Sales Card --}}
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        {{-- Card Header & Filter Section --}}
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-semibold text-gray-700 uppercase mb-4">Sales Information</h3>

            {{-- Filter Forms Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Filter 1: Invoice Search --}}
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <form method="get" action="{{ route('sales.index') }}" class="flex items-center gap-2">
                        <div class="flex-1">
                            <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Invoice Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Enter Invoice No" autocomplete="off" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                        </div>
                        <button type="submit" name="search_item" value="all_search" class="mt-5 p-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition shadow-sm">
                            <i class="material-icons text-lg leading-none">search</i>
                        </button>
                    </form>
                </div>

                {{-- Filter 2: Customer & Single Date Search --}}
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <form method="get" action="{{ route('sales.index') }}">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-2">
                            <div>
                                <label for="customer_id" class="block text-xs font-semibold text-gray-500 uppercase mb-1">Customer</label>
                                <select name="customer_id" id="customer_id" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                                    <option value="">Select Customer</option>
                                    @foreach($customer as $customers)
                                        <option value="{{ $customers->id }}" @selected(request('customer_id') == $customers->id)>
                                            ({{ $customers->customer_phone }}) - {{ $customers->customer_name }}
                                        </option>
                                    @endforeach  
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Date</label>
                                <input type="date" name="sale_date" value="{{ request('sale_date', date('Y-m-d')) }}" autocomplete="off" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" name="search_item" value="customer_search" class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-1">
                                <i class="material-icons text-base">search</i> Filter
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Filter 3: Date Range Search --}}
                <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                    <form method="get" action="{{ route('sales.index') }}">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-2">
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">Start Date</label>
                                <input type="date" name="start" value="{{ request('start', date('Y-m-01')) }}" autocomplete="off" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-500 uppercase mb-1">End Date</label>
                                <input type="date" name="end" value="{{ request('end', date('Y-m-t')) }}" autocomplete="off" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" name="search_item" value="date_search" class="px-4 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-1">
                                <i class="material-icons text-base">search</i> Range Search
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        {{-- Card Body: Sales Table --}}
        <div class="p-6">
            <div class="overflow-x-auto rounded-lg border border-gray-200">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-100 text-xs font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Invoice</th>
                            <th class="px-4 py-3">Discount %</th>
                            <th class="px-4 py-3">Vat %</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Biller</th>
                            <th class="px-4 py-3">Sale Date</th>
                            <th class="px-4 py-3">Sale By</th>
                            <th class="px-4 py-3">Total Sale</th>
                            <th class="px-4 py-3">Total Payment</th>
                            <th class="px-4 py-3">Total Due</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @if($list->count() > 0)
                            @foreach($list as $key => $item)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ ++$key }}</td>
                                <td class="px-4 py-3 font-semibold text-amber-600">Invoice-{{ $item->id }}</td>
                                <td class="px-4 py-3">{{ $item->sale_discount }}%</td>
                                <td class="px-4 py-3">{{ $item->sale_vat }}%</td>
                                <td class="px-4 py-3">{{ optional($item->customers)->customer_name }}</td>
                                <td class="px-4 py-3">{{ optional($item->billers)->company }}</td>
                                <td class="px-4 py-3 whitespace-nowrap">{{ $item->sale_date }}</td>
                                <td class="px-4 py-3">{{ optional($item->user)->name }}</td>
                                <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap">{{ number_format($item->total_price) }} Tk</td>
                                <td class="px-4 py-3 font-medium text-emerald-600 whitespace-nowrap">{{ number_format($item->total_payment) }} Tk</td>
                                <td class="px-4 py-3 font-medium text-rose-600 whitespace-nowrap">{{ number_format($item->total_due) }} Tk</td>
                                <td class="px-4 py-3 text-center whitespace-nowrap">
                                    <div class="flex justify-center items-center gap-2">
                                        <a title="View Sales Item" href="{{ route('sales.show', $item->id) }}" class="p-1 text-gray-500 hover:text-indigo-600 transition">
                                            <i class="material-icons text-xl">visibility</i>
                                        </a>
                                        <a title="Edit Sales Item" href="{{ route('sales.edit', $item->id) }}" class="p-1 text-gray-500 hover:text-emerald-600 transition">
                                            <i class="material-icons text-xl">edit</i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach 
                        @else 
                            <tr>
                                <td colspan="12" class="px-4 py-8 text-center text-gray-500 font-medium">
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

{{-- Scripts Section --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 dropdown
        $("#customer_id").select2({
            width: '100%'
        });
    });
</script>   
@endsection