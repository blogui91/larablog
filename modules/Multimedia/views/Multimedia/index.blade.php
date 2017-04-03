@extends('Admin.layouts.app')

@section('header')
@endsection

@section('content')
    <div class="page-header clearfix">
        <h1>
            <i class="glyphicon glyphicon-align-justify"></i> Multimedia
            <a class="btn btn-success pull-right" href="{{ route('admin.multimedia.create') }}"><i class="glyphicon glyphicon-plus"></i> Create</a>
        </h1>

    </div>
    <div class="row">
        <div class="col-md-12">
            @if($multimedias->count())
                <table class="table table-condensed table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Alternative text</th>
                            <th>Content</th>
                            <th>Uploaded by</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($multimedias as $multimedia)
                            <tr>
                                <td>{{$multimedia->id}}</td>
                                <td>{{$multimedia->title}}</td>
                                <td>{{$multimedia->description}}</td>
                                <td>{{$multimedia->alt_text}}</td>
                                <td>
                                    <img src="{{$multimedia->path}}" height="100" width="150" alt="">
                                </td>
                                <td>
                                    {{$multimedia->uploadedBy->fullname}}
                                </td>
                                <td class="text-right">
                                    <a class="btn btn-xs btn-warning" href="{{ route('admin.multimedia.update', $multimedia->id) }}"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                                    <form action="{{ route('admin.multimedia.delete', $multimedia->id) }}" method="POST" style="display: inline;" onsubmit="if(confirm('Delete? Are you sure?')) { return true } else {return false };">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $multimedias->render() !!}
            @else
                <h3 class="text-center alert alert-info">Empty!</h3>
            @endif

        </div>
    </div>

@endsection