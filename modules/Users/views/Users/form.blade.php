@extends('Admin.layouts.app')
@section('header')
@endsection
@section('content')
<div class="_container">
    <div class="page-header">
        <h1><i class="glyphicon glyphicon-edit"></i> Users / <span style="text-transform: capitalize;">{{$mode}}</span> #{{$user->id}}</h1>
    </div>

    {{json_encode($errors)}}
    <form action="{{ route('admin.user.'.$mode, $user->id) }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col col-md-6 col sm-12">
                <div class="form-group @if($errors->has('first_name')) has-error @endif">
                    <label for="first_name-field">First_name</label>
                    <input type="text" id="first_name-field" name="first_name" class="form-control" value="{{ is_null(old("first_name")) ? $user->first_name : old("first_name") }}"/>
                    @if($errors->has("first_name"))
                    <span class="help-block">{{ $errors->first("first_name") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('last_name')) has-error @endif">
                    <label for="last_name-field">Last_name</label>
                    <input type="text" id="last_name-field" name="last_name" class="form-control" value="{{ is_null(old("last_name")) ? $user->last_name : old("last_name") }}"/>
                    @if($errors->has("last_name"))
                    <span class="help-block">{{ $errors->first("last_name") }}</span>
                    @endif
                </div>
                <div class="form-group @if($errors->has('email')) has-error @endif">
                    <label for="email-field">Email</label>
                    <input type="text" id="email-field" name="email" class="form-control" value="{{ is_null(old("email")) ? $user->email : old("email") }}"/>
                    @if($errors->has("email"))
                    <span class="help-block">{{ $errors->first("email") }}</span>
                    @endif
                </div>
            </div>

            <div class="col col-md-6 col sm-12">
                <div class="form-group @if($errors->has('roles')) has-error @endif">
                    <label for="roles-field">Roles</label>
                    <select name="roles[]" id="roles-field" class="form-control"  multiple>
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" {{array_key_exists($role->id, $user->roles->keyBy('id')->all()) ? ' selected' :'' }}>{{$role->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has("roles"))
                        <span class="help-block">{{ $errors->first("roles") }}</span>
                    @endif
                </div>
            </div>

            <div class="col col-md-6 col sm-12">
                <div class="form-group @if($errors->has('activated')) has-error @endif">
                    <label for="activated-field">Activated</label>
                    <select name="activated" id="activated-field" class="form-control">
                        <option value="0" {{$user->activated? 'selected' : ''}}>No</option>
                        <option value="1" {{$user->activated? 'selected' : ''}}>Yes</option>
                    </select>
                    @if($errors->has("activated"))
                        <span class="help-block">{{ $errors->first("activated") }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="well well-sm">
            <a class="btn btn-link " href="{{ route('admin.users.all') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
            <button type="submit" class="btn btn-primary pull-right">Save</button>
        </div>
    </form>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.0/js/bootstrap-datepicker.min.js"></script>
<script>
</script>
@endsection