@php
$url = Route::currentRouteName();
@endphp

<div class="flex flex-col h-full bg-slate-900 text-slate-300">
    <div class="p-5 border-b border-slate-800 bg-slate-950/40">
        <div class="flex items-center gap-3">
            <div class="shrink-0 relative">
                <img src="{{ asset('assets/images/user.png') }}" class="w-12 h-12 rounded-full border-2 border-blue-500 object-cover bg-slate-800" alt="User" />
                <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-slate-900 rounded-full"></span>
            </div>
            <div class="flex-1 min-w-0 relative">
                <button onclick="toggleUserDropdown()" class="flex items-center gap-1 text-left w-full focus:outline-none group">
                    <span class="font-semibold text-white text-sm truncate group-hover:text-blue-400 transition-colors">
                        {{ auth()->user()->name }}
                    </span>
                    <i class="material-icons text-slate-500 text-sm group-hover:text-blue-400">keyboard_arrow_down</i>
                </button>
                <p class="text-xs text-slate-400 truncate mt-0.5">{{ auth()->user()->email }}</p>

                <div id="user-helper-dropdown" class="hidden absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-xl py-1 text-slate-700 z-50 border border-slate-100 animate-fadeIn">
                    <a href="javascript:void(0);" class="flex items-center gap-2 px-4 py-2 text-xs hover:bg-slate-50 hover:text-blue-600 font-medium">
                        <i class="material-icons text-sm text-slate-400">person</i> Profile
                    </a>
                    <hr class="border-slate-100 my-1">
                    <a href="{{ url('/logout') }}" class="flex items-center gap-2 px-4 py-2 text-xs hover:bg-rose-50 text-rose-600 font-medium">
                        <i class="material-icons text-sm text-rose-500">input</i> Sign Out
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto px-3 py-4 space-y-6 scrollbar-thin">
        <div>
            <p class="px-3 text-xxs font-bold text-slate-500 uppercase tracking-widest mb-3">Main Navigation</p>
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ $url === 'dashboard' ? 'bg-blue-600 text-white shadow-md shadow-blue-600/10' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="material-icons text-lg">home</i>
                        <span>Dashboard</span>
                    </a>
                </li>

                @php
                $isProductActive = in_array($url, ['product.index', 'product.create', 'product.edit', 'stockList', 'item_product_search', 'item_stock_search']);
                @endphp
                <li>
                    <button onclick="toggleSubMenu('menu-product')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ $isProductActive ? 'text-blue-400 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="material-icons text-lg">inventory_2</i>
                            <span>Product</span>
                        </div>
                        <i id="arrow-menu-product" class="material-icons text-sm transition-transform duration-200 {{ $isProductActive ? 'rotate-180' : '' }}">expand_more</i>
                    </button>
                    <ul id="menu-product" class="{{ $isProductActive ? 'block' : 'hidden' }} mt-1 pl-9 pr-2 space-y-1 border-l border-slate-800 ml-5">
                        <li>
                            <a href="{{ route('product.index') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'product.index' || $url === 'item_product_search' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">List</a>
                        </li>
                        <li>
                            <a href="{{ route('product.create') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'product.create' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">Add</a>
                        </li>
                        <li>
                            <a href="{{ route('stockList') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'stockList' || $url === 'item_stock_search' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">Stock Log</a>
                        </li>
                    </ul>
                </li>

                @php
                $isPurchaseActive = in_array($url, ['payment-supplier.index', 'purchase.show', 'purchase.edit', 'payment-supplier.store', 'purchase.index', 'purchase.create']);
                @endphp
                <li>
                    <button onclick="toggleSubMenu('menu-purchase')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ $isPurchaseActive ? 'text-blue-400 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="material-icons text-lg">local_mall</i>
                            <span>Purchase</span>
                        </div>
                        <i id="arrow-menu-purchase" class="material-icons text-sm transition-transform duration-200 {{ $isPurchaseActive ? 'rotate-180' : '' }}">expand_more</i>
                    </button>
                    <ul id="menu-purchase" class="{{ $isPurchaseActive ? 'block' : 'hidden' }} mt-1 pl-9 pr-2 space-y-1 border-l border-slate-800 ml-5">
                        <li>
                            <a href="{{ route('purchase.index') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'purchase.index' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">List</a>
                        </li>
                        <li>
                            <a href="{{ route('purchase.create') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'purchase.create' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">Add</a>
                        </li>
                        <li>
                            <a href="{{ route('payment-supplier.index') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'payment-supplier.index' || $url === 'payment-supplier.store' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">Supplier Payment</a>
                        </li>
                    </ul>
                </li>

                @php
                $isSalesActive = in_array($url, ['sales.index', 'sales.create', 'sales.show', 'sales.edit']);
                @endphp
                <li>
                    <button onclick="toggleSubMenu('menu-sales')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ $isSalesActive ? 'text-blue-400 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="material-icons text-lg">point_of_sale</i>
                            <span>Sales</span>
                        </div>
                        <i id="arrow-menu-sales" class="material-icons text-sm transition-transform duration-200 {{ $isSalesActive ? 'rotate-180' : '' }}">expand_more</i>
                    </button>
                    <ul id="menu-sales" class="{{ $isSalesActive ? 'block' : 'hidden' }} mt-1 pl-9 pr-2 space-y-1 border-l border-slate-800 ml-5">
                        <li>
                            <a href="{{ route('sales.index') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'sales.index' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">List</a>
                        </li>
                        <li>
                            <a href="{{ route('sales.create') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'sales.create' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">Pos Sale</a>
                        </li>
                    </ul>
                </li>

                @php
                $isExpenseActive = in_array($url, ['expense_amount.index', 'expense_amount.create', 'expense_amount.edit']);
                @endphp
                <li>
                    <button onclick="toggleSubMenu('menu-expense')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ $isExpenseActive ? 'text-blue-400 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="material-icons text-lg">payments</i>
                            <span>Expenses</span>
                        </div>
                        <i id="arrow-menu-expense" class="material-icons text-sm transition-transform duration-200 {{ $isExpenseActive ? 'rotate-180' : '' }}">expand_more</i>
                    </button>
                    <ul id="menu-expense" class="{{ $isExpenseActive ? 'block' : 'hidden' }} mt-1 pl-9 pr-2 space-y-1 border-l border-slate-800 ml-5">
                        <li>
                            <a href="{{ route('expense_amount.index') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'expense_amount.index' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">List</a>
                        </li>
                        <li>
                            <a href="{{ route('expense_amount.create') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'expense_amount.create' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">Add</a>
                        </li>
                    </ul>
                </li>

                @php
                $isQuotationActive = in_array($url, ['quotations.index', 'quotations.create']);
                @endphp
                <li>
                    <button onclick="toggleSubMenu('menu-quotation')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ $isQuotationActive ? 'text-blue-400 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="material-icons text-lg">request_quote</i>
                            <span>Quotations</span>
                        </div>
                        <i id="arrow-menu-quotation" class="material-icons text-sm transition-transform duration-200 {{ $isQuotationActive ? 'rotate-180' : '' }}">expand_more</i>
                    </button>
                    <ul id="menu-quotation" class="{{ $isQuotationActive ? 'block' : 'hidden' }} mt-1 pl-9 pr-2 space-y-1 border-l border-slate-800 ml-5">
                        <li>
                            <a href="{{ route('quotations.index') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'quotations.index' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">List</a>
                        </li>
                        <li>
                            <a href="{{ route('quotations.create') }}" class="block py-2 px-3 text-xs rounded-md font-medium transition-colors {{ $url === 'quotations.create' ? 'text-blue-400 bg-slate-800/40' : 'hover:text-white' }}">Add</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('item_stock_alert_notification') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all {{ $url === 'item_stock_alert_notification' ? 'bg-slate-800 text-blue-400 font-semibold' : 'hover:bg-slate-800 hover:text-white' }}">
                        <i class="material-icons text-lg">notifications_active</i>
                        <span>Stock Alerts</span>
                    </a>
                </li>

                @php
                $isSettingsActive = in_array($url, ['search_brands', 'search_customers', 'search_suppliers', 'search_bill', 'search_cat', 'search_ware', 'office.index', 'office.create', 'office.edit', 'supplier.index', 'supplier.create', 'supplier.edit', 'customer.index', 'customer.create', 'customer.edit', 'brand.index', 'brand.create', 'brand.edit', 'units.index', 'units.create', 'units.edit', 'attribute.index', 'attribute.create', 'attribute.edit', 'taxrate.index', 'taxrate.create', 'taxrate.edit', 'billers.index', 'billers.create', 'billers.edit', 'warehouse.index', 'warehouse.create', 'warehouse.edit', 'category.index', 'category.create', 'category.edit', 'expense.index', 'expense.create', 'expense.edit', 'search_expense_cat']);
                @endphp
                <li>
                    <button onclick="toggleSubMenu('menu-settings')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ $isSettingsActive ? 'text-blue-400 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="material-icons text-lg">settings</i>
                            <span>Settings</span>
                        </div>
                        <i id="arrow-menu-settings" class="material-icons text-sm transition-transform duration-200 {{ $isSettingsActive ? 'rotate-180' : '' }}">expand_more</i>
                    </button>
                    <ul id="menu-settings" class="{{ $isSettingsActive ? 'block' : 'hidden' }} mt-1 pl-9 pr-2 space-y-1 border-l border-slate-800 ml-5 text-slate-400 text-xs">
                        <li><a href="{{ route('office.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['office.index','office.create','office.edit'])?'text-blue-400 bg-slate-800/40':'' }}">Company</a></li>
                        <li><a href="{{ route('supplier.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['supplier.index','supplier.create','supplier.edit','search_suppliers'])?'text-blue-400 bg-slate-800/40':'' }}">Supplier</a></li>
                        <li><a href="{{ route('customer.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['customer.index','customer.create','customer.edit','search_customers'])?'text-blue-400 bg-slate-800/40':'' }}">Customer</a></li>
                        <li><a href="{{ route('brand.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['brand.index','brand.create','brand.edit','search_brands'])?'text-blue-400 bg-slate-800/40':'' }}">Brand</a></li>
                        <li><a href="{{ route('units.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['units.index','units.create','units.edit'])?'text-blue-400 bg-slate-800/40':'' }}">Units</a></li>
                        <li><a href="{{ route('attribute.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['attribute.index','attribute.create','attribute.edit'])?'text-blue-400 bg-slate-800/40':'' }}">Attributes</a></li>
                        <li><a href="{{ route('taxrate.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['taxrate.index','taxrate.create','taxrate.edit'])?'text-blue-400 bg-slate-800/40':'' }}">Tax Rates</a></li>
                        <li><a href="{{ route('billers.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['billers.index','billers.create','billers.edit','search_bill'])?'text-blue-400 bg-slate-800/40':'' }}">Billers</a></li>
                        <li><a href="{{ route('warehouse.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['warehouse.index','warehouse.create','warehouse.edit','search_ware'])?'text-blue-400 bg-slate-800/40':'' }}">Warehouses</a></li>
                        <li><a href="{{ route('category.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['category.index','category.create','category.edit','search_cat'])?'text-blue-400 bg-slate-800/40':'' }}">Categories</a></li>
                        <li><a href="{{ route('expense.index') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['expense.index','expense.create','expense.edit','search_expense_cat'])?'text-blue-400 bg-slate-800/40':'' }}">Expense Categories</a></li>
                        <li><a href="#" class="block py-1.5 px-3 rounded-md hover:text-white">Role Management</a></li>
                    </ul>
                </li>

                @php
                $isReportActive = in_array($url, ['purchase_reports_show_all', 'sale_reports_show_all', 'sale_reports_show_customer', 'product_report', 'sale_reports', 'expense_reports_date', 'product_report_generate', 'supplier_reports', 'supplier_reports_generate', 'supplier_reports_generate_payment', 'purchase_reports_show_supplier', 'purchase_reports', 'expense_reports', 'expense_reports_show', 'stock_report', 'stock_report_show', 'gross.profit', 'gross.profit_report']);
                @endphp
                <li>
                    <button onclick="toggleSubMenu('menu-reports')" class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-slate-800 hover:text-white transition-all {{ $isReportActive ? 'text-blue-400 font-semibold' : '' }}">
                        <div class="flex items-center gap-3">
                            <i class="material-icons text-lg">analytics</i>
                            <span>Reports</span>
                        </div>
                        <i id="arrow-menu-reports" class="material-icons text-sm transition-transform duration-200 {{ $isReportActive ? 'rotate-180' : '' }}">expand_more</i>
                    </button>
                    <ul id="menu-reports" class="{{ $isReportActive ? 'block' : 'hidden' }} mt-1 pl-9 pr-2 space-y-1 border-l border-slate-800 ml-5 text-slate-400 text-xs">
                        <li><a href="{{ route('stockList') }}" class="block py-1.5 px-3 rounded-md hover:text-white">Stock Report</a></li>
                        <li><a href="{{ route('purchase_reports') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['purchase_reports','purchase_reports_show_all','purchase_reports_show_supplier'])?'text-blue-400 bg-slate-800/40':'' }}">Purchase Report</a></li>
                        <li><a href="{{ route('sale_reports') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['sale_reports','sale_reports_show_all','sale_reports_show_customer'])?'text-blue-400 bg-slate-800/40':'' }}">Sales Report</a></li>
                        <li><a href="{{ route('supplier_reports') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['supplier_reports','supplier_reports_generate','supplier_reports_generate_payment'])?'text-blue-400 bg-slate-800/40':'' }}">Supplier Report</a></li>
                        <li><a href="{{ route('expense_reports') }}" class="block py-1.5 px-3 rounded-md hover:text-white {{ in_array($url, ['expense_reports','expense_reports_show','expense_reports_date'])?'text-blue-400 bg-slate-800/40':'' }}">Expense Report</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

    <div class="shrink-0">
        @include('admin.includes.footer')
    </div>
</div>

<script>
    function toggleSubMenu(menuId) {
        const menu = document.getElementById(menuId);
        const arrow = document.getElementById('arrow-' + menuId);
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden');
            menu.classList.add('block');
            arrow.classList.add('rotate-180');
        } else {
            menu.classList.add('hidden');
            menu.classList.remove('block');
            arrow.classList.remove('rotate-180');
        }
    }

    function toggleUserDropdown() {
        const dropdown = document.getElementById('user-helper-dropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close user dropdown if clicked outside
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('user-helper-dropdown');
        if (!e.target.closest('[onclick="toggleUserDropdown()"]') && !dropdown.classList.contains('hidden')) {
            dropdown.classList.add('hidden');
        }
    });
</script>