{{-- Unit Edit View --}}
@extends('admin.layouts.master')

@section('title') Dashboard | Edit Units @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Unit</h1>
    </div>

    {{-- Edit Form Card --}}
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        
        {{-- Card Header & Quick Navigation Links --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Edit Unit Information</h2>
            <div class="flex items-center gap-2">
                <a 
                    href="{{ route('units.index') }}" 
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition duration-150"
                >
                    List
                </a>
                <a 
                    href="{{ route('units.create') }}" 
                    class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition duration-150"
                >
                    Add
                </a>
            </div>
        </div>

        {{-- Card Body: Edit Form --}}
        <div class="p-6">
            <form action="{{ route('units.update', $edit->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                {{-- Unit Name Input --}}
                <div>
                    <label for="unit_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Unit Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="unit_name"
                        name="unit_name" 
                        value="{{ old('unit_name', $edit->unit_name) }}"
                        autocomplete="off"
                        class="w-full px-4 py-2 border @error('unit_name') border-red-500 @else border-gray-300 @enderror rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    >
                    @if($errors->has('unit_name'))
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $errors->first('unit_name') }}</p>
                    @endif
                </div>

                {{-- Unit Value Input --}}
                <div>
                    <label for="unit_value" class="block text-sm font-medium text-gray-700 mb-1">
                        Unit Value <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="unit_value"
                        name="unit_value" 
                        value="{{ old('unit_value', $edit->unit_value) }}"
                        autocomplete="off"
                        class="w-full px-4 py-2 border @error('unit_value') border-red-500 @else border-gray-300 @enderror rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    >
                    @if($errors->has('unit_value'))
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $errors->first('unit_value') }}</p>
                    @endif
                </div>

                {{-- Status Select --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select 
                        id="status"
                        name="status" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    >
                        <option value="1" {{ $edit->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $edit->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition duration-150 ease-in-out uppercase tracking-wider"
                    >
                        Update
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection