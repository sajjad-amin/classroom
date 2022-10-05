<div id="sidebar" class="sidebar left">
    <ul class="list-sidebar bg-defoult">
        <li> <a href="{{route('dashboard.dashboard')}}" class="@if(Route::is('dashboard.dashboard')) active @endif"><i class="fa fa-pie-chart"></i> <span class="nav-label">Dashboard</span> </a></li>
        <li>
            <a href="#" data-toggle="collapse" data-target="#class" class="@if(Route::is('dashboard.class.*')) collapsed active @endif" >
                <i class="fa fa-credit-card-alt"></i> <span class="nav-label">Class</span> <span class="fa fa-chevron-left pull-right"></span>
            </a>
            <ul class="sub-menu @if(!Route::is('dashboard.class.*')) collapse @endif" id="class">
                <li><a href="{{route('dashboard.class.all')}}" class="@if(Route::is('dashboard.class.all')) active @endif"><i class="fa fa-list-ul"></i> All Classes</a></li>
                <li><a href="{{route('dashboard.class.new')}}" class="@if(Route::is('dashboard.class.new')) active @endif"><i class="fa fa-rocket" aria-hidden="true"></i> New Class</a></li>
            </ul>
        </li>
    </ul>
</div>
