@extends('layouts.app')

@section('content')    
 <!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/vertical-modern-menu-template/materialize.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/vertical-modern-menu-template/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-500.css">

    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/custom/custom.css">
    <!-- END: Custom CSS-->
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column    blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container"><div class="section p-0 m-0 height-100vh section-500">
  <div class="row">
    <!-- 404 -->
    <div class="col s12 center-align white">
      <img src="../../../app-assets/images/gallery/error.png" alt="" class="bg-image-500">
      <h1 class="error-code m-0">405</h1>
      <h6 class="mb-2">Ressource introuvable</h6>
      <a class="btn waves-effect waves-light gradient-45deg-deep-purple-blue gradient-shadow mb-4" href="{{backUrl()}}">Retour</a>
    </div>
  </div>
</div>
        </div>
        <div class="content-overlay"></div>
      </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="../../../app-assets/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="../../../app-assets/js/plugins.js"></script>
    <script src="../../../app-assets/js/search.js"></script>
    <script src="../../../app-assets/js/custom/custom-script.js"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
  </body>
</html>
@endsection
@section('scripts')
    <!-- <script src="{{ asset('js/scripts/app-invoice.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#editBtn', function() {
                $('#label').val($(this).attr('data-label'))
                $('#label').click()

                document.forms.addForm.action = $(this).attr('data-url');
            })

            $(document).on('click', '#supBtn', function() {
                document.forms.deleteForm.action = $(this).attr('data-url');
            })
        })
    </script> -->
@endsection
