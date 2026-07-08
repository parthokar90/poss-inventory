@extends('admin.layouts.master')
@section('title') Dashboard | Product @endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    @include('admin.includes.messages')

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-700">PRODUCT INFORMATION</h2>
        <a href="{{route('product.create')}}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-200">
            + Add New Product
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto p-4">
            <table id="productTable" class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-500 uppercase text-xs tracking-wider border-b border-slate-200">
                        <th class="py-3.5 px-6 font-semibold">#</th>
                        <th class="py-3.5 px-6 font-semibold">Code</th>
                        <th class="py-3.5 px-6 font-semibold">Name</th>
                        <th class="py-3.5 px-6 font-semibold">Cost</th>
                        <th class="py-3.5 px-6 font-semibold">Price</th>
                        <th class="py-3.5 px-6 font-semibold">Category</th>
                        <th class="py-3.5 px-6 font-semibold text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($list as $key => $item)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="py-3 px-6 text-slate-500">{{ ++ $key }}</td>
                        <td class="py-3 px-6">
                            <span class="inline-block bg-slate-100 text-slate-600 text-xs font-medium px-2.5 py-1 rounded-md">{{$item->product_code}}</span>
                        </td>
                        <td class="py-3 px-6 text-slate-700 font-medium">{{$item->product_name}}</td>
                        <td class="py-3 px-6 text-slate-500">{{number_format($item->product_cost)}} Tk</td>
                        <td class="py-3 px-6 font-bold text-blue-600">{{number_format($item->product_price)}} Tk</td>
                        <td class="py-3 px-6">
                            <span class="inline-block bg-emerald-50 text-emerald-600 text-xs font-medium px-2.5 py-1 rounded-md">
                                {{ optional($item->category)->category_name ?? '—' }}
                            </span>
                        </td>
                        <td class="py-3 px-6">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{route('product.show', $item->id)}}" title="View" class="inline-flex items-center justify-center w-9 h-9 rounded-md text-slate-500 hover:bg-slate-100 transition">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{route('product.edit', $item->id)}}" title="Edit" class="inline-flex items-center justify-center w-9 h-9 rounded-md text-blue-600 hover:bg-blue-50 transition">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-10 text-slate-400">No Data Found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#productTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            language: {
                searchPlaceholder: "Search product...",
                lengthMenu: "Show _MENU_ entries",
            }
        });
    });
</script>
@endpush