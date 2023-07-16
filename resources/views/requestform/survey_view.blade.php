@extends('layouts.app')

@section('content')
@if (session()->has('successMessage'))
<div class="alert alert-success" role="alert">
  {{ session('successMessage') }}
</div>
@endif
@if (session()->has('errorMessage'))
<div class="alert alert-danger" role="alert">
  {{ session('errorMessage') }}
</div>
@endif
<div class="row">
  <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
  <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <div class="container">
      <div class="row">
        <div class="col s10 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>Les réponses</span></h5>
          <ol class="breadcrumbs mb-0">
            <li class="breadcrumb-item"><a href="/">Acceuil</a>
            </li>
            <!-- <li class="breadcrumb-item"><a href="{{route('user.list')}}">Utilisateurs</a> -->
          </li>
            <li class="breadcrumb-item active">Réponses
            </li>
          </ol>
      </div>
      <a href="{{ backUrl() }}"
                        class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

    </div>
  </div>
  
  <div class="col s12">
    <div class="container">
      <div class="section">
        <div class="card">
          <div class="section users-view">
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12 m4">
                    <table class="striped">
                      <tbody>
                        <tr>
                          <td>Enrégistré le:</td>
                          <td>{{$request->created_at->format('d M Y')}}</td>
                        </tr>
                        <tr>
                          <td>Nom:</td>
                          <td>{{$request->name}}</td>
                        </tr>
                        <tr>
                          <td>Age:</td>
                          <td>{{$request->age}}</td>
                        </tr>
                        <tr>
                          <td>Sexe:</td>
                          <td>{{$request->sexe}}</td>
                        </tr>
                        <tr>
                          <td>Téléphone:</td>
                          <td>{{$request->phone}}</td>
                        </tr>
                        <tr>
                          <td>Localisation:</td>
                          <td>{{$request->location}}</td>
                        </tr>
                        <tr>
                          <td>Profession:</td>
                          <td>{{$request->profession}}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <table class="striped">
                      <tbody>
                        <tr>
                          <td>Avez-vous déjà effectué des paiements en ligne? :</td>
                          @if($request->online_payment = true)
                            <td>Oui</td>
                            @endif
                            @if($request->online_payment = false)
                            <td>Non</td>
                            @endif
                        </tr>
                        <tr>
                          <td>Si non, dites nous pourquoi?:</td>
                          <td>{{ $request->why_not_paid }}</td>
                        </tr>
                        <tr>
                          <td>Si oui, quel produit avez vous commandé ?:</td>
                          <td>{{ $request->which_product }}</td>
                        </tr>
                        <tr>
                          <td>A quelle fréquence vous effectuez vos achats en ligne ?:</td>
                          <td>{{ $request->payment_frequency }}</td>
                        </tr>
                        <tr>
                          <td>Quels sont les principaux obstacles ou préoccupations que vous rencontrez lors des paiements en ligne au Bénin? (Choisissez les trois principales préoccupations):</td>
                          <td>{{ $request->payment_obstacles }}</td>
                        </tr>
                        <tr>
                          <td>Parmi les options suivantes, quelle méthode de paiement en ligne préférez-vous utiliser au Bénin?:</td>
                          <td>{{ $request->payment_method }}</td>
                        </tr>
                        <tr>
                          <td>Avez-vous déjà choisi un produit spécifiquement en raison de la possibilité de livraison à domicile ?:</td>
                          @if($request->choose_product_by_home_delivery = true)
                            <td>Oui</td>
                            @endif
                            @if($request->choose_product_by_home_delivery = false)
                            <td>Non</td>
                            @endif
                        </tr>
                        <tr>
                          <td>Avez-vous déjà utilisé des services de livraison à domicile ?:</td>
                          @if($request->use_delivery_service = true)
                            <td>Oui</td>
                            @endif
                            @if($request->use_delivery_service = false)
                            <td>Non</td>
                            @endif
                        </tr>
                        <tr>
                          <td>Le coût de la livraison a t'il une influence sur vos achats en ligne ?:</td>
                          @if($request->delivery_cost_influence_shop = true)
                            <td>Oui</td>
                            @endif
                            @if($request->delivery_cost_influence_shop = false)
                            <td>Non</td>
                            @endif
                        </tr>
                        <tr>
                          <td>Pensez-vous que la livraison à domicile devrait être offerte gratuitement pour tous les produits que vous achetez ?:</td>
                          @if($request->free_delivery_all_product = true)
                            <td>Oui</td>
                            @endif
                            @if($request->free_delivery_all_product = false)
                            <td>Non</td>
                            @endif
                        </tr>
                        <tr>
                          <td>Quelles améliorations ou options supplémentaires aimeriez-vous voir proposées en matière de livraison à domicile ?:</td>
                          <td>{{ $request->improve_free_delivery }}</td>
                        </tr>

                      </tbody>
                      <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Perspectives sur l'avenir des paiements en ligne au Bénin</h6>
                      <table class="striped">
                        <tbody>
                          <tr>
                            <td>Selon vous, quels sont les avantages des paiements en ligne Bénin par rapport aux méthodes de paiement traditionnelles?:</td>
                            <td>{{$request->online_payment_advantage}}</td>
                          </tr>
                          <tr>
                            <td>Quels sont, selon vous, les principaux défis à surmonter pour favoriser l'adoption généralisée des paiements en ligne au Bénin?:</td>
                            <td>{{$request->online_payment_defi}}</td>
                          </tr>
                          <tr>
                            <td>Seriez-vous disposé(e) à utiliser davantage les paiements en ligne si les problèmes actuels étaient résolus?:</td>
                            @if($request->yes_online_payment_if_resolve = true)
                            <td>Oui</td>
                            @endif
                            @if($request->yes_online_payment_if_resolve = false)
                            <td>Non</td>
                            @endif
                          </tr>
                          <tr>
                            <td>Quelles améliorations ou fonctionnalités aimeriez-vous voir mises en place pour rendre les paiements en ligne plus attrayants et facile au Bénin ?:</td>
                            <td>{{$request->which_improvment_fonctionality}}</td>
                          </tr>
                        </tbody>
                      </table>
                  </div>
                </div>
                <!-- </div> -->
              </div>
            </div>
            <!-- users view card details ends -->

          </div>
        </div>
      </div>


    </div>
    <div class="content-overlay"></div>
  </div>
</div>
@endsection
@section('js')
@endsection
