@extends('admin.layouts.master')

@section('title') Dashboard | Supplier Payment Management @endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8" x-data="supplierPayment()">
    
    <!-- Top Card: Search / Filter Section -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
            <div>
                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Supplier Payment Filter</h2>
                <p class="text-xs text-gray-500 mt-1">Select supplier and date range to view outstanding due invoices.</p>
            </div>
            <span class="px-3 py-1 bg-amber-50 text-amber-600 text-xs font-semibold rounded-full border border-amber-200">
                Due Invoices Only
            </span>
        </div>

        <form method="POST" action="{{ route('payment-supplier.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">Select Supplier <span class="text-rose-500">*</span></label>
                <select name="supplier_id" required class="w-full rounded-xl border-gray-200 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 bg-gray-50/50">
                    <option value="">-- Choose Supplier --</option>
                    @foreach($supplier as $sup)
                        <option value="{{ $sup->id }}" {{ old('supplier_id', request('supplier_id')) == $sup->id ? 'selected' : '' }}>
                            {{ $sup->supplier_name }} ({{ $sup->phone ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">From Date <span class="text-rose-500">*</span></label>
                <input type="date" name="start" value="{{ request('start', date('Y-m-01')) }}" required class="w-full rounded-xl border-gray-200 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 bg-gray-50/50">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-gray-600 mb-2">To Date <span class="text-rose-500">*</span></label>
                <input type="date" name="end" value="{{ request('end', date('Y-m-d')) }}" required class="w-full rounded-xl border-gray-200 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 bg-gray-50/50">
            </div>

            <div>
                <button type="submit" class="w-full px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-sm rounded-xl transition-all shadow-md shadow-indigo-100 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Filter Invoices
                </button>
            </div>
        </form>
    </div>

    <!-- Data Display Section -->
    @if(isset($data) && count($data) > 0)
        <!-- Supplier Summary Header -->
        <div class="bg-gradient-to-r from-indigo-900 to-slate-800 rounded-2xl p-6 text-white mb-6 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <span class="text-xs uppercase font-semibold text-indigo-300 tracking-wider">Supplier Profile</span>
                    <h3 class="text-2xl font-bold mt-1">{{ $data->first()->suppliers->supplier_name ?? 'N/A' }}</h3>
                    <p class="text-xs text-slate-300 mt-1">Phone: {{ $data->first()->suppliers->phone ?? 'N/A' }} | Email: {{ $data->first()->suppliers->email ?? 'N/A' }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md px-5 py-3 rounded-xl border border-white/10 text-right">
                    <span class="text-xs text-slate-300 block">Total Unpaid Due</span>
                    <span class="text-2xl font-extrabold text-rose-400">{{ number_format($data->sum('total_due'), 2) }} Tk</span>
                </div>
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <h3 class="font-bold text-gray-800">Pending Due Invoices ({{ count($data) }})</h3>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-500 border-b border-gray-100">
                        <tr>
                            <th class="px-5 py-3 text-center">#</th>
                            <th class="px-5 py-3">Invoice</th>
                            <th class="px-5 py-3">Date</th>
                            <th class="px-5 py-3 text-right">Total</th>
                            <th class="px-5 py-3 text-right">Paid</th>
                            <th class="px-5 py-3 text-right">Due</th>
                            <th class="px-5 py-3 text-center">Status</th>
                            <th class="px-5 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($data as $item)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                <td class="px-5 py-4 text-center text-gray-400 font-medium">{{ $loop->iteration }}</td>
                                <td class="px-5 py-4 font-bold text-indigo-600">
                                    <a href="{{ route('purchase.show', $item->id) }}" target="_blank" class="hover:underline">#INV-{{ $item->id }}</a>
                                </td>
                                <td class="px-5 py-4 text-gray-500">{{ date('d M, Y', strtotime($item->purchase_date)) }}</td>
                                <td class="px-5 py-4 text-right font-medium text-gray-800">{{ number_format($item->total_price, 2) }}</td>
                                <td class="px-5 py-4 text-right font-medium text-emerald-600">{{ number_format($item->total_payment, 2) }}</td>
                                <td class="px-5 py-4 text-right font-bold text-rose-600">{{ number_format($item->total_due, 2) }}</td>
                                <td class="px-5 py-4 text-center">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-600 border border-rose-100">
                                        {{ $item->payment_status ?? 'Due' }}
                                    </span>
                                </td>
                                <td class="px-5 py-4 text-center">
                                    <button 
                                        @click="openModal({{ json_encode($item) }})" 
                                        type="button" 
                                        class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium text-xs rounded-xl shadow-sm transition-all inline-flex items-center gap-1.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                        Pay Now
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif(request()->isMethod('post'))
        <div class="bg-white rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
            <div class="w-16 h-16 bg-amber-50 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800">No Due Invoices Found</h3>
            <p class="text-sm text-gray-500 mt-1">There are no pending payments for the selected supplier and date range.</p>
        </div>
    @endif

    <!-- Payment Modal -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            
            <!-- Backdrop -->
            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0" 
                 x-transition:enter-end="opacity-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100" 
                 x-transition:leave-end="opacity-0" 
                 @click="showModal = false" 
                 class="fixed inset-0 transition-opacity bg-gray-900/60 backdrop-blur-sm"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Content -->
            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-2xl border border-gray-100 sm:align-middle">
                
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800">Process Payment</h3>
                        <p class="text-xs text-gray-500">Invoice: <span class="font-bold text-indigo-600" x-text="'#INV-' + selectedInvoice.id"></span></p>
                    </div>
                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <!-- Invoice Breakdown -->
                <div class="my-4 p-4 bg-gray-50 rounded-xl space-y-2 text-sm border border-gray-100">
                    <div class="flex justify-between text-gray-600">
                        <span>Supplier Name:</span>
                        <span class="font-semibold text-gray-800" x-text="selectedInvoice.suppliers?.supplier_name || 'N/A'"></span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Total Invoice Amount:</span>
                        <span class="font-semibold text-gray-800" x-text="selectedInvoice.total_price + ' Tk'"></span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Already Paid:</span>
                        <span class="font-semibold text-emerald-600" x-text="selectedInvoice.total_payment + ' Tk'"></span>
                    </div>
                    <div class="flex justify-between text-gray-800 font-bold pt-2 border-t border-gray-200">
                        <span>Current Due Amount:</span>
                        <span class="text-rose-600" x-text="selectedInvoice.total_due + ' Tk'"></span>
                    </div>
                </div>

                <!-- Payment Form -->
                <form method="POST" action="{{ route('payment_supplier_update') }}">
                    @csrf
                    <input type="hidden" name="purchase_invoice_id" :value="selectedInvoice.id">
                    <input type="hidden" name="supplier_id" :value="selectedInvoice.supplier_id">

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Payment Amount (Tk) <span class="text-rose-500">*</span></label>
                            <input 
                                type="number" 
                                name="payment_amount" 
                                :max="selectedInvoice.total_due" 
                                min="1" 
                                step="any" 
                                x-model="payAmount" 
                                required 
                                class="w-full rounded-xl border-gray-300 text-lg font-bold text-gray-800 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 border p-3">
                            <span class="text-xs text-gray-400 mt-1 block">Maximum payable: <span x-text="selectedInvoice.total_due"></span> Tk</span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Payment Method</label>
                                <select name="payment_method" required class="w-full rounded-xl border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500 border p-2.5 bg-white">
                                    <option value="Cash">Cash</option>
                                    <option value="bKash">bKash</option>
                                    <option value="Bank">Bank</option>
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase text-gray-600 mb-1">Payment Date</label>
                                <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" required class="w-full rounded-xl border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500 border p-2.5">
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="mt-6 flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
                        <button @click="showModal = false" type="button" class="px-5 py-2.5 text-sm font-semibold text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-xl transition-all">
                            Cancel
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm rounded-xl shadow-md transition-all">
                            Confirm Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- Alpine.js to handle Modal state smoothly -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function supplierPayment() {
        return {
            showModal: false,
            selectedInvoice: {},
            payAmount: 0,
            openModal(invoice) {
                this.selectedInvoice = invoice;
                this.payAmount = invoice.total_due; // Pre-fill with remaining due
                this.showModal = true;
            }
        }
    }
</script>
@endsection