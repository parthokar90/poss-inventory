{{-- Tax Rate Create View --}}
@extends('admin.layouts.master')

@section('title') Dashboard | Add Tax Rate @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Tax Rate</h1>
    </div>

    {{-- Create Form Card --}}
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        
        {{-- Card Header & Navigation Buttons --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Create Tax Rate Information</h2>
            <div class="flex items-center gap-2">
                <a 
                    href="{{ route('taxrate.index') }}" 
                    class="px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md transition duration-150"
                >
                    List
                </a>
                <a 
                    href="{{ route('taxrate.create') }}" 
                    class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition duration-150"
                >
                    Add
                </a>
            </div>
        </div>

        {{-- Card Body: Create Form --}}
        <div class="p-6">
            <form action="{{ route('taxrate.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Tax Rate Name Field --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Tax Rate *
                    </label>
                    <input 
                        type="text" 
                        id="name"
                        name="name" 
                        value="{{ old('name') }}"
                        autocomplete="off"
                        placeholder="Enter tax rate name"
                        class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    >
                    @if($errors->has('name'))
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                {{-- Type Field --}}
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                    <select 
                        id="type"
                        name="type" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-800 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    >
                        <option value="0" {{ old('type') == '0' ? 'selected' : '' }}>Fixed</option>
                        <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>Percentage</option>
                    </select>
                </div>

                {{-- Rate Field --}}
                <div>
                    <label for="rate" class="block text-sm font-medium text-gray-700 mb-1">
                        Rate *
                    </label>
                    <input 
                        type="text" 
                        id="rate"
                        name="rate" 
                        value="{{ old('rate') }}"
                        autocomplete="off"
                        placeholder="Enter rate amount"
                        class="w-full px-4 py-2 border @error('rate') border-red-500 @else border-gray-300 @enderror rounded-lg text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-150"
                    >
                    @if($errors->has('rate'))
                        <p class="mt-1 text-xs text-red-600 font-medium">{{ $errors->first('rate') }}</p>
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