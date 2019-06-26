
<template>
    <div class="container-fluid mt-5">
        <div class="card">

              <div class="card-header">
                <h3 class="card-title">Create Post</h3>
              </div>

                <form @submit.prevent="addPortfolio" enctype="multipart/form-data" >
                        <div class="card-body">

                            <div class="row">
                                <div class="col-12 col-md-9">

                                    <div class="form-group">
                                        <label>Title</label>
                                        <input v-model="form.title" type="text" name="title" id="title" placeholder="Enter Title"
                                            class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                                        <has-error :form="form" field="title"></has-error>
                                    </div>

                                    <div id="app" class="form-group">
                                        <label>Body</label>
                                        <ckeditor :editor="editor" tag-name="textarea" v-model="form.body" name="body" :class="{ 'is-invalid': form.errors.has('body') }" ></ckeditor>
                                        <has-error :form="form" field="body"></has-error>
                                    </div>

                                </div>

                                 <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="inputPS">Featured Image</label>
                                        <input type="file" id="inputPS"  v-if="uploadReady"  placeholder="Profile Picture" @change="featuredImage">
                                        <img class="img-fluid mt-2" :src="getFeatureImage()">
                                    </div>
                            </div>
                        </div>
                    </div>           
                    <!-- card footer -->
                    <div class="card-footer">
                         <button type="submit" class="btn btn-success float-right mx-2">Create</button>
                         <router-link to="/post" class="btn btn-danger float-right mx-2">Back</router-link>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
 import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
         name: 'app',
        data(){
            return {
                editor: ClassicEditor,
                // editorData: '<p>Rich-text editor content.</p>',
                editorConfig: {
                    // The configuration of the rich-text editor.
                    
                },
                uploadReady: true,
                form: new Form({
                    title: '',
                    image: '',
                    body: '',
                })
            }
        },
        methods:{
            getFeatureImage(){
              let image =  this.form.image              
              return image;
            },
            featuredImage(e){
                let file = e.target.files[0];
                console.log(file)
                let reader = new FileReader();
                if(file ['size'] < 2111775){
                    reader.onloadend = (file) => {
                    // console.log('RESULT', reader.result)
                    this.form.image = reader.result;
                    }
                reader.readAsDataURL(file);
                }else{
                    Swal.fire({
                    type: 'error',
                    title: 'Oops...',
                    text: 'Please choose lower than 2mb',
                    })
                }
            },
            addPortfolio(){
                this.$Progress.start()
                this.form.post('api/post')
                .then(() => {
                    Fire.$emit('afterModify');
                    toast.fire({
                        type: 'success',
                        title: 'Post created successfully'
                    })
                    this.form.reset();
                    this.uploadReady = false
                    this.$nextTick(() => {
        	        this.uploadReady = true
                     })
                    this.$Progress.finish()
                })
                .catch(() => {
                    this.$Progress.fail()
                })

            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
