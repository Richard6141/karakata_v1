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
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Menu du jour</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="/">Acceuil</a>
                            </li>
                            <li class="breadcrumb-item"><a href="">Menu du jour</a>
                            </li>
                            <li class="breadcrumb-item active">Liste
                            </li>
                        </ol>
                    </div>
                    {{-- <a class="col s2 m6 l6"><a class="btn  waves-effect waves-light breadcrumbs-btn right" href="#!"
                            data-target="dropdown1"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i> --}}
                    </a>
                    <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>

                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <div class="section">
                                <div class="row" id="ecommerce-products">
                                    <div class="col s12 m12 l9 pr-0">
                                        <!-- Debut Foreach-->
                                        @foreach ($packs as $item)
                                            <div class="col s12 m4 l4">
                                            @if(!blank(packpublie($item->id)))
                                                <div class="card animate fadeRight">
                                                    <div class="card-content">
                                                        <p>{{ $item->label }}</p>
                                                        <!-- <span class="card-title">iPhone x</span> -->
                                                        <img style = "height:150px;" src="{{ url('image/' . $item->image) }}" class="responsive-img" alt=""> <br>
                                                        <div class="display-flex flex-wrap justify-content-center">
                                                            <h5 class="mt-3">{{ $item->price }} F CFA</h5>
                                                            <a id="showcomposant"
                                                                class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block modal-trigger z-depth-4"
                                                                href="#modal3" data-image="{{ "image/" . $item->image }}" data-price="{{ $item->price . " XOF" }}" data-label="{{ $item->label }}" data-composant="{{ composants($item->id) }}">Voir</a>
                                                                
                                                                @if(packpublie($item->id) == false)
                                                                <a class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block z-depth-4" href="{{ route('menu.published', $item->id)}}">Publier</a>
                                                                @else
                                                                <a class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block z-depth-4" href="{{ route('menu.dispublished', $item->id)}}">Dépublier</a>
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                @endif
                                            </div>
                                        @endforeach
                                        <!fin foreach -->
                                    </div>
                                </div>
                            </div>

                            @include('menus.show')
                        </div>
                    </div>
                </div>


            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#showcomposant', function() {
                var composant = $(this).attr('data-composant');
                $('#title').html($(this).attr('data-label'));
                $('#price').html($(this).attr('data-price'));
                $('#image').attr('src', $(this).attr('data-image'));

                var content = "";
                $.each(JSON.parse(composant), function(i, item) {
                    content += `<li class="list-item-bullet"> <span class="green-text">` + item.typecomposant + `</span>  : ` + item.labels + `</li>`
                });
                $('#listcomposant').html(content);

            })
        })
    </script>
@endsection
