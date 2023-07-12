@extends('layouts.app')

@section('content')
<!-- Début elment 2 -->

<html>

<head>
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/chartist-js/chartist.min.css') }}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/dashboard-modern.css') }}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom/custom.css') }}">
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Page Main-->

    <div class="row">
        <div class="col s12">
            <div class="container">
                <div class="section">
                    <!-- Current balance & total transactions cards-->
                    <!-- <div class="row vertical-modern-dashboard"> -->
                    <!-- <div class="col s12 m4 l4"> -->
                    <!-- Current Balance -->
                    <!-- <div class="card animate fadeLeft">
                                <div class="card-content">
                                    <h6 class="mb-0 mt-0 display-flex justify-content-between">Chiffre d'affaire
                                        journalier
                                        <i class="material-icons float-right">more_vert</i>
                                    </h6>
                                    <p class="medium-small"></p>
                                    <div class="current-balance-container">
                                        <div id="current-balance-donut-chart" class="current-balance-shadow"></div>
                                    </div>
                                    <h5 class="center-align"> {{ $chiffreaffairebymonthcurrent->sum ?? 0 }} XOF</h5>
                                    <p class="medium-small center-align">
                                    </p>
                                </div>
                            </div> -->
                    <!-- </div> -->
                    <!-- <div class="col s12 m8 l8 animate fadeRight"> -->
                    <!-- Total Transaction -->
                    <!-- <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title mb-0">Chiffre d'affaire journalier <i class="material-icons float-right">more_vert</i></h4>
                                    {{-- <p class="medium-small">Les commandes mensuelle</p> --}}
                                    <div class="total-transaction-container">
                                        <div id="total-transaction-line-chart" class="total-transaction-shadow"></div>
                                    </div>
                                </div>
                            </div> -->
                    <!-- </div> -->
                    <!-- </div> -->
                    <!--/ Current balance & total transactions cards-->

                    <!-- User statistics & appointment cards-->
                    <!-- <div class="row"> -->
                    <!-- <div class="col s12 l8"> -->
                    <!-- User Statistics -->
                    <!-- <div class="card user-statistics-card animate fadeLeft">
                                <div class="card-content">
                                    <h4 class="card-title mb-0">Nombre de livraison journalière<i class="material-icons float-right">more_vert</i></h4>
                                    <div class="row">
                                        <div class="col s12 m6">
                                            <ul class="collection border-none mb-0">
                                                <li class="collection-item avatar">
                                                    <i class="material-icons circle pink accent-2">trending_up</i>
                                                    <p class="medium-small">Cette année</p>
                                                    <h5 class="mt-0 mb-0">60%</h5>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col s12 m6">
                                            <ul class="collection border-none mb-0">
                                                <li class="collection-item avatar">
                                                    <i class="material-icons circle purple accent-4">trending_down</i>
                                                    <p class="medium-small">L'année dernière</p>
                                                    <h5 class="mt-0 mb-0">40%</h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="user-statistics-container">
                                        <div id="user-statistics-bar-chart" class="user-statistics-shadow ct-golden-section"></div>
                                    </div>
                                </div>
                            </div> -->
                    <!-- </div> -->
                    <!-- <div class="col s12 l4"> -->
                    <!-- Recent Buyers -->
                    <!-- <div class="card recent-buyers-card animate fadeUp">
                                <div class="card-content">
                                    <h4 class="card-title mb-0">Les tops 3 acheteurs <i class="material-icons float-right">more_vert</i></h4>
                                    <p class="medium-small pt-2">Aujourd'hui</p>
                                    <ul class="collection mb-0">

                                        <li class="collection-item avatar">
                                            <img src="{{ 'https://ui-avatars.com/api/?background=8EC741&color=ffff/?uppercase=true&name='}}" alt="Photo de profil" class="circle">
                                            <p class="font-weight-600">drgg</p>
                                            <p class="medium-small">gxgsgf</p>
                                            <a href="#!" class="secondary-content">dggfg</a>
                                        </li>

                                    </ul>
                                </div>
                            </div> -->


                    <!-- </div> -->

                    <!-- </div> -->
                    <!--/ Current balance & appointment cards-->

                    <div class="row">
                        <div class="col s12 m6 l6">
                            <!-- <div class="card padding-4 animate fadeLeft">
                                <div class="row">
                                    <div class="col s5 m5">
                                        <h5 class="mb-0">10</h5>
                                        <p class="no-margin">Nouveaux clients</p>

                                    </div>
                                    <div class="col s7 m7 right-align">
                                        <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
                                        <p class="mb-0">Clients Total</p>
                                        <p class="mb-0">22</p>
                                    </div>
                                </div>
                            </div> -->

                            <div id="chartjs" class="card pt-0 pb-0 animate fadeLeft">
                                <div class="dashboard-revenue-wrapper padding-2 ml-2" style="margin-bottom: 100px;">
                                    <span class=" badge gradient-45deg-indigo-purple gradient-shadow mt-2 mr-2"><span id="orders"></span> Commandes</span>
                                    <p class="mt-2 mb-0 font-weight-600">Commandes du mois :</p>
                                </div>
                                <div class="sample-chart-wrapper card-gradient-chart">
                                    <canvas id="bar-chart1" class="center1"></canvas>
                                </div>
                            </div>


                        </div>
                        <div class="col s12 l6">
                            <!-- Recent Buyers -->
                            <div id="chartjs" class="card pt-0 pb-0 animate fadeLeft">
                                <div class="dashboard-revenue-wrapper padding-2 ml-2" style="margin-bottom: 100px;">
                                    <span class=" badge gradient-45deg-indigo-purple gradient-shadow mt-2 mr-2"><span id="turnoverofmonth"></span> FCFA</span>
                                    <p class="mt-2 mb-0 font-weight-600">Chiffre d'affaire du mois :</p>
                                </div>
                                <div class="sample-chart-wrapper card-gradient-chart">
                                    <canvas id="bar-chart" class="center"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m6 l8" style="width:100%">
                            <div class="card subscriber-list-card animate fadeRight">
                                <div class="card-content pb-1">
                                    <h4 class="card-title mb-0">Nouvelles commandes
                                        <a href="{{route('commandes.today')}}"><i class="material-icons float-right" data-position="top" data-tooltip="Voir">visibility</i></a>
                                    </h4>
                                </div>
                                <table class="subscription-table responsive-table highlight">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Receveur</th>
                                            <th>Pack</th>
                                            <th>Statut</th>
                                            <th>Quantité</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                        <tr>
                                            <td style="height:10px !important">
                                                {{ $item->customer->particular->name ?? $item->customer->company->name }}
                                                {{ $item->customer->particular->firstname ?? $item->customer->company->firstname }}
                                            </td>
                                            <td style="height:10px !important">
                                                @if($item->receiver !== null)
                                                {{ $item->receiver->firstname ?? 'N/A' }}
                                                {{ $item->receiver->lastname ?? '' }}
                                                @else
                                                {{ $item->customer->particular->name ?? $item->customer->company->name }}
                                                {{ $item->customer->particular->firstname ?? $item->customer->company->firstname }}
                                                @endif
                                            </td>
                                            <td>{{ $item->paquet->paquetType->label ?? '' }}</td>
                                            <td><span class="badge pink lighten-5 pink-text text-accent-2">
                                                    @if ($item->status_order == true)
                                                    <span class="new badge gradient-45deg-light-blue-cyan" data-badge-caption="" style="font-weight: bold">Validée</span>
                                                    @else
                                                    <span class="new badge" data-badge-caption="" style="font-weight: bold">En cours</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>{{ $item->number }}</td>
                                            <!-- <td class="center-align"><a href="#"><i class="material-icons pink-text">visibility</i></a></td> -->
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="card-content">
                        <div class="card-panel">
                            <h4 class="card-title mb-0">Top 3 des clients du mois
                                <!-- <i class="material-icons float-right">more_vert</i> -->
                            </h4>

                            <table class="subscription-table responsive-table highlight">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Montant total</th>

                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($topclient as $key => $value)
                                    <tr>
                                        <td style="height:10px !important">
                                            {{$key}}
                                        </td>
                                        <td style="height:10px !important">
                                            {{$value}}
                                        </td>

                                        <!-- <td class="center-align"><a href="#"><i class="material-icons pink-text">visibility</i></a></td> -->
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- <p class="medium-small pt-2">Aujourd'hui</p> -->

                        </div>

                    </div>
                </div>

                <div id="intro">
                    <div class="row">
                        <div class="col s12">

                            <div id="img-modal" class="modal white">
                                <div class="modal-content">
                                    <div class="bg-img-div"></div>
                                    <p class="modal-header right modal-close">
                                        Skip Intro <span class="right"><i class="material-icons right-align">clear</i></span>
                                    </p>
                                    <div class="carousel carousel-slider center intro-carousel">
                                        <div class="carousel-fixed-item center middle-indicator">
                                            <div class="left">
                                                <button class="movePrevCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-prev">
                                                    <i class="material-icons">navigate_before</i> <span class="hide-on-small-only">Prev</span>
                                                </button>
                                            </div>

                                            <div class="right">
                                                <button class=" moveNextCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-next">
                                                    <span class="hide-on-small-only">Next</span> <i class="material-icons">navigate_next</i>
                                                </button>
                                            </div>
                                        </div> 1100.00
                                        <div class="carousel-item slide-1">
                                            <img src="../../../app-assets/images/gallery/intro-slide-1.png" alt="" class="responsive-img animated fadeInUp slide-1-img">
                                            <h5 class="intro-step-title mt-7 center animated fadeInUp">Welcome to
                                                Materialize</h5>
                                            <p class="intro-step-text mt-5 animated fadeInUp">Materialize is a Material
                                                Design Admin
                                                Template is the excellent responsive google material design inspired
                                                multipurpose admin
                                                template. Materialize has a huge collection of material design animation
                                                & widgets, UI
                                                Elements.</p>
                                        </div>
                                        <div class="carousel-item slide-2">
                                            <img src="../../../app-assets/images/gallery/intro-features.png" alt="" class="responsive-img slide-2-img">
                                            <h5 class="intro-step-title mt-7 center">Example Request Information</h5>
                                            <p class="intro-step-text mt-5">Lorem ipsum dolor sit amet consectetur,
                                                adipisicing elit.
                                                Aperiam deserunt nulla
                                                repudiandae odit quisquam incidunt, maxime explicabo.</p>
                                            <div class="row">
                                                <div class="col s6">
                                                    <div class="input-field">
                                                        <label for="first_name">Name</label>
                                                        <input placeholder="Name" id="first_name" type="text" class="validate">
                                                    </div>
                                                </div>
                                                <div class="col s6">
                                                    <div class="input-field">
                                                        <select>
                                                            <option value="" disabled selected>Choose your option
                                                            </option>
                                                            <option value="1">Option 1</option>
                                                            <option value="2">Option 2</option>
                                                            <option value="3">Option 3</option>
                                                        </select>
                                                        <label>Materialize Select</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="carousel-item slide-3">
                                            <img src="../../../app-assets/images/gallery/intro-app.png" alt="" class="responsive-img slide-1-img">
                                            <h5 class="intro-step-title mt-7 center">Showcase App Features</h5>
                                            <div class="row">
                                                <div class="col m5 offset-m1 s12">
                                                    <ul class="feature-list left-align">
                                                        <li><i class="material-icons">check</i> Email Application</li>
                                                        <li><i class="material-icons">check</i> Chat Application</li>
                                                        <li><i class="material-icons">check</i> Todo Application</li>
                                                    </ul>
                                                </div>
                                                <div class="col m6 s12">
                                                    <ul class="feature-list left-align">
                                                        <li><i class="material-icons">check</i>Contacts Application
                                                        </li>
                                                        <li><i class="material-icons">check</i>Full Calendar</li>
                                                        <li><i class="material-icons">check</i> Ecommerce Application
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="row">
                                                    <div class="col s12 center">
                                                        <button class="get-started btn waves-effect waves-light gradient-45deg-purple-deep-orange mt-3 modal-close">Get
                                                            Started</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Intro -->
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
    </div>
    <!-- END: Page Main-->

    <!-- Theme Customizer -->



    <div id="theme-cutomizer-out" class="theme-cutomizer sidenav row">
        <div class="col s12">
            <a class="sidenav-close" href="#!"><i class="material-icons">close</i></a>
            <h5 class="theme-cutomizer-title">Theme Customizer</h5>
            <p class="medium-small">Customize & Preview in Real Time</p>
            <div class="menu-options">
                <h6 class="mt-6">Menu Options</h6>
                <hr class="customize-devider" />
                <div class="menu-options-form row">
                    <div class="input-field col s12 menu-color mb-0">
                        <p class="mt-0">Menu Color</p>
                        <div class="gradient-color center-align">
                            <span class="menu-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                            <span class="menu-color-option gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                            <span class="menu-color-option gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                            <span class="menu-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                            <span class="menu-color-option gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                            <span class="menu-color-option gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                            <span class="menu-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                            <span class="menu-color-option gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                            <span class="menu-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                        </div>
                        <div class="solid-color center-align">
                            <span class="menu-color-option red" data-color="red"></span>
                            <span class="menu-color-option purple" data-color="purple"></span>
                            <span class="menu-color-option pink" data-color="pink"></span>
                            <span class="menu-color-option deep-purple" data-color="deep-purple"></span>
                            <span class="menu-color-option cyan" data-color="cyan"></span>
                            <span class="menu-color-option teal" data-color="teal"></span>
                            <span class="menu-color-option light-blue" data-color="light-blue"></span>
                            <span class="menu-color-option amber darken-3" data-color="amber darken-3"></span>
                            <span class="menu-color-option brown darken-2" data-color="brown darken-2"></span>
                        </div>
                    </div>
                    <div class="input-field col s12 menu-bg-color mb-0">
                        <p class="mt-0">Menu Background Color</p>
                        <div class="gradient-color center-align">
                            <span class="menu-bg-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                            <span class="menu-bg-color-option gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                            <span class="menu-bg-color-option gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                            <span class="menu-bg-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                            <span class="menu-bg-color-option gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                            <span class="menu-bg-color-option gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                            <span class="menu-bg-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                            <span class="menu-bg-color-option gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                            <span class="menu-bg-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                        </div>
                        <div class="solid-color center-align">
                            <span class="menu-bg-color-option red" data-color="red"></span>
                            <span class="menu-bg-color-option purple" data-color="purple"></span>
                            <span class="menu-bg-color-option pink" data-color="pink"></span>
                            <span class="menu-bg-color-option deep-purple" data-color="deep-purple"></span>
                            <span class="menu-bg-color-option cyan" data-color="cyan"></span>
                            <span class="menu-bg-color-option teal" data-color="teal"></span>
                            <span class="menu-bg-color-option light-blue" data-color="light-blue"></span>
                            <span class="menu-bg-color-option amber darken-3" data-color="amber darken-3"></span>
                            <span class="menu-bg-color-option brown darken-2" data-color="brown darken-2"></span>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <div class="switch">
                            Menu Dark
                            <label class="float-right"><input class="menu-dark-checkbox" type="checkbox" /> <span class="lever ml-0"></span></label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <div class="switch">
                            Menu Collapsed
                            <label class="float-right"><input class="menu-collapsed-checkbox" type="checkbox" />
                                <span class="lever ml-0"></span></label>
                        </div>
                    </div>
                    <div class="input-field col s12">
                        <div class="switch">
                            <p class="mt-0">Menu Selection</p>
                            <label>
                                <input class="menu-selection-radio with-gap" value="sidenav-active-square" name="menu-selection" type="radio" />
                                <span>Square</span>
                            </label>
                            <label>
                                <input class="menu-selection-radio with-gap" value="sidenav-active-rounded" name="menu-selection" type="radio" />
                                <span>Rounded</span>
                            </label>
                            <label>
                                <input class="menu-selection-radio with-gap" value="" name="menu-selection" type="radio" />
                                <span>Normal</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <h6 class="mt-6">Navbar Options</h6>
            <hr class="customize-devider" />
            <div class="navbar-options row">
                <div class="input-field col s12 navbar-color mb-0">
                    <p class="mt-0">Navbar Color</p>
                    <div class="gradient-color center-align">
                        <span class="navbar-color-option gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                        <span class="navbar-color-option gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                        <span class="navbar-color-option gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                        <span class="navbar-color-option gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                        <span class="navbar-color-option gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                        <span class="navbar-color-option gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                        <span class="navbar-color-option gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                        <span class="navbar-color-option gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                        <span class="navbar-color-option gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
                    </div>
                    <div class="solid-color center-align">
                        <span class="navbar-color-option red" data-color="red"></span>
                        <span class="navbar-color-option purple" data-color="purple"></span>
                        <span class="navbar-color-option pink" data-color="pink"></span>
                        <span class="navbar-color-option deep-purple" data-color="deep-purple"></span>
                        <span class="navbar-color-option cyan" data-color="cyan"></span>
                        <span class="navbar-color-option teal" data-color="teal"></span>
                        <span class="navbar-color-option light-blue" data-color="light-blue"></span>
                        <span class="navbar-color-option amber darken-3" data-color="amber darken-3"></span>
                        <span class="navbar-color-option brown darken-2" data-color="brown darken-2"></span>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        Navbar Dark
                        <label class="float-right"><input class="navbar-dark-checkbox" type="checkbox" /> <span class="lever ml-0"></span></label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        Navbar Fixed
                        <label class="float-right"><input class="navbar-fixed-checkbox" type="checkbox" checked />
                            <span class="lever ml-0"></span></label>
                    </div>
                </div>

            </div>
            <h6 class="mt-6">Footer Options</h6>
            <hr class="customize-devider" />
            <div class="navbar-options row">
                <div class="input-field col s12">
                    <div class="switch">
                        Footer Dark
                        <label class="float-right"><input class="footer-dark-checkbox" type="checkbox" /> <span class="lever ml-0"></span></label>
                    </div>
                </div>
                <div class="input-field col s12">
                    <div class="switch">
                        Footer Fixed
                        <label class="float-right"><input class="footer-fixed-checkbox" type="checkbox" /> <span class="lever ml-0"></span></label>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{ asset('app-assets/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ asset('app-assets/vendors/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/chartist-js/chartist.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/chartist-js/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/chartist-js/chartist-plugin-fill-donut.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    {{-- <script src="{{ asset('app-assets/js/scripts/dashboard-modern.js') }}"></script> --}}
    <!-- END PAGE LEVEL JS-->
    @include('homejs')
</body>

</html>

<!-- Fin element 2 -->
@endsection
