@extends('admin.layouts.master')

@section('title', 'Add New Biller')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    <!-- Card Container -->
    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
        <!-- Card Header -->
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-xl font-bold text-slate-800">Add New Biller</h2>
            <a href="{{ route('billers.index') }}" 
               class="text-sm font-medium text-slate-500 hover:text-slate-700 flex items-center gap-1">
                <i class="material-icons text-base">arrow_back</i> Back to List
            </a>
        </div>

        <!-- Form Body -->
        <div class="p-6">
            <form action="{{ route('billers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Grid Layout for Form Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Company Name -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Company <span class="text-rose-500">*</span></label>
                        <input type="text" name="company" value="{{ old('company') }}" placeholder="Enter company name" autocomplete="off"
                               class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none text-slate-800 @error('company') border-rose-500 @enderror">
                        @error('company')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Full Name -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Full Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter full name" autocomplete="off"
                               class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none text-slate-800 @error('name') border-rose-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Email Address <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" autocomplete="off"
                               class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none text-slate-800 @error('email') border-rose-500 @enderror">
                        @error('email')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Phone Number -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Phone Number <span class="text-rose-500">*</span></label>
                        <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Enter phone number" autocomplete="off"
                               class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none text-slate-800 @error('phone') border-rose-500 @enderror">
                        @error('phone')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- VAT Number -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">VAT Number</label>
                        <input type="text" name="vat_number" value="{{ old('vat_number') }}" placeholder="Enter VAT number" autocomplete="off"
                               class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none text-slate-800 @error('vat_number') border-rose-500 @enderror">
                        @error('vat_number')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Profile Image -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Profile Image <span class="text-rose-500">*</span></label>
                        <input type="file" name="image" 
                               class="w-full text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer border border-slate-300 rounded-lg p-1">
                        @error('image')
                            <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Address Field -->
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Address <span class="text-rose-500">*</span></label>
                    <textarea name="address" rows="3" placeholder="Enter physical address"
                              class="w-full px-4 py-2.5 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none text-slate-800 @error('address') border-rose-500 @enderror">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Submit Action -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-lg shadow hover:shadow-lg transition-all duration-200">
                        SAVE BILLER
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection