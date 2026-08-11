@extends('admin.layouts.master')

@section('title') Dashboard | Add Warehouse @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">WAREHOUSE</h2>
            <p class="text-sm text-slate-500">Create a new warehouse record</p>
        </div>

        <!-- Navigation Buttons -->
        <div class="flex items-center gap-2">
            <a href="{{ route('warehouse.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-medium text-sm rounded-lg transition-colors">
                <i class="material-icons text-base mr-1">list</i>
                List
            </a>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden max-w-3xl">
        <div class="p-5 border-b border-slate-100 bg-slate-50/50">
            <h3 class="text-lg font-semibold text-slate-700">CREATE WAREHOUSE INFORMATION</h3>
        </div>

        <div class="p-6">
            <form action="{{ route('warehouse.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">
                        Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           autocomplete="off"
                           class="w-full px-3.5 py-2.5 bg-white border @error('name') border-rose-500 focus:ring-rose-500 focus:border-rose-500 @else border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-1 transition-colors">
                    @error('name')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Field -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-slate-700 mb-1">
                        Phone <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="phone" 
                           name="phone" 
                           value="{{ old('phone') }}" 
                           autocomplete="off"
                           class="w-full px-3.5 py-2.5 bg-white border @error('phone') border-rose-500 focus:ring-rose-500 focus:border-rose-500 @else border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-1 transition-colors">
                    @error('phone')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">
                        Email <span class="text-rose-500">*</span>
                    </label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           autocomplete="off"
                           class="w-full px-3.5 py-2.5 bg-white border @error('email') border-rose-500 focus:ring-rose-500 focus:border-rose-500 @else border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-1 transition-colors">
                    @error('email')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Field -->
                <div>
                    <label for="address" class="block text-sm font-medium text-slate-700 mb-1">
                        Address <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="address" 
                           name="address" 
                           value="{{ old('address') }}" 
                           autocomplete="off"
                           class="w-full px-3.5 py-2.5 bg-white border @error('address') border-rose-500 focus:ring-rose-500 focus:border-rose-500 @else border-slate-300 focus:ring-indigo-500 focus:border-indigo-500 @enderror rounded-lg text-sm text-slate-800 focus:outline-none focus:ring-1 transition-colors">
                    @error('address')
                        <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Button -->
                <div class="pt-3">
                    <button type="submit" 
                            class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        SAVE WAREHOUSE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection