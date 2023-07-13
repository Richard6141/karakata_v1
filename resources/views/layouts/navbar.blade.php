<nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow">
    <div class="nav-wrapper">
        <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
            <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Rechercher un élément" data-search="template-list">
            <ul class="search-list collection display-none"></ul>
        </div>
        <ul class="navbar-list right">
            <li class="hide-on-large-only search-input-wrapper"><a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);"><i class="material-icons">search</i></a></li>
            @if (auth()->user()->hasRole('ADMINISTRATEUR') || auth()->user()->hasRole('DIRECTEUR'))
            <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">{{ all_today_survey() }}</small></i></a></li>
            @endif
            @if (auth()->user()->hasRole('COMMERCIAL'))
            <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">{{ today_survey () }}</small></i></a></li>
            @endif
            <li>
                <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown">
                    <span class="avatar-status avatar-online">
                        @if(is_null(Auth::user()->image))
                        <div class="avatar">
                            <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name=' . Auth::user()->name. '+' . Auth::user()->firstname}}" alt="Photo de profil" class="z-depth-4 circle" height="40" width="40">
                        </div>
                        @endif
                        @if(!is_null(Auth::user()->image))
                        <div class="avatar">
                            <img src="{{ asset('image/'.Auth::user()->image) }}" alt="Photo de profil" class="z-depth-4 circle" height="40" width="40">
                        </div>
                        @endif
                    </span>
                </a>
            </li>
        </ul>
        <ul class="dropdown-content" id="notifications-dropdown">
            <li>
                <a href="{{route('commande.index')}}">
                    <h6>COMMANDES EN ATTENTES
                        <span style=" font-weight: bold;" class="new badge blue" data-badge-caption="">{{ countCommande() }}</span>
                    </h6>
                </a>
            </li>
            <li>
                <a href="{{route('commande.index')}}">
                    <h6>LIVRAISONS EN ATTENTES
                        <span style=" font-weight: bold;" class="new badge blue" data-badge-caption="">{{ countLivraison() }}</span>
                    </h6>
                </a>
            </li>
            <li class="divider"></li>
        </ul>
        <ul class="dropdown-content" id="profile-dropdown">
            <li><a class="grey-text text-darken-1" href="{{ route('user.profil')}}"><i class="material-icons">person_outline</i> Profil</a></li>
            <li>
                <a style="width: 0px;" class="grey-text text-darken-1" href="{{ route('logout') }}">
                    <i class="material-icons" style="margin-right: 10px">keyboard_tab </i>
                    <span> Déconnecter</span>
                </a>
            </li>
        </ul>
    </div>
</nav>