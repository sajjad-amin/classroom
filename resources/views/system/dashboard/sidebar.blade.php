<div id="sidebar" class="sidebar left">
    <ul class="list-sidebar bg-defoult">
        <li> <a href="{{route('dashboard')}}" class="@if(Route::is('dashboard')) active @endif"><i class="fa fa-pie-chart"></i> <span class="nav-label">Dashboard</span> </a></li>
        @can('admin')
            <li>
                <a href="#" data-toggle="collapse" data-target="#transactions" class="@if(Route::is('ecash.*') || Route::is('transactions.*')) collapsed active @endif" >
                    <i class="fa fa-credit-card-alt"></i> <span class="nav-label">E-Cash</span> <span class="fa fa-chevron-left pull-right"></span>
                </a>
                <ul class="sub-menu @if(!Route::is('ecash.*') && !Route::is('transactions.*')) collapse @endif" id="transactions">
                    <li><a href="{{route('ecash.all')}}" class="@if(Route::is('ecash.all')) active @endif"><i class="fa fa-list-ul"></i> Vendors</a></li>
                    <li><a href="{{route('transactions.all')}}" class="@if(Route::is('transactions.all')) active @endif"><i class="fa fa-rocket" aria-hidden="true"></i> Transactions</a></li>
                </ul>
            </li>

            <li>
                <a href="#" data-toggle="collapse" data-target="#category" class="@if(Route::is('category.*')) collapsed active @endif" >
                    <i class="fa fa-th-large"></i> <span class="nav-label">Categories</span> <span class="fa fa-chevron-left pull-right"></span>
                </a>
                <ul class="sub-menu @if(!Route::is('category.*')) collapse @endif" id="category">
                    <li><a href="{{route('category.all')}}" class="@if(Route::is('category.all')) active @endif"><i class="fa fa-database"></i> All Categories</a></li>
                    <li><a href="{{route('category.new')}}" class="@if(Route::is('category.new')) active @endif"><i class="fa fa-plus"></i> Add New Category</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#product" class="@if(Route::is('product.*') || Route::is('sell.products')) collapsed active @endif" >
                    <i class="fa fa-th-large"></i> <span class="nav-label">Products</span> <span class="fa fa-chevron-left pull-right"></span>
                </a>
                <ul class="sub-menu @if(!Route::is('product.*') && !Route::is('sell.*')) collapse @endif" id="product">
                    <li><a href="{{route('product.all')}}" class="@if(Route::is('product.all')) active @endif"><i class="fa fa-database"></i> All Products</a></li>
                    <li><a href="{{route('product.new')}}" class="@if(Route::is('product.new')) active @endif"><i class="fa fa-plus"></i> Add New Product</a></li>
                    <li><a href="{{route('sell.products')}}" class="@if(Route::is('sell.products')) active @endif"><i class="fa fa-usd" ></i> Sell</a></li>
                </ul>
            </li>
{{--            <li> <a href=""><i class="fa fa-file-text"></i> <span class="nav-label">Invoices</span> </a></li>--}}
{{--            <li> <a href="#" data-toggle="collapse" data-target="#ecommerce" class="collapsed" > <i class="fa fa-shopping-basket"></i> <span class="nav-label">E-Commerce</span> <span class="fa fa-chevron-left pull-right"></span> </a>--}}
{{--                <ul class="sub-menu collapse" id="ecommerce">--}}
{{--                    <li><a href="#"><i class="fa fa-bookmark"></i>Orders</a></li>--}}
{{--                </ul>--}}
{{--            </li>--}}
        @endcan
    </ul>
</div>
