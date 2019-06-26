
<template>
    <div class="container-fluid mt-5">
        <div class="card">

              <div class="card-header">
                <h2 class="card-title m-0"><strong> Create Porfolio </strong></h2>
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

                        <div class="form-group">
                            <label>Project Info</label>
                            <textarea v-model="form.project_info" type="text" name="project_info" placeholder="Enter Project Info"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('project_info') }"> </textarea>
                            <has-error :form="form" field="project_info"></has-error>
                        </div>

                        <div id="app" class="form-group">
                            <label>Description</label>
                                <ckeditor :editor="editor" tag-name="textarea" rows="10" v-model="form.description" id="editor" name="description" :class="{ 'is-invalid': form.errors.has('description') }" ></ckeditor>
                                <has-error :form="form" field="description"></has-error>
                            <!-- <textarea :editor="editor" v-model="form.description" type="text" name="description" placeholder="Enter Description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"> </textarea>
                            <has-error :form="form" field="description"></has-error> -->
                        </div>

                        </div>

                        <div class="col-12 col-md-3">
                          <div class="form-group">
                            <label>Client</label>
                            <input v-model="form.client" type="text" name="client" id="client" placeholder="Enter Client"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('client') }">
                            <has-error :form="form" field="client"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Website</label>
                            <input v-model="form.website" type="text" name="website" id="website" placeholder="Enter Website"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('website') }">
                            <has-error :form="form" field="website"></has-error>
                        </div>

                            <div class="form-group">
                                <label>Completed</label>
                                <input v-model="form.completed" type="date" name="completed" id="completed" placeholder="Date Completed"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('completed') }">
                                <has-error :form="form" field="completed"></has-error>
                            </div>
                            
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
                         <button type="submit" class="btn btn-success float-right btn-lg mx-2"> <i class="fas fa-plus-circle"></i> Create</button>
                         <router-link to="/portfolio" class="btn btn-danger float-right btn-lg mx-2"><i class="fas fa-arrow-left"></i> Back</router-link>
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
                    f_image: '',
                    description: '',
                    project_info: '',
                    client: '',
                    website: '',
                    completed: '',
                })
            }
        },
        methods:{
            getFeatureImage(){
              let f_image =  this.form.f_image              
              return f_image;
            },
            featuredImage(e){
                let file = e.target.files[0];
                console.log(file)
                let reader = new FileReader();
                if(file ['size'] < 2111775){
                    reader.onloadend = (file) => {
                    // console.log('RESULT', reader.result)
                    this.form.f_image = reader.result;
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
                this.form.post('api/portfolio')
                .then(() => {
                    Fire.$emit('afterModify');
                    toast.fire({
                        type: 'success',
                        title: 'Porfolio created successfully'
                    })
                    this.form.reset();
                    this.uploadReady = false
                    this.$nextTick(() => {
        	        this.uploadReady = true
                     })
                    this.$Progress.finish()
                    this.$router.push('/portfolio') 
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
