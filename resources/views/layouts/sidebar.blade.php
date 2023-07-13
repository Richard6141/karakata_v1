<aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square" style="margin-bottom: 5%">
    <div class="brand-sidebar" style="height: 100px;">
        <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{ route('home') }}" style="width: 85%;
    height: 100px;"><img class="hide-on-med-and-down" src="{{ asset('logo/logo_karakata.png') }}" alt="materialize logo" style="height: auto !important;" width="100%" /><img class="show-on-medium-and-down hide-on-med-and-up" src="{{ asset('logo/logo_karakata.png') }}" alt="materialize logo" style="width: 100px !important" height="auto" width="100px" /><span class="logo-text hide-on-med-and-down"></span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
    </div>
    {{-- <div class="brand-sidebar" style="padding-top: 20px; height: 100px;">
        <h1 class="logo-wrapper"><a href="{{ route('home') }}" ><img class="hide-on-med-and-down" src="{{ asset('logo/logo_karakata.png') }}" alt="materialize logo" style="width: 100px !important;" height="auto" width="100%" /></a><a class="navbar-toggler" href="#"></a></h1>
    </div> --}}
    <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion" style="margin-top: 30px;">
        <li class="bold"><a class="{{ request()->is('home') ? 'active' : '' }} || {{ request()->is('/') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('home') }}"><i class="material-icons">home</i><span class="menu-title" data-i18n="Mail">Tableau de
                    bord</span></a>
        </li>
        {{-- <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                    class="material-icons">account_circle</i><span class="menu-title"
                    data-i18n="Dashboard">Utilisateurs</span></a>
            <div class="collapsible-body">
                <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                    <li><a href="{{ route('user.list') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Modern">Utilisateurs <span class="new badge blue" data-badge-caption="">{{ countUser() }}</span></span></a>
        </li>
        <li><a href="{{ route('list.role') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Rôles</span></a>
        </li>
        <li><a href="{{ route('list.permissions') }}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Analytics">Permissions</span></a>
        </li>
    </ul>
    </div>
    </li> --}}
    @if (auth()->user()->hasRole('ADMINISTRATEUR'))
    <li class="bold "><a class="{{ request()->is('page-users-list') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('user.list') }}"><i class="material-icons">account_circle</i><span class="menu-title" data-i18n="Mail">Utilisateurs<span class="new badge blue" style="font-weight: bold; font-size: large" data-badge-caption="">{{ countUser() }}
    @endif
    <li class="bold"><a class="collapsible-header waves-eff
        {{-- <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)"><i
                    class="material-icons">ect waves-cyan " href="JavaScript:void(0)"><i
                                    class="material-icons"></span></span></a>
        </li>
        {{-- <li class="bold "><a class="{{ request()->is('delivers') ? 'active' : '' }} waves-effect waves-cyan "
                    href="{{ route('delivers.index') }}"><i class="material-icons">account_circle</i><span class="menu-title" data-i18n="Mail">Clients</span></a>
    </li> --}}
    <li class="bold"><a class="{{ request()->is('show.survey') ? 'active' : '' }}  || {{ request()->is('survey.form') ? 'active' : '' }} collapsible-header " href="JavaScript:void(0)"><i class="material-icons">account_circle</i><span class="menu-title" data-i18n="Dashboard">Enquêtes</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">

                <li class="bold"><a class="{{ request()->is('show.survey') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('show.survey') }}"><i class="material-icons">account_circle</i><span class="menu-title" data-i18n="Mail">Liste</span></a>

                </li>
                <li class="bold"><a class="{{ request()->is('survey.form') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('survey.form') }}"><i class="material-icons">account_circle</i><span class="menu-title" data-i18n="Mail"> Nouveau</span></a>

                <!-- </li>
                <li class="bold"><a class=" {{ request()->is('reportlist') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('suggestion.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Suggestions</span></a>
                </li> -->
            </ul>
        </div>
    </li>




    <!-- <li class="bold"><a class="{{ request()->is('list_type_composants') ? 'active' : '' }} || {{ request()->is('liste-composants') ? 'active' : '' }} || {{ request()->is('list_packs') ? 'active' : '' }} collapsible-header " href="JavaScript:void(0)"><i class="material-icons">cake</i><span class="menu-title" data-i18n="Dashboard">Menus</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">

                @if (auth()->user()->hasRole('ADMINISTRATEUR') ||
                auth()->user()->hasPermissionTo('index_pack'))
                <li class="bold"><a class="{{ request()->is('type-pack') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('typepack.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Type pack</span></a>
                </li>
                <li class="bold"><a class="{{ request()->is('paquets') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('pack.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Packs</span></a>
                </li>
                @endif
                <li class="bold"><a class="{{ request()->is('list_type_composants') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('typecomposant.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Type composants</span></a>
                </li>
                <li class="bold"><a class="{{ request()->is('liste-composants') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('composant.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Composants</span></a>
                </li>
                <li class="bold"><a class="{{ request()->is('quotaview') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('quota.today') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Quota du
                            jour</span></a>
                </li>
                <li class="bold"><a class="{{ request()->is('all-menus') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('allmenus') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Menu</span></a>
                </li>
                <li class="bold"><a class="{{ request()->is('menuview') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('menu.today') }}"><i class="material-icons">event_note</i><span class="menu-title" data-i18n="Mail">Menu du
                            jour</span></a>
                </li>
            </ul>
        </div>
    </li>
    <li class="bold"><a class="{{ request()->is('list_sources') ? 'active' : '' }} || {{ request()->is('commandes') ? 'active' : '' }} || {{ request()->is('commandes/assigner') ? 'active' : '' }} || {{ request()->is('livreurs/liste/disponible') ? 'active' : '' }}|| {{ request()->is('livreurs/livraisons/attente') ? 'active' : '' }} || {{ request()->is('livreurs/liste/disponible') ? 'active' : '' }} collapsible-header" href="JavaScript:void(0)"><i class="material-icons">local_mall</i><span class="menu-title" data-i18n="Dashboard">Commandes<span class="new badge blue" style="font-weight: bold; font-size: large" data-badge-caption="">{{ countCommande() }}</span>
            </span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                @if (auth()->user()->hasRole('ADMINISTRATEUR') ||
                auth()->user()->hasRole('COMMERCIAL') ||
                auth()->user()->hasPermissionTo('index_source_commande'))
                <li class="bold"><a class="{{ request()->is('list_sources') ? 'active' : '' }} waves-effect waves-cyan " href="{{route('sources.index')}}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">
                            Source
                            commande</span></a>
                </li>
                <li class="bold"><a class="{{ request()->is('list_typecommande') ? 'active' : '' }} waves-effect waves-cyan " href="/list_typecommande"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">
                            Type
                            commande</span></a>
                </li>
                @endif
                @if (auth()->user()->hasRole('ADMINISTRATEUR') ||
                auth()->user()->hasRole('COMMERCIAL') ||
                auth()->user()->hasPermissionTo('index_commande'))
                <li class="bold"><a class="{{ request()->is('commandes') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('commande.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Commandes</span></a>
                </li>
                @endif
                <li class="bold"><a class="{{ request()->is('commandes/assigner') ? 'active' : '' }} || {{ request()->is('livreurs/livraisons/attente') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('delivers.assign') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Livraisons</span></a>
            </li>
            <li class="bold"><a class="{{ request()->is('livreurs/liste/disponible') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('livreur.disponible') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Livreurs disponibles</span></a></li>
            <li class="bold"><a class=" waves-effect waves-cyan " href="{{ route('districts.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Zones
                </span></a>
            </li>
        </ul>
    </div>
</li>
<li class="bold"><a class="{{ request()->is('livreurs') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('delivers.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Liste des livreurs</span></a>
            </li>

    <li class="bold"><a class="{{ request()->is('operations/entree') ? 'active' : '' }} || {{ request()->is('operations/inventaire') ? 'active' : '' }} || {{ request()->is('operations/sortie') ? 'active' : '' }} || {{ request()->is('produits') ? 'active' : '' }} || {{ request()->is('store-products') ? 'active' : '' }} || {{ request()->is('unites') ? 'active' : '' }}  collapsible-header " href="JavaScript:void(0)"><i class="material-icons">local_dining</i><span class="menu-title" data-i18n="Dashboard">Gestion des stocks</span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                <li class="bold"><a class="{{ request()->is('operations/entree') ? 'active' : '' }} || {{ request()->is('operations/inventaire') ? 'active' : '' }} || {{ request()->is('operations/sortie') ? 'active' : '' }}  collapsible-header " href="JavaScript:void(0)"><i class="material-icons">local_dining</i><span class="menu-title" data-i18n="Dashboard">Opérations</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li class="bold"><a class="{{ request()->is('operations/entree') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('entrees') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Entrée</span></a>
                            </li>
                            <li class="bold"><a class="{{ request()->is('operations/inventaire') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('inventaires') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Inventaire</span></a>
                            </li>
                            <li class="bold"><a class="{{ request()->is('operations/sortie') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('sorties') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Sortie</span></a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="bold"><a class="{{ request()->is('produits') ? 'active' : '' }} || {{ request()->is('store-products') ? 'active' : '' }} || {{ request()->is('unites') ? 'active' : '' }}  collapsible-header " href="JavaScript:void(0)"><i class="material-icons">local_dining</i><span class="menu-title" data-i18n="Dashboard">Produits</span></a>
                    <div class="collapsible-body">
                        <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                            <li class="bold"><a class="{{ request()->is('produits') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('produits.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Liste des produits</span></a>
                            </li>
                            <li class="bold"><a class="{{ request()->is('unites') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('unites.index') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Unités de mesure</span></a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </li>

    <li class="bold"><a class="{{ request()->is('coupons/valid') ? 'active' : '' }} || {{ request()->is('coupons/novalid') ? 'active' : '' }} || {{ request()->is('list') ? 'active' : '' }} collapsible-header" href="JavaScript:void(0)"><i class="material-icons">local_mall</i><span class="menu-title" data-i18n="Dashboard">Coupons
            </span></a>
        <div class="collapsible-body">
            <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                <li class="bold"><a class="{{ request()->is('list') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('coupon.clients') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">
                            Clients ayant un coupon</span></a>
                </li>
                <li class="bold"><a class="{{ request()->is('coupons/valid') ? 'active' : '' }} waves-effect waves-cyan " href="/coupons/valide/liste"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Coupons valides</span><span class="new badge blue" style="font-weight: bold; font-size: large" data-badge-caption="">{{ countCouponValid() }}</span></a>
                </li>
                <li class="bold"><a class="{{ request()->is('coupons/novalid') ? 'active' : '' }} waves-effect waves-cyan " href="{{ route('coupons.novalid') }}"><i class="material-icons">add_circle_outline</i><span class="menu-title" data-i18n="Mail">Coupons non valides</span><span class="new badge blue" style="font-weight: bold; font-size: large" data-badge-caption="">{{ couponsNoValid() }}</span></a>
                </li>
            </ul>
        </div>
    </li> -->
    </ul>

    <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>

</aside>
