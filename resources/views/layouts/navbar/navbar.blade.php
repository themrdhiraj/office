<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link @php echo $nav == ('dashboard') ? 'active' : '' ; @endphp"
            href="{{route('admin')}}">{{ __('Admin Dashboard') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @php echo $nav == ('settings') ? 'active' : '' ; @endphp"
            href="{{route('adminSettings')}}">{{ __('Settings') }}</a>
    </li>

    {{-- <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ __(Settings) }} <span class="caret"></span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}">
            {{ __('Logout') }}
        </a>
    </div>
    </li> --}}
</ul>