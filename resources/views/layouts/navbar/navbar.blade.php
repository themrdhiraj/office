<ul class="navbar-nav mr-auto">
    <li class="nav-item">
        <a class="nav-link" href="{{route('admin')}}">{{ __('Admin Dashboard') }}</a>
    </li>

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ __('Employee') }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('addEmp') }}">
                {{ __('Add Employee') }}
            </a>
            <a class="dropdown-item" href="{{ route('viewEmp') }}">
                {{ __('View Employee') }}
            </a>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{route('adminSettings')}}">{{ __('Settings') }}</a>
    </li>

    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false" v-pre>
            {{ __('Ongoing Project') }} <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('createProject') }}">
                {{ __('Assign Ongoing Project') }}
            </a>
            <a class="dropdown-item" href="{{ route('project') }}">
                {{ __('View Ongoing Project') }}
            </a>
        </div>
    </li>
</ul>