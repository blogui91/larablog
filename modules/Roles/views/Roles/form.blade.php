@extends('Admin.layouts.app')
@section('header')
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Roles / <span style="text-transform: capitalize;">{{$mode}}</span> </h1>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Configuraciones generales</h5>
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.role.'.$mode, $role->id) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="form-group col col-md-6 @if($errors->has('name')) has-error @endif">
                        <label for="name-field">Nombre</label>
                        <input type="text" id="name-field" name="name" class="form-control" value="{{ is_null(old("name")) ? $role->name : old("name") }}"/>
                        @if($errors->has("name"))
                            <span class="help-block">{{ $errors->first("name") }}</span>
                        @endif
                    </div>

                    <div class="form-group col col-md-6 @if($errors->has('slug')) has-error @endif">
                        <label for="slug-field">Slug</label>
                        <input type="text" id="slug-field" name="slug" class="form-control" value="{{ is_null(old("slug")) ? $role->slug : old("slug") }}"/>
                        @if($errors->has("slug"))
                            <span class="help-block">{{ $errors->first("slug") }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col col-md-6 @if($errors->has('description')) has-error @endif">
                        <label for="description-field">Descripción</label>
                        <textarea name="description" class="form-control" id="description-field" cols="30" rows="10">{{ is_null(old("description")) ? $role->description : old("description") }}</textarea>
                        @if($errors->has("description"))
                            <span class="help-block">{{ $errors->first("description") }}</span>
                        @endif
                    </div>

                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    <a class="btn btn-link " href="{{ route('admin.roles.all') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>
        </div>
    </div>

    {{--<div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Cambiar contraseña</h5>
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.role.'.$mode, $role->id) }}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col col-md-6 col-sm-12 @if($errors->has('password')) has-error @endif">
                        <label for="password-field">Nombre</label>
                        <input type="text" id="password-field" name="password" class="form-control" value="{{ is_null(old("password")) ? $role->password : old("password") }}"/>
                        @if($errors->has("password"))
                        <span class="help-block">{{ $errors->first("password") }}</span>
                        @endif
                    </div>
                    <div class="form-group col col-md-6 col-sm-12 @if($errors->has('password_confirm')) has-error @endif">
                        <label for="password_confirm-field">Nombre</label>
                        <input type="text" id="password_confirm-field" name="password_confirm" class="form-control" value="{{ is_null(old("password_confirm")) ? $role->password_confirm : old("password_confirm") }}"/>
                        @if($errors->has("password_confirm"))
                        <span class="help-block">{{ $errors->first("password_confirm") }}</span>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div> --}}
@endsection
