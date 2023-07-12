@extends('layouts.app')

@section('content')
<div class="section">
    <!-- select2 -->

    <div class="col s12 m12 l12">
      <div id="inline-form" class="card card card-default scrollspy">
        <div class="card-content">
                <div class="row">
                    <div class="col s12 m6">
                        <h5>Permissions</h5>
                        @foreach($permissions as $permission)
                        <div class="row">
                            <div class="col s12 m12 l12 ml-2 mt-1">
                                <p>
                                    <label>
                                        <input name="{{$permission->name}}" value="1" type="checkbox" />
                                        <span>{{$permission->libelle}}</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="col s12 m6">
                        <h5>Rôle</h5>
                        @foreach($roles as $role)
                        <div class="row">
                            <div class="col s12 m12 l12 ml-2 mt-1">
                                <p>
                                    <label>
                                        <input name="{{$role->name}}" value="1" type="checkbox" />
                                        <span>{{$role->libelle}}</span>
                                    </label>
                                </p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>





    @endsection

    {{-- vendor script --}}
    @section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
    @endsection

    {{-- page script --}}
    @section('page-script')
    <script src="{{asset('js/scripts/form-select2.js')}}"></script>
    @endsection