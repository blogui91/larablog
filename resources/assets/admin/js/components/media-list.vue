<style lang="scss">
.media-list-component{
      .header{
        padding: 24px;
      }
    
    //Componente modal
    .modal{
        .preview{
            background-position: center center;
            background-repeat : no-repeat;
            background-size: cover;
            height:90px;
            width: 150px;
        }

        .modal-body{
            .images-list{
                img{
                    width: 150px;
                    height: 85px;
                }
            }
        }

        .modal-dialog{
            width: initial;
        }

        @media screen and (max-width: 600px){
            .modal-dialog {
                max-width: 90%;
                margin: 30px auto;
            }
        }

        @media screen and (min-width: 768px){
            .modal-dialog {
                max-width: 80%;
                margin: 30px auto;
            }
        }

    }




    .uploaded-photos{
        .thumbnail{
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            width:150px;
            height: 150px;
            position:relative;
            .caption{
                position: absolute;
                bottom: 0;
                right: 0;
            }
        }

         .panel{
            .panel-body{
                text-align: center;
                padding: 0;
                max-height: 350px;
                overflow-y: auto;    
            }
        }
    }

    .load-images , .item{
        max-width: 150px;
        display: inline-block;
        margin: 5px;
        .thumbnail{
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            width:150px;
            height: 150px;

        }

        .progress{
            margin-top: -14px;
            margin-bottom: 0px;
            height: 10px;
        }
    }

    .absolute{
        position: absolute;
    }

    .relative{
        position : relative;
    }

    .bottom{
        bottom: 0;
        width:100%;
    }

    .pending-uploads{
        .thumbnail{
            width: 60px;
            height: 60px;
            margin-bottom: 0;
        }
    }

}

</style>
<template>
	<div class="media-list-component" id="media-list-component">
        <div class="header">
            <button type="button" class="btn btn-primary" @click="updateList">Actualizar lista</button>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#medialist-add" @click="openModal">
                <span class="fa fa-picture-o left"></span> Biblioteca 
            </button>
        </div>
       
        <div class="modal fade" id="medialist-add"  role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Subir nueva imagen</h4>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-sm-12 col-md-4"> 

                                <input type="file" @change="loadImage" accept="image/*" required multiple>
                                <div class="pending-uploads">
                                     <div class="panel panel-default" v-if="new_images.length > 0">
                                        <div class="panel-heading">Subidas pendientes</div>
                                        <div class="panel-body" >
                                            <div class="load-images relative" v-for="(image,index) in new_images">
                                                <div class="thumbnail" :style="{'background-image' : 'url('+image.src+')'}" >
                                                  <img :src="image.src" class="hide" width="150" height="150" alt="">
                                                  <button style="font-size:8px;" type="button" v-if="image.hasError" class="btn btn-xs btn-danger" @click="tryAgain(image.src)">Reintentar</button>
                                                  <button style="font-size:8px;" type="button" v-if="image.hasError" class="btn btn-xs btn-warning" @click="discard(image.src)">Descartar</button>

                                                </div>
                                                <div class="absolute bottom" v-if="image.is_sending">
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                                            <span class="sr-only">45% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                <div v-if="newImagesList.length > 0">
                                    <p>Files:</p>
                                    
                                    <div class="images-list" v-for="img in newImagesList">
                                        <div class="preview" style="{'background-image' : 'url('+ img.src +')' }">
                                            <img class="hide" :src="img.src" alt="">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-12 col-md-8">
                                <div class="uploaded-photos">
                                  <div class="panel panel-default">
                                      <!-- <div class="panel-heading"> Imagenes subidas</div> -->
                                      <div class="panel-body">
                                          <div class="item" v-for="media in imagesList">
                                            <div class="thumbnail" :style="{'background-image' : 'url('+media.url+')'}" >
                                              <img :src="media.url" class="hide" width="150" height="150" :alt="media.alt_text">
                                              <div class="caption center">
                                                <!-- <p class="hide" v-text="media.description"><p/> -->
                                                <p class="center">
                                                  <input type="text" :value="media.url" class="hide">
                                                  <a class="btn btn-primary btn-xs" data-dismiss="modal" :data-clipboard-text="media.url" clipboard-button><i class="fa fa-clipboard" aria-hidden="true"></i></a>
                                                </p> 
                                              </div>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import MultimediaService from '../services/MultimediaService'
var Multimedia = new MultimediaService();
  export default {
    data() {
      return{
        medias : [],
        new_images : [],
        new_image : {
            src : null,
            description : "Default text",
        },
        modal : {
            active : false,

        }
      }
    },
    methods :{
        openModal(){
            this.modal.active = true
            setTimeout(function() {
                $('#medialist-add').modal('toggle');
            }.bind, 10);
        },
        closeModal(){
             setTimeout(function() {
                $('#medialist-add').modal('toggle');
            }.bind, 10);
        },
        tryAgain(src){
            var index = this.new_images.map(i => i.src).indexOf(src);

            if(index > -1){
                var file = this.new_images[index];
                this.uploadFiles([file]);
            }

        },
        discard(src){
            console.log(src)
            this.new_images = this.new_images.filter(img => img.src != src)
        },
        initClipboard(){
            setTimeout(()=>{
                var elements = document.querySelector('[clipboard-button]');
                var clipboard = new Clipboard(elements);

                clipboard.on('success', function(e) {
                    console.info('Text:', e.text);
                    e.clearSelection();
                });

                clipboard.on('error', function(e) {
                     console.error('Trigger:', e.trigger);
                }); 
            },1000) 
        },
        updateList(){
            this.getList();
        },
        getList(){
            let medias =  Multimedia.grid(r =>{
                console.log(r)
                this.medias = r
            });

            
            console.log(medias)
            this.initClipboard()
        },
        loadImage(evt){
        var vm = this;
        var files = evt.target.files;
        var array_files = [];
        //$('#medialist-add').modal('toggle');
        if(files.length > 0){

            for(var index_img in files){
                if(files[index_img].constructor == File){
                    var file = files[index_img];

                    var new_image = {
                        id : null,
                        src : null,
                        title : "default title",
                        path : null,
                        description : "default description",
                        is_sending : false,
                        hasError : false
                    }
                    var urlCreator = window.URL || window.webkitURL;
                    var imageUrl = urlCreator.createObjectURL(file);
                    new_image.path = file;
                    new_image.src = imageUrl;
                    this.new_images.push(new_image);
                }
            }

            this.uploadFiles();
        }
        },

        uploadFiles(f = []){
            let files = f.length == 0? this.new_images : f;
            let vm = this;
            files.forEach((file,index) => {
                let files_promise = Multimedia.createMultiple(file);
                file.is_sending = true;
                files_promise.then(new_file =>{
                    file.is_sending = false;
                    file.hasError = false;
                    vm.medias.push(new_file)
                    vm.new_images = vm.new_images.filter(f => f.src != file.src); 
                    console.log(new_file);
                }).catch(err =>{
                    file.is_sending = false;
                    file.hasError = true
                });
            })
        }
    },
    mounted(){
        this.getList();
    },
    computed: {
        newImagesList(){
            return this.medias.filter(media =>{
                return media.id == null
            })
        },
        imagesList(){
            return _.orderBy(this.medias,['created_at'], ['desc'])
        }

    }
  }
</script>