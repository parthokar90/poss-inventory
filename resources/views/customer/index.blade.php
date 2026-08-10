@extends('admin.layouts.master')

@section('title') Dashboard | Customer @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Flash Messages --}}
    @include('admin.includes.messages')

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Customer</h2>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        
        <!-- Card Header & Actions -->
        <div class="p-5 bg-gray-50 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Customer Information</h2>
            
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <!-- Search Form -->
                <form method="GET" action="{{ route('customer.index') }}" class="flex items-center w-full sm:w-auto">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Enter name, phone, email or postcode" 
                        autocomplete="off" 
                        required
                        class="w-full sm:w-64 px-3 py-1.5 text-sm border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500"
                    >
                    <button 
                        type="submit" 
                        class="px-3 py-1.5 bg-emerald-600 text-white rounded-r-md hover:bg-emerald-700 transition duration-150 flex items-center justify-center"
                        title="Search"
                    >
                        <i class="material-icons text-sm">search</i>
                    </button>
                </form>

                <!-- Navigation Actions -->
                <div>
                    <a 
                        href="{{ route('customer.create') }}" 
                        class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition duration-150"
                    >
                        + Add Customer
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Table -->
        <div class="body p-5">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-left text-sm text-gray-600">
                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs font-semibold">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Phone</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Country</th>
                            <th class="px-4 py-3">City</th>
                            <th class="px-4 py-3">State</th>
                            <th class="px-4 py-3">Post Code</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @if($list->count() > 0)
                            @foreach($list as $key => $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-4 py-3 font-medium text-gray-900">{{ ++$key }}</td>
                                <td class="px-4 py-3">{{ $item->customer_name }}</td>
                                <td class="px-4 py-3">{{ $item->customer_phone }}</td>
                                <td class="px-4 py-3">{{ $item->customer_email }}</td>
                                <td class="px-4 py-3">{{ $item->country }}</td>
                                <td class="px-4 py-3">{{ $item->city }}</td>
                                <td class="px-4 py-3">{{ $item->state }}</td>
                                <td class="px-4 py-3">{{ $item->postcode }}</td>
                                <td class="px-4 py-3">
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
                                <td class="px-4 py-3 text-center">
                                    <a 
                                        title="Edit customer" 
                                        href="{{ route('customer.edit', $item->id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 inline-block"
                                    >
                                        <i class="material-icons">edit</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach 
                        @else 
                            <tr>
                                <td colspan="10" class="px-4 py-6 text-center text-gray-500 font-medium">
                                    No Data Found
                                </td>
                            </tr>
                        @endif 
                    </tbody>
                </table>
            </div>

            <!-- Pagination Container -->
            <div class="mt-4 flex justify-end">
                {{ $list->links() }}
            </div>
        </div>

    </div>
</div>
@endsection