<template>
    <div class="container-fluid mt-5">
        <div class="card">

              <div class="card-header">
                <h3 class="card-title">Add Porfolio</h3>
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
                            <label>Description</label>
                            <textarea v-model="form.description" type="text" name="description" placeholder="Enter Description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('title') }"> </textarea>
                            <has-error :form="form" field="title"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Project Info</label>
                            <textarea v-model="form.project_info" type="text" name="project_info" placeholder="Enter Project Info"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('project_info') }"> </textarea>
                            <has-error :form="form" field="project_info"></has-error>
                        </div>
                        
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

                        </div>

                        <div class="col-12 col-md-3">

                            <div class="form-group">
                                <label>Completed</label>
                                <input v-model="form.completed" type="date" name="completed" id="completed" placeholder="Date Completed"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('completed') }">
                                <has-error :form="form" field="completed"></has-error>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputPS">Featured Image</label>
                                <input type="file" id="inputPS" placeholder="Profile Picture" @change="featuredImage">
                                 <img class="img-fluid mt-2" :src="getFeatureImage()">
                            </div>
                        </div>
                    </div>


                       

                    </div>
                                        
                    <!-- card footer -->
                    <div class="card-footer">
                         <button type="submit" class="btn btn-success float-right mx-2">Create</button>
                         <router-link to="/portfolio" type="button" class="btn btn-danger float-right mx-2">Back</router-link>
                    </div>
                </form>

            </div>
        </div>
</template>

<script>
    export default {
        data(){
            return {
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
              let f_image = (this.form.f_image.length > 200) ? this.form.f_image : "img/featured_image/" + this.form.f_image;
              // return "img/profile/" + this.form.photo;
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
                    alert('error');
                }
            },
            addPortfolio(){
                this.form.post('api/portfolio');
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
