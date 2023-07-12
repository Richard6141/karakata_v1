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
                        </ol>
                    </div>
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
                                    <div class="">
                                        <!-- Debut Foreach-->
                                        <div class="">

                                            <div class="card animate fadeRight">
                                                <div class="card-content">
                                                    <p></p>
                                                    <!-- <span class="card-title">iPhone x</span> -->
                                                    <div class=" center">
                                                        @forelse ($menu as $item)
                                                        @if (is_null(infopack($item->paquet_id)->image))
                                                        <tr>
                                                            <td colspan="8" class="text-center"><span
                                                                    class="text-center">{{ __('Menu publié (Image non disponible)') }}</span>
                                                            </td>
                                                        </tr>
                                                        @else
                                                        <img style="height: 100%;" class="responsive-img" alt=""
                                                            src="{{ asset('image/' . infopack($item->paquet_id)->image) }}">
                                                        @endif
                                                        @empty
                                                            <tr>
                                                                <td colspan="8" class="text-center"><span
                                                                        class="text-center">{{ __('Menu non publié') }}</span>
                                                                </td>
                                                            </tr>
                                                        @endforelse
                                                    </div>
                                                    <!-- <br> <br>
                                                                <div class="display-flex flex-wrap justify-content-center">
                                                                    <h5 class="mt-3"> F CFA</h5>
                                                                    <a id="showcomposant"
                                                                        class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block modal-trigger z-depth-4"
                                                                        href="#modal3" >Voir</a>
                                                                        <a class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block z-depth-4" href="/">Publier</a>
                                                                        <a class="mt-2 waves-effect waves-light gradient-45deg-deep-purple-blue btn btn-block z-depth-4" href="/">Dépublier</a>
                                                                </div> -->
                                                </div>
                                            </div>
                                        </div>
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
                    content += `<li class="list-item-bullet"> <span class="green-text">` + item
                        .typecomposant + `</span>  : ` + item.labels + `</li>`
                });
                $('#listcomposant').html(content);

            })
        })
    </script>
@endsection
