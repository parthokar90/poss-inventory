@extends('admin.layouts.master')

@section('title') Dashboard | Company @endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <!-- Flash Messages Section -->
    @include('admin.includes.messages')

    <!-- Page Header Section -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                COMPANY
            </h2>
        </div>
        <div class="mt-4 flex md:ml-4 md:mt-0">
            <!-- Add Button: Displayed only if company data is not set -->
            @if(!isset($list))
                <a href="{{ route('office.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
                    <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Company
                </a>
            @endif
        </div>
    </div>

    <!-- Company Information Card -->
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6 bg-gray-50/50">
            <h3 class="text-base font-semibold leading-6 text-gray-900">COMPANY INFORMATION</h3>
        </div>

        <div class="p-4 sm:p-6">
            <!-- Responsive Table Wrapper -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-300 text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="py-3.5 pl-4 pr-3 text-xs font-semibold text-gray-900 sm:pl-6 uppercase tracking-wider">#</th>
                            <th scope="col" class="px-3 py-3.5 text-xs font-semibold text-gray-900 uppercase tracking-wider">Company</th>
                            <th scope="col" class="px-3 py-3.5 text-xs font-semibold text-gray-900 uppercase tracking-wider">Phone</th>
                            <th scope="col" class="px-3 py-3.5 text-xs font-semibold text-gray-900 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-3 py-3.5 text-xs font-semibold text-gray-900 uppercase tracking-wider">Logo</th>
                            <th scope="col" class="px-3 py-3.5 text-xs font-semibold text-gray-900 uppercase tracking-wider">Country</th>
                            <th scope="col" class="px-3 py-3.5 text-xs font-semibold text-gray-900 uppercase tracking-wider">City</th>
                            <th scope="col" class="px-3 py-3.5 text-xs font-semibold text-gray-900 uppercase tracking-wider">State</th>
                            <th scope="col" class="px-3 py-3.5 text-xs font-semibold text-gray-900 uppercase tracking-wider">Post Code</th>
                            <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-xs font-semibold text-gray-900 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @if(isset($list))
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <!-- Index Number -->
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>

                                <!-- Company Name -->
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700 font-medium">
                                    {{ $list->company_name ?? 'N/A' }}
                                </td>

                                <!-- Company Phone -->
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $list->company_phone ?? 'N/A' }}
                                </td>

                                <!-- Company Email -->
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $list->company_email ?? 'N/A' }}
                                </td>

                                <!-- Company Logo -->
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    @if(isset($list->company_logo) && $list->company_logo)
                                        <img class="h-12 w-24 object-contain rounded border border-gray-200 bg-gray-50 p-1" 
                                             src="{{ asset('company_logo/'.$list->company_logo) }}" 
                                             alt="Company Logo">
                                    @else
                                        <span class="inline-flex items-center rounded-md bg-gray-50 px-2 py-1 text-xs font-medium text-gray-600 ring-1 ring-inset ring-gray-500/10">No Logo</span>
                                    @endif
                                </td>

                                <!-- Country -->
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $list->country ?? 'N/A' }}
                                </td>

                                <!-- City -->
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $list->company_city ?? 'N/A' }}
                                </td>

                                <!-- State -->
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $list->company_state ?? 'N/A' }}
                                </td>

                                <!-- Postcode -->
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{ $list->company_postcode ?? 'N/A' }}
                                </td>

                                <!-- Action Buttons -->
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <a href="{{ route('office.edit', $list->id) }}" title="Edit Company" class="inline-flex items-center gap-x-1 text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-2.5 py-1.5 rounded-md transition-colors">
                                        <!-- Edit SVG Icon -->
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        <span>Edit</span>
                                    </a>
                                </td>
                            </tr>
                        @else
                            <!-- Empty State View -->
                            <tr>
                                <td colspan="10" class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                    <h3 class="mt-2 text-sm font-semibold text-gray-900">No company details found</h3>
                                    <p class="mt-1 text-sm text-gray-500">Get started by creating your company information.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('office.create') }}" class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                            Add Company Info
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endif 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection