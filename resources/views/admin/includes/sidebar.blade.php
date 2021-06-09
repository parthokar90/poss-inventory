         <aside id="leftsidebar" class="sidebar">
            <div class="user-info">
                <div class="image">
                    <img src="{{asset('assets/images/user.png')}}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{auth()->user()->name}}</div>
                    <div class="email">{{auth()->user()->email}}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            
                            <li role="separator" class="divider"></li>
                            <li><a href="{{url('/logout')}}"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu">
             @php $url=Route::currentRouteName();  @endphp
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li @if($url==='dashboard') class="active" @endif>
                        <a href="{{route('dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    <li @if($url==='product.index' || $url==='product.create' || $url==='product.edit' || $url==='stockList' || $url==='item_product_search' || $url==='item_stock_search') class="active" @endif>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Product</span>
                        </a>
                        <ul class="ml-menu">
                            <li @if($url==='product.index' || $url==='item_product_search') class="active" @endif>
                                <a href="{{route('product.index')}}">List</a>
                            </li>
                             <li @if($url==='product.create') class="active" @endif>
                                <a href="{{route('product.create')}}">Add</a>
                            </li>
                             <li @if($url==='stockList' || $url==='item_stock_search') class="active" @endif>
                                <a href="{{route('stockList')}}">Stock</a>
                            </li>
                        </ul>
                    </li>
                    <li @if($url==='payment-supplier.index' || $url==='purchase.show' || $url==='purchase.edit' || $url==='payment-supplier.store' || $url==='purchase.index' || $url==='purchase.create') class="active" @endif>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Purchase</span>
                        </a>
                        <ul class="ml-menu">
                            <li @if($url==='purchase.index') class="active" @endif>
                                <a href="{{route('purchase.index')}}">List</a>
                             </li>
                             <li @if($url==='purchase.create') class="active" @endif>
                                <a href="{{route('purchase.create')}}">Add</a>
                            </li>
                            <li @if($url==='payment-supplier.index' || $url==='payment-supplier.store') class="active" @endif>
                                <a href="{{route('payment-supplier.index')}}">Supplier Payment</a>
                            </li>
                        </ul>
                    </li>
                     <li @if($url==='sales.index' || $url==='sales.create' || $url==='sales.show' || $url==='sales.edit') class="active" @endif>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Sales</span>
                        </a>
                        <ul class="ml-menu">
                            <li @if($url==='sales.index') class="active" @endif>
                                <a href="{{route('sales.index')}}">List</a>
                            </li>
                             <li @if($url==='sales.create') class="active" @endif>
                                <a href="{{route('sales.create')}}">Pos Sale</a>
                            </li>
                        </ul>
                    </li>
                    <li @if($url==='expense_amount.index' || $url==='expense_amount.create' || $url==='expense_amount.edit') class="active" @endif>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Expenses</span>
                        </a>
                        <ul class="ml-menu">
                            <li @if($url==='expense_amount.index') class="active" @endif>
                                <a href="{{route('expense_amount.index')}}">List</a>
                            </li>
                             <li @if($url==='expense_amount.create') class="active" @endif>
                                <a href="{{route('expense_amount.create')}}">Add</a>
                            </li>
                        </ul>
                    </li>
                     <li @if($url==='quotations.index' || $url==='quotations.create') class="active" @endif>
                        <a @if($url==='quotations.index' || $url==='quotations.create') class="active" @endif href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Quotations</span>
                        </a>
                        <ul class="ml-menu">
                            <li @if($url==='quotations.index') class="active" @endif>
                                <a href="{{route('quotations.index')}}">List</a>
                            </li>
                             <li @if($url==='quotations.create') class="active" @endif>
                                <a href="{{route('quotations.create')}}">Add</a>
                            </li>
                        </ul>
                    </li>
                    <li @if($url==='item_stock_alert_notification') class="active" @endif>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Notification</span>
                        </a>
                        <ul class="ml-menu">
                            <li @if($url==='item_stock_alert_notification') class="active" @endif>
                                <a href="{{route('item_stock_alert_notification')}}">List</a>
                            </li>
                        </ul>
                    </li>
                    <li @if($url==='search_brands' || $url==='search_customers' || $url==='search_suppliers' || $url==='search_bill' || $url==='search_bill' || $url==='search_cat' || $url==='search_ware' || $url==='office.index' || $url==='office.create' || $url==='office.edit' || $url==='supplier.index' || $url==='supplier.create' || $url==='supplier.edit' || $url==='customer.index' || $url==='customer.create' || $url==='customer.edit' || $url==='brand.index' || $url==='brand.create' || $url==='brand.edit'  || $url==='units.index' || $url==='units.create' || $url==='units.edit' || $url==='attribute.index' || $url==='attribute.create' || $url==='attribute.edit' || $url==='taxrate.index' || $url==='taxrate.create' || $url==='taxrate.edit' || $url==='billers.index' || $url==='billers.create' || $url==='billers.edit'  || $url==='warehouse.index' || $url==='warehouse.create' || $url==='warehouse.edit' || $url==='category.index' || $url==='category.create' || $url==='category.edit' || $url==='expense.index' || $url==='expense.create' || $url==='expense.edit' || $url==='search_expense_cat') class="active" @endif>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Settings</span>
                        </a>
                        <ul class="ml-menu">
                            <li @if($url==='office.index' || $url==='office.create' || $url==='office.edit') class="active" @endif>
                                <a href="{{route('office.index')}}">Company</a>
                            </li>
                            <li @if($url==='search_suppliers' || $url==='supplier.index' || $url==='supplier.create' || $url==='supplier.edit') class="active" @endif>
                                <a href="{{route('supplier.index')}}">Supplier</a>
                            </li>
                            <li @if($url==='search_customers' || $url==='customer.index' || $url==='customer.create' || $url==='customer.edit') class="active" @endif>
                                <a href="{{route('customer.index')}}">Customer</a>
                            </li>
                            <li @if($url==='search_brands' || $url==='brand.index' || $url==='brand.create' || $url==='brand.edit') class="active" @endif>
                                <a href="{{route('brand.index')}}">Brand</a>
                            </li>
                             <li @if($url==='units.index' || $url==='units.create' || $url==='units.edit') class="active" @endif>
                                <a href="{{route('units.index')}}">Units</a>
                            </li>
                             <li @if($url==='attribute.index' || $url==='attribute.create' || $url==='attribute.edit') class="active" @endif>
                                <a href="{{route('attribute.index')}}">Attributes</a>
                            </li>
                             <li @if($url==='taxrate.index' || $url==='taxrate.create' || $url==='taxrate.edit') class="active" @endif>
                                <a href="{{route('taxrate.index')}}">Tax Rates</a>
                            </li>
                             <li @if($url==='search_bill' || $url==='billers.index' || $url==='billers.create' || $url==='billers.edit') class="active" @endif>
                                <a href="{{route('billers.index')}}">Billers</a>
                            </li>
                             <li @if($url==='warehouse.index' || $url==='warehouse.create' || $url==='warehouse.edit' || $url==='search_ware') class="active" @endif>
                                <a href="{{route('warehouse.index')}}">Warehouses</a>
                            </li>
                             <li @if($url==='search_cat' || $url==='category.index' || $url==='category.create' || $url==='category.edit') class="active" @endif>
                                <a href="{{route('category.index')}}">Categories</a>
                            </li>
                             <li @if($url==='expense.index' || $url==='expense.create' || $url==='expense.edit' || $url==='search_expense_cat') class="active" @endif>
                                <a href="{{route('expense.index')}}">Expanse Categories</a>
                            </li>
                             <li>
                                <a href="#">Role Management</a>
                            </li>
                        </ul>
                    </li> 

                    <li @if($url==='purchase_reports_show_all' || $url==='sale_reports_show_all' || $url==='sale_reports_show_customer' || $url==='product_report' || $url==='sale_reports' || $url==='expense_reports_date' || $url==='product_report_generate' || $url==='supplier_reports' || $url==='supplier_reports_generate' || $url==='supplier_reports_generate_payment' || $url==='purchase_reports_show_supplier' || $url==='purchase_reports' || $url==='expense_reports' || $url==='expense_reports_show' || $url==='stock_report' || $url==='stock_report_show' || $url==='gross.profit' || $url==='gross.profit_report') class="active" @endif>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">assignment</i>
                            <span>Report</span>
                        </a>
                        <ul class="ml-menu">
                             <li>
                                <a href="{{route('stockList')}}">Stock</a>
                            </li>
                            <li @if($url==='purchase_reports_show_all' || $url==='purchase_reports_show_supplier' || $url==='purchase_reports' || $url==='purchase_reports_show') class="active" @endif>
                                <a href="{{route('purchase_reports')}}">Purchase</a>
                            </li>
                            <li @if($url==='sale_reports_show_all' || $url==='sale_reports_show_all' || $url==='sale_reports_show_customer' || $url==='sale_reports' || $url==='sale_reports_show') class="active" @endif>
                                <a href="{{route('sale_reports')}}">Sales</a>
                            </li>
                             <li @if($url==='supplier_reports' || $url==='supplier_report_generate' || $url==='supplier_reports_generate' || $url==='supplier_reports_generate_payment') class="active" @endif>
                                <a href="{{route('supplier_reports')}}">Supplier</a>
                            </li>
                             {{-- <li>
                                <a href="pages/forms/basic-form-elements.html">Customer</a>
                            </li> --}}
                             <li @if($url==='expense_reports' || $url==='expense_reports_show' || $url==='expense_reports_date' ) class="active" @endif>
                                <a href="{{route('expense_reports')}}">Expense</a>
                            </li>
                             {{-- <li @if($url==='gross.profit' || $url==='gross.profit_report') class="active" @endif>
                                <a href="{{route('gross.profit')}}">Gross Profit</a>
                            </li> --}}
                        </ul>
                    </li>
              </div>
            <!-- Footer -->
             @include('admin.includes.footer')
            <!-- #Footer -->
        </aside>