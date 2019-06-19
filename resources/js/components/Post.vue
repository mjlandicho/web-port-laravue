<template>
    <div class="container-fluid mt-5">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Portfolios</h3>

                <div class="card-tools">                 
                       <router-link to="/create-post" class="btn btn-primary"><i class="fas fa-plus-circle fw"></i> Create Post</router-link>                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-auto">
                <table class="table table-hover table-bordered">
                  
                    <thead class="thead-dark">
                    <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Body</th>
                    <th class="text-center">Modify</th>
                  </tr>
                    </thead>
                  <tbody>
                  <tr v-for="post in posts" :key="post.id" >
                    <td>{{post.id}}</td>
                    <td>{{post.title}}</td>
                    <!-- <td><img class="img-fluid" style="max-height:50px" v-bind:src="'/img/featured_image/' + portfolio.f_image" alt=""></td> -->
                    <td>{{post.image}}</td>
                    <td>{{post.body}}</td>
                    <td class="text-center p-auto">
                      <a href="#" class="btn btn-primary">
                        <i class="fas fa-eye"></i>
                      </a>
                    <router-link class="btn btn-success" :to="{name: 'update-post', params: {id:post.id}}">
                        <i class="fas fa-edit blue"></i>
                    </router-link>
                      <a href="#" class="btn btn-danger" @click="deletePost(post.id)">
                        <i class="fas fa-trash red"></i>
                      </a>
                    </td>
                  </tr>
                </tbody></table>
              </div>
              <!-- /.card-body -->
            </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
              posts:{}
            }
        },
        methods:{
                deletePost(id){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => { 

                if (result.value) {
                //SEND REQUEST
                    axios.delete('api/post/'+id).then(()=>{
                    //  if (result.value) {
                    Fire.$emit('afterModify');
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                        )
                    //  }
                    }).catch(() => {
                    Swal.fire('Failed','There is something wrong','warning')
                    });
                }
              })
            },
            loadPost(){
            let app = this;
            axios.get('api/post').then((response) => {
                app.posts = response.data;
            }).catch(() => {
                console.log(response);
                alert("Could not load companies");
            });
          }
        },
        created(){
            this.loadPost();
            Fire.$on('afterModify', () => {
              this.loadPost();
            })
        }
    }
</script>
