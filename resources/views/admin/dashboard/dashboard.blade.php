@extends('admin.layouts.master')
@section('title') Dashboard | Inventory @endsection
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="p-6 max-w-[1600px] mx-auto space-y-8 animate-fadeIn">

    <div class="flex items-center justify-between border-b border-slate-200 pb-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Dashboard</h1>
            <p class="text-sm text-slate-500 mt-0.5">Welcome back! Here's an overview of your inventory system today.</p>
        </div>
        <div class="text-sm text-slate-500 font-medium bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
            Date: <span class="text-slate-800 font-semibold">{{ date('d M, Y') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 group">
            <div class="w-12 h-12 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                <i class="material-icons text-2xl">group</i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Users</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($total_users) }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 group">
            <div class="w-12 h-12 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                <i class="material-icons text-2xl">inventory_2</i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Products</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($total_product) }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 group">
            <div class="w-12 h-12 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-all duration-300">
                <i class="material-icons text-2xl">local_shipping</i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Suppliers</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($total_supplier) }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 group">
            <div class="w-12 h-12 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                <i class="material-icons text-2xl">assignment_ind</i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Customers</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($total_customer) }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 group">
            <div class="w-12 h-12 rounded-lg bg-sky-50 text-sky-600 flex items-center justify-center group-hover:bg-sky-600 group-hover:text-white transition-all duration-300">
                <i class="material-icons text-2xl">account_balance_wallet</i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Today Purchase</p>
                <h3 class="text-xl font-bold text-slate-800 mt-1">{{ number_format($today_purchase) }} <span class="text-xs font-semibold text-slate-500">Tk</span></h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 group">
            <div class="w-12 h-12 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center group-hover:bg-violet-600 group-hover:text-white transition-all duration-300">
                <i class="material-icons text-2xl">paid</i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Today Sales</p>
                <h3 class="text-xl font-bold text-slate-800 mt-1">{{ number_format($today_sales) }} <span class="text-xs font-semibold text-slate-500">Tk</span></h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 group">
            <div class="w-12 h-12 rounded-lg bg-slate-100 text-slate-600 flex items-center justify-center group-hover:bg-slate-700 group-hover:text-white transition-all duration-300">
                <i class="material-icons text-2xl">shopping_bag</i>
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Today Expense</p>
                <h3 class="text-xl font-bold text-slate-800 mt-1">{{ number_format($today_expense) }} <span class="text-xs font-semibold text-slate-500">Tk</span></h3>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 group">
            <div class="w-12 h-12 rounded-lg bg-fuchsia-50 text-fuchsia-600 flex items-center justify-center group-hover:bg-fuchsia-600 group-hover:text-white transition-all duration-300 relative">
                <i class="material-icons text-2xl">notifications_active</i>
                @if($total_notification > 0)
                <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-rose-500 rounded-full animate-pulse"></span>
                @endif
            </div>
            <div>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Notification</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-1">{{ number_format($total_notification) }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm lg:col-span-2">
            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wide mb-4">Sales vs Purchase Comparison</h3>
            <div class="h-[260px] flex items-center justify-center">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <h3 class="text-sm font-bold text-slate-700 uppercase tracking-wide mb-4">Financial Breakdown Today</h3>
            <div class="h-[260px] flex items-center justify-center">
                <canvas id="donutChart"></canvas>
            </div>
        </div>
    </div>

    <div class="space-y-8">
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 px-5 py-4 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                    <h2 class="font-bold text-slate-800 tracking-tight text-sm uppercase">Today Purchase List</h2>
                </div>
                <span class="text-xs bg-blue-50 text-blue-700 font-semibold px-2.5 py-1 rounded-full border border-blue-100">Live Data</span>
            </div>
            <div class="p-0">
                <div class="overflow-x-auto max-h-[350px] overflow-y-auto scrollbar-thin">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead class="bg-slate-100 text-slate-600 font-semibold sticky top-0 z-10 border-b border-slate-200 shadow-sm">
                            <tr>
                                <th class="py-3 px-4 text-center">#</th>
                                <th class="py-3 px-4">Invoice</th>
                                <th class="py-3 px-4 text-center">Discount</th>
                                <th class="py-3 px-4 text-center">Vat</th>
                                <th class="py-3 px-4">Supplier</th>
                                <th class="py-3 px-4">Purchase Date</th>
                                <th class="py-3 px-4">Purchased By</th>
                                <th class="py-3 px-4 text-right">Total Purchase</th>
                                <th class="py-3 px-4 text-right">Total Payment</th>
                                <th class="py-3 px-4 text-right">Total Due</th>
                                <th class="py-3 px-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @php $total_purchases=0; $total_payments=0; $total_dues=0; @endphp
                            @if($purchase_list->count() > 0)
                            @foreach($purchase_list as $key => $item)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4 text-center font-medium text-slate-400 text-xs">{{ ++$key }}</td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('purchase.edit', $item->id) }}" class="font-semibold text-blue-600 hover:text-blue-800 hover:underline inline-flex items-center gap-0.5">
                                        <span>Invoice-{{ $item->id }}</span>
                                        <i class="material-icons text-xs">edit</i>
                                    </a>
                                </td>
                                <td class="py-3 px-4 text-center text-xs font-medium">{{ $item->purchase_discount }} %</td>
                                <td class="py-3 px-4 text-center text-xs font-medium">{{ $item->purchase_vat }} %</td>
                                <td class="py-3 px-4 font-medium text-slate-800">{{ optional($item->suppliers)->supplier_name }}</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">{{ $item->purchase_date }}</td>
                                <td class="py-3 px-4 text-slate-600 text-xs">{{ optional($item->user)->name }}</td>
                                <td class="py-3 px-4 text-right font-semibold text-slate-900">{{ number_format($item->total_price) }} Tk</td>
                                <td class="py-3 px-4 text-right font-medium text-emerald-600">{{ number_format($item->total_payment) }} Tk</td>
                                <td class="py-3 px-4 text-right font-medium text-rose-600">{{ number_format($item->total_due) }} Tk</td>
                                <td class="py-3 px-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100">
                                        {{ $item->status }}
                                    </span>
                                </td>
                            </tr>
                            @php $total_purchases += $item->total_price; $total_payments += $item->total_payment; $total_dues += $item->total_due; @endphp
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="py-12 px-4 text-center text-slate-400 font-medium">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <i class="material-icons text-4xl text-slate-300">layers_clear</i>
                                        <span>No Data Found Today</span>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-slate-50 px-5 py-4 border-b border-slate-200 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-violet-500"></span>
                    <h2 class="font-bold text-slate-800 tracking-tight text-sm uppercase">Today Sales List</h2>
                </div>
                <span class="text-xs bg-violet-50 text-violet-700 font-semibold px-2.5 py-1 rounded-full border border-violet-100">Live Data</span>
            </div>
            <div class="p-0">
                <div class="overflow-x-auto max-h-[350px] overflow-y-auto scrollbar-thin">
                    <table class="w-full text-left border-collapse text-sm">
                        <thead class="bg-slate-100 text-slate-600 font-semibold sticky top-0 z-10 border-b border-slate-200 shadow-sm">
                            <tr>
                                <th class="py-3 px-4 text-center">#</th>
                                <th class="py-3 px-4">Invoice</th>
                                <th class="py-3 px-4 text-center">Discount</th>
                                <th class="py-3 px-4 text-center">Vat</th>
                                <th class="py-3 px-4">Customer</th>
                                <th class="py-3 px-4">Sale Date</th>
                                <th class="py-3 px-4">Sale By</th>
                                <th class="py-3 px-4 text-right">Total Sale</th>
                                <th class="py-3 px-4 text-right">Total Payment</th>
                                <th class="py-3 px-4 text-right">Total Due</th>
                                <th class="py-3 px-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-slate-700">
                            @php $total_sales=0; $total_payment_sale=0; $total_due_sale=0; @endphp
                            @if($sales_list->count() > 0)
                            @foreach($sales_list as $key => $sales_lists)
                            <tr class="hover:bg-slate-50/80 transition-colors">
                                <td class="py-3 px-4 text-center font-medium text-slate-400 text-xs">{{ ++$key }}</td>
                                <td class="py-3 px-4">
                                    <a href="{{ route('sales.edit', $sales_lists->id) }}" class="font-semibold text-blue-600 hover:text-blue-800 hover:underline inline-flex items-center gap-0.5">
                                        <span>Invoice-{{ $sales_lists->id }}</span>
                                        <i class="material-icons text-xs">edit</i>
                                    </a>
                                </td>
                                <td class="py-3 px-4 text-center text-xs font-medium">{{ $sales_lists->sale_discount }} %</td>
                                <td class="py-3 px-4 text-center text-xs font-medium">{{ $sales_lists->sale_vat }} %</td>
                                <td class="py-3 px-4 font-medium text-slate-800">{{ optional($sales_lists->customers)->customer_name }}</td>
                                <td class="py-3 px-4 text-slate-500 text-xs">{{ $sales_lists->sale_date }}</td>
                                <td class="py-3 px-4 text-slate-600 text-xs">{{ optional($sales_lists->user)->name }}</td>
                                <td class="py-3 px-4 text-right font-semibold text-slate-900">{{ number_format($sales_lists->total_price) }} Tk</td>
                                <td class="py-3 px-4 text-right font-medium text-emerald-600">{{ number_format($sales_lists->total_payment) }} Tk</td>
                                <td class="py-3 px-4 text-right font-medium text-rose-600">{{ number_format($sales_lists->total_due) }} Tk</td>
                                <td class="py-3 px-4 text-center">
                                    @if($sales_lists->status == 1)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Completed
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-100">
                                        {{ $sales_lists->status }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            @php $total_sales += $sales_lists->total_price; $total_payment_sale += $sales_lists->total_payment; $total_due_sale += $sales_lists->total_due; @endphp
                            @endforeach
                            @else
                            <tr>
                                <td colspan="11" class="py-12 px-4 text-center text-slate-400 font-medium">
                                    <div class="flex flex-col items-center justify-center gap-2">
                                        <i class="material-icons text-4xl text-slate-300">layers_clear</i>
                                        <span>No Data Found Today</span>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Dynamic values from Laravel variables
        const purchase = parseFloat("{{ $today_purchase }}") || 0;
        const sales = parseFloat("{{ $today_sales }}") || 0;
        const expense = parseFloat("{{ $today_expense }}") || 0;

        // 1. Bar Chart (Sales vs Purchase)
        const ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['Today Purchase', 'Today Sales'],
                datasets: [{
                    label: 'Amount (Tk)',
                    data: [purchase, sales],
                    backgroundColor: ['rgba(56, 189, 248, 0.85)', 'rgba(139, 92, 246, 0.85)'],
                    borderColor: ['rgb(14, 165, 233)', 'rgb(124, 58, 237)'],
                    borderWidth: 1.5,
                    borderRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // 2. Donut Chart (Financial Breakdown)
        const ctxDonut = document.getElementById('donutChart').getContext('2d');
        new Chart(ctxDonut, {
            type: 'doughnut',
            data: {
                labels: ['Purchase', 'Sales', 'Expense'],
                datasets: [{
                    data: [purchase, sales, expense],
                    backgroundColor: ['#38bdf8', '#8b5cf6', '#94a3b8'],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection