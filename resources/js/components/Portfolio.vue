<template>
    <div class="container-fluid mt-5">
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Portfolios</h3>

                <div class="card-tools">                 
                       <router-link to="/modification" class="btn btn-primary"><i class="fas fa-plus-circle fw"></i> Add Portfolio</router-link>                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Featured Image</th>
                    <th>Description</th>
                    <th>Project Info</th>
                    <th>Client</th>
                    <th>Website</th>
                    <th>Completed</th>
                    <th>Modify</th>
                  </tr>

                  <tr v-for="portfolio in portfolios" :key="portfolio.id" >
                    <td>{{portfolio.id}}</td>
                    <td>{{portfolio.title}}</td>
                    <td><img class="img-fluid" style="max-height:50px" v-bind:src="'/img/featured_image/' + portfolio.f_image" alt=""></td>
                    <td>{{portfolio.description}}</td>
                    <td>{{portfolio.project_info}}</td>
                    <td>{{portfolio.client}}</td>
                    <td>{{portfolio.website | upText}}</td>
                    <td>{{portfolio.completed}}</td>
                    <td>
                      <a href="#">
                        <i class="fas fa-eye"></i>
                      </a>
                      |
                    <a href="#">
                        <i class="fas fa-edit blue"></i>
                      </a>
                      |
                      <a href="#">
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
          loadPortfolio(){
            axios.get('api/portfolio').then(({data}) => (this.portfolios = data.data));
          }
        },
        created() {
            this.loadPortfolio();
        }
    }
</script>
