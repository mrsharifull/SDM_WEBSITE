<div class="sidebar">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="#" class="simple-text logo-mini">{{ _('WD') }}</a>
            <a href="#" class="simple-text logo-normal">{{ _('White Dashboard') }}</a>
        </div>
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ _('Dashboard') }}</p>
                </a>
            </li>
            <li>
                <a data-toggle="collapse" href="#user-management" aria-expanded="true">
                    <i class="fa-solid fa-users" ></i>
                    <span class="nav-link-text" >{{ __('User Management') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse @if ($pageSlug == 'user') show @endif " id="user-management">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'user') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="fa-solid fa-minus"></i>
                                <p>{{ _('User') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users') class="active " @endif>
                            <a href="{{ route('user.index')  }}">
                                <i class="fa-solid fa-minus"></i>
                                <p>{{ _('User Management') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>