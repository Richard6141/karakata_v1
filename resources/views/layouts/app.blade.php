<!DOCTYPE html>
<!--
Template Name: Materialize - Material Design Admin Template
Author: PixInvent
Website: http://www.pixinvent.com/
Contact: hello@pixinvent.com
Follow: www.twitter.com/pixinvents
Like: www.facebook.com/pixinvents
Purchase: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
Renew Support: https://themeforest.net/item/materialize-material-design-admin-template/11446068?ref=pixinvent
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.

-->
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('layouts.header')
    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body
    class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   "
    data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            @include('layouts.navbar')
        </div>
    </header>
    <!-- END: Header-->


    <!-- BEGIN: SideNav-->
    @include('layouts.sidebar')
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
        @yield('content')

    </div>

    <footer
        class="page-footer footer footer-static footer-dark gradient-45deg-indigo-purple gradient-shadow navbar-border navbar-shadow">
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large red">
              <i class="large material-icons">mode_edit</i>
            </a>
            <ul>
                <li><a class="btn-floating green" href="{{ route('home') }}"><i class="material-icons tooltipped" data-position="left" data-tooltip="Tableau de bord">home</i></a></li>
                <li><a class="btn-floating green" href="{{ route('menu.today') }}"><i class="material-icons tooltipped" data-position="left" data-tooltip="Menu du jour">cake</i></a></li>
                <li><a class="btn-floating yellow darken-1" href="{{ route('allmenus') }}"><i class="material-icons tooltipped" data-position="left" data-tooltip="Menus">cake</i></a></li>
              <li><a class="btn-floating red" href="{{ route('commande.index') }}"><i class="material-icons tooltipped" data-position="left" data-tooltip="Commandes">local_mall</i></a></li>
              <li><a class="btn-floating blue" href="{{ route('delivers.assign') }}"><i class="material-icons tooltipped" data-position="left" data-tooltip="Livraisons">account_circle</i></a></li>
            </ul>
          </div>
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2022 <a
                        href="javascript:;"
                        target="_blank">TOP FOOD</a> Tous les droits sont réservés.</span></div>
        </div>
    </footer>

    @include('layouts.script')
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.modal');
    var instances = M.Modal.init(elems, dismissible = false);}
</script>
