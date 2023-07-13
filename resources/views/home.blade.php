@extends('layouts.app')

@section('content')
<!-- Début elment 2 -->

<div class="section">
   <!--card stats start-->
   <div id="card-stats" class="pt-0">
      <div class="row">
        @if (auth()->user()->hasRole('COMMERCIAL'))
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow min-height-100 white-text animate fadeLeft">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">add_shopping_cart</i>
                        <p>Mes enquêtes</p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">1</h5>
                        <p class="no-margin">Total</p>
                        <p>Mes résultas</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <a href="#">
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-red-pink gradient-shadow min-height-100 white-text animate fadeLeft">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">perm_identity</i>
                        <p>{{todaywork_date()}}</p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">{{my_survey()}}</h5>
                        <p class="no-margin">Aujourd'hui</p>
                        <!-- <p>1,12,900</p> -->
                     </div>
                  </div>
               </div>
            </div>
         </div></a>
        <a href="#"></a>
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">attach_money</i>
                        <p>Les résultats</p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">{{today_survey()}}</h5>
                        <p class="no-margin">Tous</p>
                     </div>
                  </div>
               </div>
            </div>
         </div></a>
         @endif
         @if (auth()->user()->hasRole('ADMINISTRATEUR'))
         
        <a href="#"></a>
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-amber-amber gradient-shadow min-height-100 white-text animate fadeRight">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">timeline</i>
                        <p>Agents</p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">80%</h5>
                        <!-- <p class="no-margin">Growth</p> -->
                        <p>Actifs</p>
                     </div>
                  </div>
               </div>
            </div>
         </div></a>
         <a href="{{ route('show.survey')}}">
         <div class="col s12 m6 l6 xl3">
            <div class="card gradient-45deg-green-teal gradient-shadow min-height-100 white-text animate fadeRight">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s7 m7">
                        <i class="material-icons background-round mt-5">attach_money</i>
                        <p>Les résultats</p>
                     </div>
                     <div class="col s5 m5 right-align">
                        <h5 class="mb-0 white-text">{{today_survey()}}</h5>
                        <p class="no-margin">Tous</p>
                     </div>
                  </div>
               </div>
            </div>
         </div></a>
      </div>
   </div>
    @endif
   <!--card stats end-->
   <!--yearly & weekly revenue chart start-->
   
   <!--yearly & weekly revenue chart end-->
   <!-- Member online, Currunt Server load & Today's Revenue Chart start -->
  
   <!-- Member online, Currunt Server load & Today's Revenue Chart start -->
   <!-- ecommerce product start-->
   
      <!-- ecommerce offers start-->
      <!-- <div id="ecommerce-offer">
         <div class="row">
            <div class="col s12 m3">
               <div class="card gradient-shadow gradient-45deg-light-blue-cyan border-radius-3 animate fadeUp">
                  <div class="card-content center">
                     <img src="{{asset('images/icon/apple-watch.png')}}"
                        class="width-40 border-round z-depth-5 responsive-img" alt="image" />
                     <h5 class="white-text lighten-4">50% Off</h5>
                     <p class="white-text lighten-4">On apple watch</p>
                  </div>
               </div>
            </div>
            <div class="col s12 m3">
               <div class="card gradient-shadow gradient-45deg-red-pink border-radius-3 animate fadeUp">
                  <div class="card-content center">
                     <img src="{{asset('images/icon/printer.png')}}"
                        class="width-40 border-round z-depth-5 responsive-img" alt="images" />
                     <h5 class="white-text lighten-4">20% Off</h5>
                     <p class="white-text lighten-4">On Canon Printer</p>
                  </div>
               </div>
            </div>
            <div class="col s12 m3">
               <div class="card gradient-shadow gradient-45deg-amber-amber border-radius-3 animate fadeUp">
                  <div class="card-content center">
                     <img src="{{asset('images/icon/laptop.png')}}"
                        class="width-40 border-round z-depth-5 responsive-img" alt="image" />
                     <h5 class="white-text lighten-4">40% Off</h5>
                     <p class="white-text lighten-4">On apple macbook</p>
                  </div>
               </div>
            </div>
            <div class="col s12 m3">
               <div class="card gradient-shadow gradient-45deg-green-teal border-radius-3 animate fadeUp">
                  <div class="card-content center">
                     <img src="{{asset('images/icon/bowling.png')}}"
                        class="width-40 border-round z-depth-5 responsive-img" alt="image" />
                     <h5 class="white-text lighten-4">60% Off</h5>
                     <p class="white-text lighten-4">On any game</p>
                  </div>
               </div>
            </div>
         </div>
      </div> -->
      <!-- ecommerce offers end-->
      <!-- //////////////////////////////////////////////////////////////////////////// -->
   </div>
   <!--end container-->
</div>
@endsection
