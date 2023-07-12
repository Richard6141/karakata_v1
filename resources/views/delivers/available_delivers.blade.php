@extends('layouts.app')

@section('content')
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h5 class="breadcrumbs-title mt-0 mb-0"><span>Les Livreurs diponible</span></h5>
                    <ol class="breadcrumbs mb-0">
                    <li class="breadcrumb-item"><a href="/">Acceuil</a></li>

                    <li class="breadcrumb-item"><a href="{{route('delivers.index')}}">Liste</a></li>
                    <li class="breadcrumb-item active">Acceuil</li>

                    </ol>
                </div>
                <a href="{{backUrl()}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right">RETOUR</a>
            </div>
        </div>
    </div>
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="col s12 m12 l12">
                        <div id="Form-advance" class="card card card-default scrollspy">
                            <div class="card-content">
                                <form action="{{route('delivers.available.add')}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col s10">
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">date_range</i>
                                                <input id="start_day" type="date" name="start_day" value="{{ old('start_day') }}">
                                                <label for="start_day">Date de début</label>
                                                @error('start_day')
                                                <small class="red-text ml-7" role="alert">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix pt-2">date_range</i>
                                                <input id="end_day" type="date" name="end_day" value="{{ old('phone') }}">
                                                <label for="end_day">Date de fin</label>
                                                @error('end_day')
                                                <small class="red-text ml-7" role="alert">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col s2">
                                            <button class="btn bcyan waves-effect waves-light right fixed" style="margin-top:5%" id="assignbutton" type="submit">Assigner</a>
                                                <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                                    <section class="users-list-wrapper section">
                                        <div class="users-list-table">
                                            <div class="card">
                                                <div class="card-content">
                                                    <!-- datatable start -->
                                                    <div class="responsive-table">
                                                        <table id="data-table-simple" style="width:100%" class="display">
                                                            <thead>
                                                                <tr style="color:black">
                                                                    <th>Nom</th>
                                                                    <th>Prénoms</th>
                                                                    <th>Téléphone</th>
                                                                    <th class="">Disponible</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($delivers as $item)
                                                                @if(checkavailabledeliver($item->id) == false || checkexistdeliver($item->id) == false)
                                                                <tr>
                                                                    <td><span>{{ $item->lastname ?? 'N/A'}} </span></td>
                                                                    <td><span>{{ $item->firstname ?? '' }} </span></td>
                                                                    <td><span>{{ $item->phone ?? '' }} </span></td>
                                                                    <td><span>
                                                                            <div class="switch">
                                                                                <label>
                                                                                    <input class="filled-in" id="checkme" name="deliver_id[]" value="{{ $item->id}}" type="checkbox">
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </form>
                                <!-- datatable ends -->
                            </div>
                        </div>
                    </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Suggestion.delete')

</div>
<div class="content-overlay"></div>
</div>
<!-- <div class="" style="display: none">
        <a id="btnCarnetAdresse" class="btn-floating  waves-effect waves-light breadcrumbs-btn right mr-1 mb-1 modal-trigger btn-large" href="#modalCarnet"><i class="material-icons tooltipped" data-position="top" data-tooltip="Ajouter">add</i>
    </div> -->
</div>
@endsection
@section('scripts')
@include('Suggestion.js')
@endsection