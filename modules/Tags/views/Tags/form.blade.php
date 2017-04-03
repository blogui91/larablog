@extends('Admin.layouts.app')
@section('header')
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Tag / <span style="text-transform: capitalize;">{{$mode}}</span> </h1>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Configuraciones generales</h5>
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.tag.'.$mode, $tag->id) }}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="form-group col col-md-6 @if($errors->has('name')) has-error @endif">
                        <label for="name-field">Nombre</label>
                        <input type="text" id="name-field" name="name" class="form-control" value="{{ is_null(old("name")) ? $tag->name : old("name") }}"/>
                        @if($errors->has("name"))
                            <span class="help-block">{{ $errors->first("name") }}</span>
                        @endif
                    </div>

                    <div class="form-group hide col col-md-6 @if($errors->has('slug')) has-error @endif">
                        <label for="slug-field">Slug</label>
                        <input type="text" id="slug-field" name="slug" class="form-control" value="{{ is_null(old("slug")) ? $tag->slug : old("slug") }}"/>
                        @if($errors->has("slug"))
                            <span class="help-block">{{ $errors->first("slug") }}</span>
                        @endif
                    </div>
                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    <a class="btn btn-link " href="{{ route('admin.tags.all') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection
