@extends('Admin.layouts.app')
@section('header')
@endsection

@section('content')
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-plus"></i> Multimedia / <span style="text-transform: capitalize;">{{$mode}}</span> </h1>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Configuraciones generales</h5>
        </div>
        <div class="panel-body">
            <form enctype='multipart/form-data' action="{{ route('admin.multimedia.'.$mode, $multimedia->id) }}" method="POST">

                
            {{-- $table->string('title',255);
            $table->string('mime_type');
            $table->string('dimensions')->nullable();
            $table->longText('description')->nullable();
            $table->longText('alt_text')->nullable();
            $table->integer('uploaded_by')->nullable(); --}}


                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                    <div class="form-group col col-md-6 @if($errors->has('title')) has-error @endif">
                        <label for="title-field">Title</label>
                        <input type="text" id="title-field" name="title" class="form-control" value="{{ is_null(old("title")) ? $multimedia->title : old("title") }}"/>
                        @if($errors->has("title"))
                            <span class="help-block">{{ $errors->first("title") }}</span>
                        @endif
                    </div>

                    <div class="form-group col col-md-6 @if($errors->has('description')) has-error @endif">
                        <label for="description-field">Description</label>
                        <input type="text" id="description-field" name="description" class="form-control" value="{{ is_null(old("description")) ? $multimedia->description : old("description") }}"/>
                        @if($errors->has("description"))
                            <span class="help-block">{{ $errors->first("description") }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col col-md-6 @if($errors->has('alt_text')) has-error @endif">
                        <label for="alt_text-field">Alternative text</label>
                        <textarea name="alt_text" class="form-control" id="alt_text-field" cols="30" rows="10">{{ is_null(old("alt_text")) ? $multimedia->alt_text : old("alt_text") }}</textarea>
                        @if($errors->has("alt_text"))
                            <span class="help-block">{{ $errors->first("alt_text") }}</span>
                        @endif
                    </div>

                     <div class="form-group col col-md-6 @if($errors->has('path')) has-error @endif">
                        <label for="path-field">Archivo</label>
                        <input type="file" accept="image/*" id="path-field" name="path" class="form-control" value="{{ is_null(old("path")) ? $multimedia->path : old("path") }}"/>
                        @if($errors->has("path"))
                            <span class="help-block">{{ $errors->first("path") }}</span>
                        @endif
                    </div>

                </div>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    <a class="btn btn-link " href="{{ route('admin.multimedias.all') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>


          {{-- @if($mode == 'update')
            <div style="width: 420px;">
                <img src="{{$multimedia->path}}" id="editimg" style="width: 100%;" alt="">
            </div>
          @endif   --}}
        </div>
    </div>

    {{--<div class="panel panel-primary">
        <div class="panel-heading">
            <h5 class="panel-title">Cambiar contraseña</h5>
        </div>
        <div class="panel-body">
            <form action="{{ route('admin.multimedia.'.$mode, $multimedia->id) }}" method="POST">
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col col-md-6 col-sm-12 @if($errors->has('password')) has-error @endif">
                        <label for="password-field">Nombre</label>
                        <input type="text" id="password-field" name="password" class="form-control" value="{{ is_null(old("password")) ? $multimedia->password : old("password") }}"/>
                        @if($errors->has("password"))
                        <span class="help-block">{{ $errors->first("password") }}</span>
                        @endif
                    </div>
                    <div class="form-group col col-md-6 col-sm-12 @if($errors->has('password_confirm')) has-error @endif">
                        <label for="password_confirm-field">Nombre</label>
                        <input type="text" id="password_confirm-field" name="password_confirm" class="form-control" value="{{ is_null(old("password_confirm")) ? $multimedia->password_confirm : old("password_confirm") }}"/>
                        @if($errors->has("password_confirm"))
                        <span class="help-block">{{ $errors->first("password_confirm") }}</span>
                        @endif
                    </div>
                </div>

            </form>
        </div>
    </div> --}}
@endsection



@section('my-scripts')
    <script>

        var image = document.querySelector('img#editimg');
        var cropper = new Cropper(image, {
          aspectRatio: 16 / 9,
          zoomOnTouch : false,
          crop: function(e) {
            console.log(e.detail.x);
            console.log(e.detail.y);
            console.log(e.detail.width);
            console.log(e.detail.height);
            console.log(e.detail.rotate);
            console.log(e.detail.scaleX);
            console.log(e.detail.scaleY);
          }
          });
    </script>
@endsection