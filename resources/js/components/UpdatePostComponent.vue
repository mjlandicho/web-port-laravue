
<template>
    <div class="container-fluid mt-5">
        <div class="card">

              <div class="card-header">
                <h3 class="card-title">Update Post</h3>
              </div>

                <form @submit.prevent="updatePost" enctype="multipart/form-data" >
                <div class="card-body">

                    <div class="row">
                        <div class="col-12 col-md-12">

                        <div class="form-group">
                            <label>Title</label>
                            <input v-model="form.title" type="text" name="title" id="title" placeholder="Enter Title"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('title') }">
                            <has-error :form="form" field="title"></has-error>
                        </div>

                          <div class="form-group">
                            <label>Image</label>
                            <input v-model="form.image" type="text" name="image" id="image" placeholder="Enter Image"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('image') }">
                            <has-error :form="form" field="image"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Body</label>
                            <textarea v-model="form.body" type="body" name="body" placeholder="Enter Description"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('body') }"> </textarea>
                            <has-error :form="form" field="body"></has-error>
                        </div>
                            <!-- <div class="form-group">
                                <label for="inputPS">Featured Image</label>
                                <input type="file" id="inputPS"  v-if="uploadReady"  placeholder="Profile Picture" @change="featuredImage">
                                 <img class="img-fluid mt-2" :src="getFeatureImage()">
                            </div> -->
                    </div>
                </div>
            </div>           
                    <!-- card footer -->
                    <div class="card-footer">
                         <button type="submit" class="btn btn-success float-right mx-2">Create</button>
                         <router-link to="/post" type="button" class="btn btn-danger float-right mx-2">Back</router-link>
                    </div>
                </form>
            </div>
        </div>
</template>

<script>
    export default {
        data(){
            return {
                // postId: null,
                // uploadReady: true,
                form: new Form({
                    id:'',
                    title: '',
                    image: '',
                    body: '',
                })
            }
        },
        methods:{
   
        },
        created() {
            let id = this.$route.params.id;
            axios.get('/api/post/' + id)
                .then((response) => { 
                    this.form.fill(response.data);
                });
        }
    }
</script>
