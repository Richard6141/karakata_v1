@extends('layouts.app')

@section('content')
<style>
    .columns {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
    }

    .column {
        flex: 33.33%;
    }
</style>
<div class="row">
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <h4 class="breadcrumbs-title mt-0 mb-0">Attribution des droits à
                        <strong>{{ $attributionPermission->firstname }}
                            {{ $attributionPermission->name }}</strong>
                    </h4>
                    <ol class="breadcrumbs mb-0">
                        <li class="breadcrumb-item"><a href="/">Acceuil</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Rôles & permissions</a>
                        </li>
                        <li class="breadcrumb-item active">Liste
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
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
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <p class="caption mb-0">
                        <section class="users-list-wrapper section">
                            <div class="users-list-table">
                                <div class="">
                                    <div class="">
                                        <!-- datatable start -->
                                        <div class="responsive-table">
                                            <div class="padding py-4 p-3">
                                                <div class="row">
                                                    <a href="{{route('user.list')}}" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right tooltipped" data-tooltip="Retour">RETOUR</a>
                                                </div>

                                                <form class="form-horizontal row-fluid" action="{{ route('attribution_des_droits') }}" method="POST">
                                                    @csrf
                                                    <div>
                                                        <fieldset class="scheduler-border">
                                                            <legend class="scheduler-border-limite">Rôles</legend>
                                                            <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <div class="control-group">
                                                                        <div class="columns">
                                                                            @foreach ($listRoles as $item)
                                                                            <div class="column">
                                                                                <label><input class="filled-in" data-user="{{ $attributionPermission->id }}" data-namerole="{{ $item->name }}" type="checkbox" @if ($attributionPermission->hasRole($item->name)) checked @endif
                                                                                    id="role"
                                                                                    name="index_slide_acceuil[]" value="{{ $item->name }}"><span>{{ $item->libelle }}</span></label>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="user" value="{{$attributionPermission->id}}">
                                                            <button type="submit" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right tooltipped" data-tooltip="Valider">Valider</button>
                                                        </fieldset><br><br>
                                                    </div>
                                                </form>
                                                <form>
                                                    @csrf
                                                    <div>
                                                        <label><input class="filled-in" data-user1="{{ $attributionPermission->id }}" type="checkbox" @foreach ($listPermissions as $item) @if ($attributionPermission->hasPermissionTo($item->name)) checked @continue @else @break @endif @endforeach
                                                            id="id_permission_all" name="permission_all"><span> Cocher toutes les
                                                                permissions</span></label>
                                                        <fieldset class="scheduler-border">
                                                            <legend class="scheduler-border-limite">Permissions</legend>
                                                            <div class="form-row">
                                                                <div class="col-md-12">
                                                                    <div class="control-group">
                                                                        <div class="columns">
                                                                            @foreach ($listPermissions as $item)
                                                                            <div class="column">
                                                                                <label><input class="filled-in" data-user1="{{ $attributionPermission->id }}" data-namepermission="{{ $item->name }}" type="checkbox" @if ($attributionPermission->hasPermissionTo($item->name)) checked @endif
                                                                                    id="id_permission"
                                                                                    name="index_slide_acceuil"><span>{{ $item->libelle }}</span>
                                                                                </label>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="submit" class="waves-effect waves-light btn gradient-45deg-deep-purple- z-depth-4 mt-2 mr-2 right tooltipped" data-tooltip="Valider">Valider</button>
                                                        </fieldset><br><br>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- datatable ends -->
                                    </div>
                                </div>
                            </div>
                        </section>
                        </p>
                    </div>
                </div>
            </div>


        </div>
        <div class="content-overlay"></div>
    </div>
</div>
@endsection


@section('scripts')
@endsection



