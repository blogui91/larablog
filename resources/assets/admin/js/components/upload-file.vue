<style lang="scss">
.upload-file-component{
	.input-file ,.input-text{
		display: inline-block;
		width:100%;
		input{
			width: 100%;
		}
	}
}
</style>
<template>
	<div class="upload-file-component">
		<div class="row">
			<div class="col col-sm-12">
				<div class="input-file" v-if="!urlString">
					<label for="blob-file"></label>
					<input type="file" accept="image/*" id="blob-file" name="image" class="form-control">
				</div>
				<div class="input-text" v-else>
					<label for="url-string">URL</label>
					<input type="text" id="url-string" placeholder="Write your URL" class="form-control" v-model="path" name="image">
				</div>
				<div class="checkbox">
                    <label>  
                        <input type="checkbox" v-model="urlString"> Paste Url
                    </label>
                </div>
			</div>
		</div>
	</div>
</template>
<script>
  export default {
  	props : ['url'],
    data() {
      return{
      	urlString: false
      }
    },
    methods :{
     
    },
    mounted(){
    	console.log("upload-file-component loaded!")
    	this.path = _.cloneDeep(this.url)
    }
  }
</script>