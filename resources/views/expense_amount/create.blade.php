@extends('admin.layouts.master')

@section('title', 'Dashboard | Add Expense')

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Expense</h1>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden max-w-4xl mx-auto">
        
        <!-- Card Header Section -->
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Create Expense Information</h2>
            
            <!-- Navigation Actions -->
            <div class="flex items-center gap-2">
                <a href="{{ route('expense_amount.index') }}" 
                   class="inline-flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium px-4 py-2 rounded-md transition-colors shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                    </svg>
                    Expense List
                </a>
            </div>
        </div>

        <!-- Form Body Section -->
        <div class="p-6">
            <form action="{{ route('expense_amount.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf 

                <!-- Expense Date Field -->
                <div>
                    <label for="expense_date" class="block text-sm font-medium text-gray-700 mb-1">
                        Expense Date <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           id="expense_date" 
                           name="expense_date" 
                           autocomplete="off" 
                           value="{{ old('expense_date', date('Y-m-d')) }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2 px-3 border @error('expense_date') border-red-500 @enderror">
                    @error('expense_date')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expense Category Field -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Expense Category <span class="text-red-500">*</span>
                    </label>
                    <select id="category_id" 
                            name="category_id" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2 px-3 border @error('category_id') border-red-500 @enderror">
                        <option value="">Select Category</option>
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Warehouse Field -->
                <div>
                    <label for="warehouse_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Warehouse
                    </label>
                    <select id="warehouse_id" 
                            name="warehouse_id" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2 px-3 border @error('warehouse_id') border-red-500 @enderror">
                        <option value="">Select Warehouse</option>
                        @foreach($warehouse as $ware)
                            <option value="{{ $ware->id }}" {{ old('warehouse_id') == $ware->id ? 'selected' : '' }}>
                                {{ $ware->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('warehouse_id')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Expense Amount Field -->
                <div>
                    <label for="expense_amount" class="block text-sm font-medium text-gray-700 mb-1">
                        Expense Amount <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="expense_amount" 
                           name="expense_amount" 
                           step="0.01"
                           autocomplete="off" 
                           placeholder="0.00"
                           value="{{ old('expense_amount') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2 px-3 border @error('expense_amount') border-red-500 @enderror">
                    @error('expense_amount')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Attachment Upload Field -->
                <div>
                    <label for="expense_attachment" class="block text-sm font-medium text-gray-700 mb-1">
                        Expense Attachment
                    </label>
                    <input type="file" 
                           id="expense_attachment" 
                           name="expense_attachment" 
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-md p-1">
                    @error('expense_attachment')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Note / Description Field -->
                <div>
                    <label for="note" class="block text-sm font-medium text-gray-700 mb-1">
                        Note
                    </label>
                    <textarea id="note" 
                              name="note" 
                              rows="4" 
                              maxlength="100" 
                              placeholder="Write a brief note (max 100 characters)..."
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm py-2 px-3 border resize-none @error('note') border-red-500 @enderror">{{ old('note') }}</textarea>
                    @error('note')
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Form Submit Action -->
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm px-6 py-2.5 rounded-md transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Save Expense
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
@endsection