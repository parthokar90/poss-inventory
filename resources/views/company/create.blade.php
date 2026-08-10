@extends('admin.layouts.master')

@section('title') Dashboard | Add Company @endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Page Header Section -->
    <div class="md:flex md:items-center md:justify-between mb-6">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                COMPANY
            </h2>
        </div>
        <!-- Action Buttons -->
        <div class="mt-4 flex md:ml-4 md:mt-0 gap-x-3">
            <a href="{{ route('office.index') }}" class="inline-flex items-center rounded-md bg-white px-3.5 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 transition-colors">
                <!-- Back Icon -->
                <svg class="-ml-0.5 mr-1.5 h-5 w-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M17 10a.75.75 0 01-.75.75H5.612l4.158 3.96a.75.75 0 11-1.04 1.08l-5.5-5.25a.75.75 0 010-1.08l5.5-5.25a.75.75 0 111.04 1.08L5.612 9.25H16.25A.75.75 0 0117 10z" clip-rule="evenodd" />
                </svg>
                Back to List
            </a>
        </div>
    </div>

    <!-- Form Card Container -->
    <div class="bg-white shadow-sm ring-1 ring-gray-900/5 sm:rounded-xl overflow-hidden">
        <!-- Card Header -->
        <div class="border-b border-gray-200 px-4 py-5 sm:px-6 bg-gray-50/50">
            <h3 class="text-base font-semibold leading-6 text-gray-900">CREATE COMPANY INFORMATION</h3>
            <p class="mt-1 text-sm text-gray-500">Please fill in all required company details below.</p>
        </div>

        <!-- Form Body -->
        <div class="p-6 sm:p-8">
            <form action="{{ route('office.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Form Grid Layout -->
                <div class="grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2">

                    <!-- Company Name Field -->
                    <div>
                        <label for="company_name" class="block text-sm font-medium leading-6 text-gray-900">
                            Company Name <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="company_name" 
                                   id="company_name" 
                                   autocomplete="off" 
                                   value="{{ old('company_name') }}"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('company_name') ring-red-500 focus:ring-red-500 @enderror">
                        </div>
                        @error('company_name')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="company_email" class="block text-sm font-medium leading-6 text-gray-900">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="email" 
                                   name="company_email" 
                                   id="company_email" 
                                   autocomplete="off" 
                                   value="{{ old('company_email') }}"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('company_email') ring-red-500 focus:ring-red-500 @enderror">
                        </div>
                        @error('company_email')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Field -->
                    <div>
                        <label for="company_phone" class="block text-sm font-medium leading-6 text-gray-900">
                            Phone <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="company_phone" 
                                   id="company_phone" 
                                   autocomplete="off" 
                                   value="{{ old('company_phone') }}"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('company_phone') ring-red-500 focus:ring-red-500 @enderror">
                        </div>
                        @error('company_phone')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Country Field -->
                    <div>
                        <label for="country" class="block text-sm font-medium leading-6 text-gray-900">
                            Country <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="country" 
                                   id="country" 
                                   autocomplete="off" 
                                   value="{{ old('country') }}"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('country') ring-red-500 focus:ring-red-500 @enderror">
                        </div>
                        @error('country')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- City Field -->
                    <div>
                        <label for="company_city" class="block text-sm font-medium leading-6 text-gray-900">
                            City <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="company_city" 
                                   id="company_city" 
                                   autocomplete="off" 
                                   value="{{ old('company_city') }}"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('company_city') ring-red-500 focus:ring-red-500 @enderror">
                        </div>
                        @error('company_city')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- State Field -->
                    <div>
                        <label for="company_state" class="block text-sm font-medium leading-6 text-gray-900">
                            State <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="company_state" 
                                   id="company_state" 
                                   autocomplete="off" 
                                   value="{{ old('company_state') }}"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('company_state') ring-red-500 focus:ring-red-500 @enderror">
                        </div>
                        @error('company_state')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Postcode Field -->
                    <div>
                        <label for="company_postcode" class="block text-sm font-medium leading-6 text-gray-900">
                            Post Code <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <input type="text" 
                                   name="company_postcode" 
                                   id="company_postcode" 
                                   autocomplete="off" 
                                   value="{{ old('company_postcode') }}"
                                   class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('company_postcode') ring-red-500 focus:ring-red-500 @enderror">
                        </div>
                        @error('company_postcode')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company Logo Upload Field -->
                    <div>
                        <label for="company_logo" class="block text-sm font-medium leading-6 text-gray-900">
                            Company Logo
                        </label>
                        <div class="mt-2">
                            <input type="file" 
                                   name="company_logo" 
                                   id="company_logo" 
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors border border-gray-300 rounded-md cursor-pointer focus:outline-none">
                        </div>
                        @error('company_logo')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Address Textarea Field (Full Width) -->
                    <div class="sm:col-span-2">
                        <label for="company_address" class="block text-sm font-medium leading-6 text-gray-900">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-2">
                            <textarea name="company_address" 
                                      id="company_address" 
                                      rows="4" 
                                      maxlength="100" 
                                      class="block w-full rounded-md border-0 py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('company_address') ring-red-500 focus:ring-red-500 @enderror">{{ old('company_address') }}</textarea>
                        </div>
                        @error('company_address')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Form Action Buttons -->
                <div class="mt-8 flex items-center justify-end gap-x-4 border-t border-gray-100 pt-6">
                    <a href="{{ route('office.index') }}" class="text-sm font-semibold leading-6 text-gray-900 hover:text-gray-700">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all">
                        SAVE
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection