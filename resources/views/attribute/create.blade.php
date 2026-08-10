{{-- Attribute Create View --}}
@extends('admin.layouts.master')

@section('title') Dashboard | Add Attribute @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Attribute</h1>
    </div>

    {{-- Create Form Card --}}
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        
        {{-- Card Header & Navigation Buttons --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Create Attribute Information</h2>
            <div class="flex items-center gap-2">
                <a 
                    href="{{ route('attribute.index') }}" 
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition duration-150"
                >
                    List
                </a>
                <a 
                    href="{{ route('attribute.create') }}" 
                    class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition duration-150"
                >
                    Add
                </a>
            </div>
        </div>

        {{-- Card Body: Create Form --}}
        <div class="p-6">
            <form action="{{ route('attribute.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Attribute Name Field --}}
                <div>
                    <label for="varient_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Attribute Name <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="varient_name"
                        name="varient_name" 
                        value="{{ old('varient_name') }}"
                        autocomplete="off"
                        placeholder="Enter attribute name (e.g. Color, Size)"
                        class="w-full px-4 py-2 border @error('varient_name') border-red-500 @else border-gray-300 @enderror rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    >
                    @if($errors->has('varient_name'))
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $errors->first('varient_name') }}</p>
                    @endif
                </div>

                {{-- Submit Button --}}
                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg shadow-sm transition duration-150 ease-in-out uppercase tracking-wider"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection