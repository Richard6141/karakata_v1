@extends('layouts.app')

@section('content')
<!-- users edit start -->
@if (\Session::has('errorMessage'))
<div class="card-alert card red">
    <div class="card-content white-text">
        <p>{!! \Session::get('errorMessage') !!}</p>
    </div>
    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>
@endif
<!-- <div class="section users-edit">
    <div class="card">
        <div class="card-content">
            <h4 class="card-title">Historique des connexions à l'application KARAKATA Manager</h4>
            <ul>
                @foreach($historiques as $historique)
                <li>L'agent <span style="color: black; font-weight: bold">{{ $historique->nom }}</span> <span style="color: black; font-weight: bold">{{ $historique->prenom }}</span> s'est connecté(e) à l'application KARAKATA Manager le {{ $historique->created_at->format('d M Y')  }} à {{ $historique->created_at->format('H:i:s')  }} </li>
                @endforeach
            </ul>
        </div>
    </div>
</div> -->
<div class="users-list-table">
    <div class="card">
        <div class="card-content">
            <!-- datatable start -->
            <div>
                <table id="data-table-simple" class="display">
                    <!-- <table> -->
                    <thead>
                        <tr>
                            <!-- <th>Id</th> -->
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date de connexion</th>
                            <th>Heure de connexion</th>
                            <th>Adresse IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historiques as $historique)
                        <tr>
                            <!-- <td>{{ $historique->id }}</td> -->
                            <!-- <td><a href="{{ route('user.view', ['id' => $historique->id]) }}">{{ $historique->nom }}</a></td>
                            <td><a href="{{ route('user.view', ['id' => $historique->id]) }}">{{ $historique->prenom }}</a></td> -->

                            <td>{{ $historique->nom }}</td>
                            <td>{{ $historique->prenom }}</td>
                            <td>{{ $historique->created_at->format('d M Y')  }}</td>
                            <td>{{ $historique->created_at->format('H:i:s')  }}</td>
                            <td>{{ $historique->ip }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- users edit ends -->
@endsection
