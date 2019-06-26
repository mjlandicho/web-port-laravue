<template>

<!--================Start Portfolio Details Area =================-->
	<section class="portfolio_details_area section-margin">
    <div class="container">
      <div class="row">
        <div class="offset-xl-1 col-xl-10">
          <div class="portfolio_details_inner">

            <div class="row my-5">
              <div class="col-12">
                  <h1 class="mb-3">{{data.title}}</h1>
                  <div class="left_img">
                      <img class="img-fluid" v-bind:src="'/img/featured_image/' + data.f_image" alt="">
                  </div>
              </div>
            </div>

            <div class="row mb-5">
              <div class="col-lg-7 mb-4 mb-lg-0">
                  <div v-html=data.description class="description">

                  </div>
              </div>

              <div class="col-lg-5">
                <div class="portfolio_right_text mt-30">
                    <h4 class="text-uppercase"><strong>Project Info</strong></h4>
                    <p>
                        {{data.project_info}}
                    </p>
                    <ul class="list-unstyled">
                        <li><span>Client</span>: {{data.client}}</li>
                        <li><span>Website</span>: {{data.website}}</li>
                        <li><span>Completed</span>: {{data.completed}}</li>
                    </ul>
                </div>
              </div>
            </div>
            
          </div>

        </div>
      </div>
    </div>
  </section>
  <!--================End Portfolio Details Area =================-->


</template>

<script>
    export default {
        data(){
            return {
              data:{
                    id:"",
                    title: '',
                    f_image: '',
                    description: '',
                    project_info: '',
                    client: '',
                    website: '',
                    completed: '',
              }
            }
        },
        methods:{
         
        },  
        created() {
          let app = this;
           let id = app.$route.params.id;
           axios.get('/api/portfolio/'+id).then((response) => (app.data = response.data)); 
        }
      }

</script>
