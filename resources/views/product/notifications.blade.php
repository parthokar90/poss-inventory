@extends('admin.layouts.master')

@section('title') Dashboard | Notifications @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Display alert/notification messages --}}
    @include('admin.includes.messages')

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Notifications</h1>
    </div>

    {{-- Main Content Card --}}
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        {{-- Card Header --}}
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Stock Alert Notifications</h2>
        </div>

        {{-- Table Container --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold uppercase tracking-wider text-gray-600">
                        <th class="py-3 px-4">#</th>
                        <th class="py-3 px-4">Product</th>
                        <th class="py-3 px-4">Warehouse</th>
                        <th class="py-3 px-4">Stock</th>
                        <th class="py-3 px-4">Alert Quantity</th>
                        <th class="py-3 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    @if($alert_notify->count() > 0)
                        @foreach($alert_notify as $key => $notifications)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            <td class="py-3 px-4">{{ ++$key }}</td>
                            <td class="py-3 px-4 font-medium text-gray-900">
                                {{ $notifications->Products->product_name ?? 'N/A' }} 
                                <span class="text-xs text-gray-500 font-normal">
                                    {{ optional($notifications->Varient)->varient_name }}
                                </span>
                            </td>
                            <td class="py-3 px-4">{{ optional($notifications->Warehouses)->name ?? 'N/A' }}</td>
                            <td class="py-3 px-4 font-semibold text-red-600">{{ $notifications->qty }}</td>
                            <td class="py-3 px-4 text-gray-500">{{ $notifications->alert_qty }}</td>
                            <td class="py-3 px-4 text-center">
                                <a href="{{ route('product.edit', $notifications->product_id) }}" title="Edit Product" class="inline-block p-1 text-blue-600 hover:text-blue-800 rounded transition duration-150">
                                    {{-- Edit Icon --}}
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach 
                    @else 
                        <tr>
                            <td colspan="6" class="py-6 text-center text-gray-500 font-medium">No Data Found</td>
                        </tr>
                    @endif 
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        <div class="p-4 border-t border-gray-200 flex justify-end">
            {{ $alert_notify->links() }}
        </div>
    </div>
</div>
@endsection