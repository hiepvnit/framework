<div class="container">
<nav class="navbar navbar-expand-lg  navbar-light bg-light mb-3">

    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
        Mage2 Admin
    </a>

    <button class="navbar-toggler" type="button"
            data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            @foreach($adminMenus as $menu)

                <?php
                //dd($menu);
                $menu = array_values($menu)[0];
                if (!isset($menu['route'])) {
                    continue;
                }
                ?>
                @if(isset($menu['submenu']))
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">{{ $menu['label'] }}
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu">
                            @foreach($menu['submenu'] as $subMenu)
                                <a class="dropdown-item"
                                   href="{{ route($subMenu['route']) }}">{{ $subMenu['label'] }}</a>
                            @endforeach
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route($menu['route']) }}">
                            {{ $menu['label'] }}
                        </a>
                    </li>
                @endif
            @endforeach
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.logout') }}">Logout</a></li>
        </ul>
    </div>
</nav>

</div>