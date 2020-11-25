<?php
function is_active($name, $flag = false)
{
    if (Request::routeIs($name)) {
        return $flag ? "menu-open" : "active";
    }
    $name = explode('.', $name);
    if(count($name)>2 && $flag)
    {
        unset($name[count($name)-1]);
        $name[]='*';
        $name = implode(".",$name);
        if (Request::routeIs($name)) {
            return $flag ? "menu-open" : "active";
        }
    }
    return "";
}
function menu($menu, $flag = false)
{
    $str = "";
    foreach ($menu as $item) {
        if(Auth::user()->can(config('app.god')) || empty($item['permission']) || Auth::user()->hasAnyPermission($item['permission']))
        {
            if ($item['type'] == "header") {
                $str .= '<li class="nav-header">' . strtoupper($item['name']) . '</li>';
                if (!empty($item['submenu'])){
                    $str.= menu($item['submenu']);
                }
            } else if (!empty($item['submenu'])) {
                $str .= '<li class="nav-item has-treeview ' . is_active($item['route'], true) . '">' .
                    '<a href="#" class="nav-link ' . is_active($item['route']) . '">' .
                    '<i class="nav-icon '.$item['icon'].'"></i>' .
                    '<p>' . $item['name'] . '<i class="right fas fa-angle-left"></i></p>' .
                    '</a>' .
                    '<ul class="nav nav-treeview">' . menu($item['submenu']) . '</ul>' .
                '</li>';
            } else {
                $str .= '<li class="nav-item">
                    <a href="' . route($item['route']) . '" class="nav-link ' . is_active($item['route']) . '">
                        <i class="nav-icon '.$item['icon'].'"></i>
                        <p>' . $item['name'] . '</p>
                    </a>
                </li>';
            }
        }
    }
    return $str;
}
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('panel.index')}}" class="brand-link navbar-danger text-sm">
        <img src="/images/logo.png" alt="{{ config('app.name', 'Laravel') }}" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-bold text-uppercase">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('images/avatars/'.Auth::user()->avatar)}}" class="img-circle elevation-2"
                    alt="{{Auth::user()->name}}">
            </div>
            <div class="info">
                <a href="{{route('panel.profile.index')}}"
                    class="d-block {{is_active('panel.profile.index')}}">{{Auth::user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar text-sm nav-child-indent flex-column" data-widget="treeview"
                role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('panel.index')}}" class="nav-link {{is_active('panel.index')}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{__('Dashboard')}}
                        </p>
                    </a>
                </li>
                @foreach (Module::allEnabled() as $_module)
                @if (config($_module->getLowerName().'.menu'))
                <?= menu(config($_module->getLowerName() . '.menu')) ?>
                @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
