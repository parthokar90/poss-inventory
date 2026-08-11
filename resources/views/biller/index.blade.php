@extends('admin.layouts.master')

@section('title', 'Biller List')

@push('css')
<!-- DataTables Tailwind Styles -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Action Button -->
    <div class="mb-6">
        <a href="{{ route('billers.create') }}" 
           class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg shadow transition-all duration-200">
            <i class="material-icons text-sm">add</i>
            <span>Add Biller</span>
        </a>
    </div>

    <!-- Main Table Card -->
    <div class="bg-white rounded-xl shadow-md border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h2 class="text-xl font-bold text-slate-800">Biller List</h2>
        </div>

        <div class="p-6 overflow-x-auto">
            <table id="myTable" class="w-full text-left border-collapse text-slate-700">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-xs font-semibold uppercase text-slate-500">
                        <th class="p-3">SL</th>
                        <th class="p-3">Image</th>
                        <th class="p-3">Company</th>
                        <th class="p-3">Name</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Vat Number</th>
                        <th class="p-3">Address</th>
                        <th class="p-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @foreach($list as $key => $item)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="p-3 font-medium">{{ $key + 1 }}</td>
                            <td class="p-3">
                                <img src="{{ asset($item->image) }}" 
                                     alt="{{ $item->name }}" 
                                     class="w-12 h-12 rounded-full object-cover border border-slate-200 shadow-sm">
                            </td>
                            <td class="p-3">{{ $item->company }}</td>
                            <td class="p-3 font-semibold text-slate-800">{{ $item->name }}</td>
                            <td class="p-3">{{ $item->phone }}</td>
                            <td class="p-3">{{ $item->email }}</td>
                            <td class="p-3">{{ $item->vat_number }}</td>
                            <td class="p-3 max-w-xs truncate">{{ $item->address }}</td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('billers.edit', $item->id) }}" 
                                       class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-lg transition-colors" 
                                       title="Edit">
                                        <i class="material-icons text-base">edit</i>
                                    </a>

                                    <form action="{{ route('billers.destroy', $item->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this biller?')" 
                                                class="p-2 text-rose-600 hover:bg-rose-50 rounded-lg transition-colors" 
                                                title="Delete">
                                            <i class="material-icons text-base">delete</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<!-- DataTables Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true,
            language: {
                emptyTable: "No billers found in the system."
            }
        });
    });
</script>
@endpush