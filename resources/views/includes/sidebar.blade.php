@php($currentRouteName = Route::currentRouteName())
<nav class="pcoded-navbar">
    <div class="nav-list">
        <div class="pcoded-inner-navbar main-menu">
            <ul class="pcoded-item pcoded-left-item">
                <li class="{{in_array($currentRouteName,['dashboard.index']) ? 'active':''}}">
                    <a href="{{route('dashboard.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">Dashboard</span>
                    </a>
                </li>
                <li class="{{in_array($currentRouteName,['prizes.index','prizes.create','prizes.edit']) ? 'active':''}}">
                    <a href="{{route('prizes.index')}}" class="waves-effect waves-dark">
                        <span class="pcoded-micon">
                            <i class="fa fa-user icon-menu"></i>
                        </span>
                        <span class="pcoded-mtext">Prizes</span>
                    </a>
                </li>
               
            </ul>

        </div>
    </div>
</nav>