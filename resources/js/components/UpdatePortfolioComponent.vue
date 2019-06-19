
<template>
    <div class="container-fluid mt-5">
        <div class="card">

              <div class="card-header">
                <h3 class="card-title">Edit Porfolio</h3>
              </div>

                <form enctype="multipart/form-data" >
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
                            <textarea v-model="form.description" type="text" placeholder="Enter Description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"> </textarea>
                            <has-error :form="form" field="description"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Project Info</label>
                            <textarea v-model="form.project_info" type="text" placeholder="Enter Project Info"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('project_info') }"> </textarea>
                            <has-error :form="form" field="project_info"></has-error>
                        </div>

                        </div>

                        <div class="col-12 col-md-3">
                          <div class="form-group">
                            <label>Client</label>
                            <input v-model="form.client" type="text" placeholder="Enter Client"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('client') }">
                            <has-error :form="form" field="client"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Website</label>
                            <input v-model="form.website" type="text"  placeholder="Enter Website"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('website') }">
                            <has-error :form="form" field="website"></has-error>
                        </div>

                            <div class="form-group">
                                <label>Completed</label>
                                <input v-model="form.completed" type="date" placeholder="Date Completed"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('completed') }">
                                <has-error :form="form" field="completed"></has-error>
                            </div>


                            <input v-model="form.f_image" type="text" placeholder="Image"
                                    class="form-control">
                            
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
                         <button @click.prevent="UpdatePortfolio" type="submit" class="btn btn-primary float-right mx-2">Update</button>
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
                    id: '',
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
            let f_image = (this.form.f_image.length > 200) ? this.form.f_image : "img/featured-image/" + this.form.f_image;
              return f_image;
            },
            UpdatePortfolio(){
                this.$Progress.start();
                let id = this.$route.params.id;
                this.form.put('/api/portfolio/'+id)
                .then(() => {
                Swal.fire(
                  'Updated!',
                  'Info has been updated.',
                  'success'
                )
                this.$Progress.finish();
                })
                .catch(() => {
                this.$Progress.fail();
                });

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
            }
        },
        created(){
            let id = this.$route.params.id;
            axios.get('/api/portfolio/'+id).then((response) => (this.form.fill(response.data)) );
    }
}
</script>
