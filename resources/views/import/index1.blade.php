@extends('layouts.app')

@section('content')
    <div class="row">
        <div id="file-upload" class="section">
            <!--Default version-->
            <div class="col s12 m8 l9">

                @if (\Session::has('successMessage'))
                    <div class="card-alert card green">
                        <div class="card-content white-text">
                            <p>{!! \Session::get('successMessage') !!}</p>
                        </div>
                        <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                @endif
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
            </div>
            <form action="{{ route('import.data1') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5>&nbsp;&nbsp;&nbsp;Importation de la table Mode paiement</h5>
                <div class="row">
                    <div class="row section">
                        <div class="col s12 m8 l9">
                            <input type="file" id="input-file-now" name="file" class="dropify" data-default-file="" />
                        </div>
                        <div class="col s12 m4 l3">
                            <button id="" type="submit" class="btn bcyan waves-effect waves-light right"
                                type="submit">Importer
                                <i class="material-icons right">save</i>
                            </button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection
