/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



import VueRouter from 'vue-router'
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment';
import VueProgressBar from 'vue-progressbar'
import Swal from 'sweetalert2'
import CKEditor from '@ckeditor/ckeditor5-vue';

// Vue Router
Vue.use(VueRouter)
let routes = [
    { name:'dashboard', path: '/dashboard', component: require('./components/Dashboard.vue').default },
    // portfolio
    { name:'portfolio', path: '/portfolio', component: require('./components/Portfolio.vue').default },
    { name:'create-portfolio', path: '/create-portfolio', component: require('./components/CreatePortfolioComponent.vue').default },
    { name:'update-portfolio', path: '/update-portfolio/:id', component: require('./components/UpdatePortfolioComponent.vue').default },
    { name:'view-portfolio', path: '/view-portfolio/:id', component: require('./components/ViewPortfolioComponent.vue').default },
    // post blog
    { name:'post', path: '/post', component: require('./components/Post.vue').default },
    { name:'create-post', path: '/create-post', component: require('./components/CreatePostComponent.vue').default },
    { name:'update-post', path: '/update-post/:id', component: require('./components/UpdatePostComponent.vue').default },
  ]

  const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })
  

// V- Form
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


// Filter
Vue.filter('upText',function(text){
  return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('truncate', function(value) {
  if (value.length > 20) {
    value = value.substring(0, 17) + '...';
  }
  return value
});

//moment js
Vue.filter('date', function(created){
  return moment(created).format('LL');;
});

//Progress Bar
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '5px'
})


// Sweet alert
window.Swal = Swal;

const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.toast = toast;

//custom event in vue
window.Fire = new Vue();

//ck editor
Vue.use( CKEditor );


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
