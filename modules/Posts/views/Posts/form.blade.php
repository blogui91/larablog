@extends('Admin.layouts.app')
@section('header')
@endsection

@section('content')
    <div class="panel panel-default" id="post-form-view">
        <div class="panel-heading">
            <div class="page-header">
                <h1><i class="glyphicon glyphicon-plus"></i> Posts / <span style="text-transform: capitalize;">{{$mode}}</span> </h1>
            </div>
        </div>
        <div class="panel-body">
            <form enctype='multipart/form-data' action="{{ route('admin.post.'.$mode, $post->id) }}" method="POST" novalidate>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="row">
                    <div class="col col-sm-12 col-md-6">
                        <div class="checkbox">
                            <label>  
                                <input name="published" type="checkbox" @if($post->published) checked @else @if(!is_null(old('published'))) checked @endif @endif> Published
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col col-md-6 @if($errors->has('title')) has-error @endif">
                        <label for="title-field">Title</label>
                        <input type="text" id="title-field" name="title" class="form-control" value="{{ is_null(old("title")) ? $post->title : old("title") }}"/>
                        @if($errors->has("title"))
                            <span class="help-block">{{ $errors->first("title") }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col col-md-8 @if($errors->has('description')) has-error @endif">

                        <div class="panel panel-default" id="form-description">
                            <div class="panel-heading">Descripción</div>
                            <div class="panel-body">
                                <textarea id="editor" name="description" class="form-control">{{ is_null(old("description")) ? $post->description : old("description") }}</textarea>
                                {{-- <div id="textarea">
                                </div> --}}
                                @if($errors->has("description"))
                                    <span class="help-block">{{ $errors->first("description") }}</span>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="form-group col col-md-4 @if($errors->has('path')) has-error @endif">
                        <div class="panel panel-default">
                          <div class="panel-heading">Imagen destacada</div>
                          <div class="panel-body">
                                @if($post->image)
                                    <img src="{{$post->image}}" height="100" width="150" alt="">
                                @endif
                                <upload-file url="{{ is_null(old("image")) ? ($post->image? $post->image : 'null'): (old("image")? old("image") : 'null') }}">
                                </upload-file>
                                @if($errors->has("image"))
                                    <span class="help-block">{{ $errors->first("image") }}</span>
                                @endif
                          </div>
                        </div>

                        <div class="panel panel-default">
                          <div class="panel-heading">Categoria</div>
                          <div class="panel-body">
                                <div class="form-group">
                                    <label for="category_id"></label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" {{$post->category_id == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                          </div>
                        </div>

                        <div class="panel panel-default">
                          <div class="panel-heading">Etiquetas</div>
                          <div class="panel-body">
                            <div class="form-group">
                                <label for="tags"></label>
                                <select name="tags[]" id="tags" class="form-control" multiple required>
                                    @foreach($tags as $tag)
                                        <option 
                                            value="{{$tag->id}}"
                                            {{ in_array($tag->id,$post->tag_ids) ? 'selected' : '' }} 
                                        >{{$tag->name}}</option>
                                    @endforeach
                                </select>           
                            </div>
                          </div>
                        </div>

                    </div>
                </div>

                <media-list></media-list>
                


                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                    <a class="btn btn-link " href="{{ route('admin.posts.all') }}"><i class="glyphicon glyphicon-backward"></i> Back</a>
                </div>
            </form>
        </div>
    </div>

@endsection



@section('scripts')

    <script>

        let content = ` {!! $post->description !!} `

        let Form = {
            initView(){

                if(window.location.pathname.indexOf('/admin/posts') > -1){
                    let element = document.querySelector('textarea');

                    if(element){
                        let simplemde = new SimpleMDE({ element });
                        simplemde.value( content )
                    } 

                }
            }
        }

        window.addEventListener('DOMContentLoaded', Form.initView)
       // $(document).ready(function() {





       //      // $('#textarea').summernote({
       //      //     lang : 'es-ES',
       //      //     minHeight: 320,
       //      // });

       //      // $('#editor').trumbowyg({
       //      //         lang: 'es',
       //      //         svgPath : window.location.origin+"/images/icons.svg",
       //      //          btns: [
       //      //             ['viewHTML'],
       //      //             ['formatting'],
       //      //             'btnGrp-semantic',
       //      //             ['superscript', 'subscript'],
       //      //             ['link'],
       //      //             ['insertImage'],
       //      //             'btnGrp-justify',
       //      //             'btnGrp-lists',
       //      //             ['horizontalRule'],
       //      //             ['removeformat'],
       //      //             ['fullscreen'],
       //      //          ],
       //      // });

       //      // $('#textarea').on('summernote.keyup', function(we, e) {
       //      //     var value = $('#textarea').summernote('code')
       //      //     $('textarea[name=description').val(sanatizeHtml(value));

       //      // });

         

       //      // tinyMCE.init({
       //      //     selector:'textarea',
       //      //     height: 500,
       //      //     theme: 'modern',
       //      //     skin: false,
       //      //     plugins: [
       //      //         'advlist autolink lists link image charmap print preview hr anchor pagebreak',
       //      //         'searchreplace wordcount visualblocks visualchars code fullscreen',
       //      //         'insertdatetime media nonbreaking table contextmenu directionality',
       //      //         'template paste textcolor colorpicker textpattern imagetools codesample toc'
       //      //     ],
       //      //     toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
       //      //     toolbar2: 'print preview media | forecolor backcolor | codesample',
       //      //     image_advtab: true,
       //      //     templates: [
       //      //         { title: 'Test template 1', content: 'Test 1' },
       //      //         { title: 'Test template 2', content: 'Test 2' }
       //      //     ],
       //      //     content_css: [
       //      //         '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
       //      //         '//www.tinymce.com/css/codepen.min.css'
       //      //     ]
       //      //     // menubar : true,
       //      //     // a_plugin_option: true,
       //      //     // a_configuration_option: 400,
       //      //     // plugins: 'image media table spellchecker print code preview importcss imagetools link textcolor ',
       //      //     // toolbar: 'image media table print code preview importcss imagetools link  ',
       //      //     // image_caption: true,
       //      //     // media_live_embeds: true,
       //      //     // imagetools_cors_hosts: ['tinymce.com', 'codepen.io'],
       //      //     // content_css: [
       //      //     // '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
       //      //     // '//cdnjs.cloudflare.com/ajax/libs/prism/0.0.1/prism.css',
       //      //     // ]
       //      // });



       //   $('#title-field')
       //      .on('keydown keyup keypress', function(e) {
       //           var value = e.target.value;

       //           value = value.split(" ")
       //               .join(".");
       //           value = value.split("á")
       //               .join("a");
       //           value = value.split("é")
       //               .join("e");
       //           value = value.split("í")
       //               .join("i");
       //           value = value.split("ó")
       //               .join("o");
       //           value = value.split("ú")
       //               .join("u");
       //           value = value.toLowerCase();

       //           $("#slug-field")
       //               .val(value)

       //      });
       //  });


    </script>
@endsection