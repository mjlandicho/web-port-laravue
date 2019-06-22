<template>
    <div class="container-fluid mt-5">
        <div class="card">
              <div class="card-header">
                <h2 class="card-title m-0 py-2"> <strong> Portfolios </strong></h2>

                <div class="card-tools">                 
                       <router-link to="/create-portfolio" class="btn btn-primary btn-lg"><i class="fas fa-plus-circle fw"></i> Add Portfolio</router-link>                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-auto">
                <table class="table table-hover table-bordered">
                  
                    <thead class="thead-dark">
                    <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Featured Image</th>
                    <th>Description</th>
                    <th>Project Info</th> 
                    <th>Client</th>
                    <th>Website</th>
                    <th>Completed</th>
                    <th class="text-center">Modify</th>
                  </tr>
                    </thead>
                  <tbody>
                  <tr v-for="portfolio in portfolios" :key="portfolio.id" >
                    <td>{{portfolio.id}}</td>
                    <td>{{portfolio.title}}</td>
                    <td><img class="img-fluid" style="max-height:50px" v-bind:src="'/img/featured_image/' + portfolio.f_image" alt=""></td>
                    <td>{{portfolio.description | truncate}}</td>
                    <td>{{portfolio.project_info}}</td>
                    <td>{{portfolio.client}}</td>
                    <td>{{portfolio.website | upText}}</td>
                    <td>{{portfolio.completed | date}}</td>
                    <td class="text-center p-auto">
                      <router-link href="#" class="btn btn-primary" :to="{name: 'view-portfolio', params: {id:portfolio.id}}" >
                        <i class="fas fa-eye"></i>
                      </router-link>
                    <router-link class="btn btn-success" :to="{name: 'update-portfolio', params: {id:portfolio.id}}">
                        <i class="fas fa-edit blue"></i>
                    </router-link>
                      <a href="#" class="btn btn-danger" @click="deletePortfolio(portfolio.id)">
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
              portfolios:{}
            }
        },
        methods:{
          addPort(){
            alert('modal');
          },
          deletePortfolio(id){
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
                    axios.delete('api/portfolio/'+id).then(()=>{
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
          loadPortfolio(){
            axios.get('/api/portfolio').then(({data}) => (this.portfolios = data.data));
          }
        },  
        created() {
            this.loadPortfolio();
            Fire.$on('afterModify', () => {
              this.loadPortfolio();
            })
        }
      }

</script>
