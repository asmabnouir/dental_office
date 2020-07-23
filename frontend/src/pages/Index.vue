<template>
  <div>
    <div class="page-header clear-filter" filter-color="grey">
      <parallax
        class="page-header-image"
        style="background-image:url('img/GSD_3.jpg')"
      >
      </parallax>
      <div class="container">
        <div class="content-center brand">
          <img class="n-logo" src="" alt="" />
          <h1 class="h1-seo">Grand Street Dental</h1>
          <h3>Mon beau cabinet dentaire</h3>
        </div>
      </div>
    </div>
    <tabs-section id="services"></tabs-section>
    <calendar id="calendar"></calendar>
        <div
    class="navigation-example"
    style="background-image:url('img/GSD_2.jpg');
            background-attachment: fixed;"
  ></div>
    <contact id="contact"></contact>

  </div>
</template>
<script>
import { Parallax } from '@/components';
import TabsSection from './components/Tabs';
import Calendar from './components/Calendar';
import Contact from './components/Contact';
import axios from 'axios';

export default {
  name: 'index',
  bodyClass: 'index-page',
  components: {
    Parallax,
    TabsSection,
    Calendar,
    Contact
  },
  methods:{
  getUser(){
      axios.post('http://localhost:8000/api/auth/me',{token:this.$store.getters.token}).then(response =>{
      //console.log(response.data);
       this.$store.state.userId = response.data.id;
       this.$store.state.role = response.data.role
      }).catch(error=>{
      console.log(error.message );
      })
  },
  },
  created(){
      console.log("token before log in : "+ this.$store.getters.token);
      if (this.$store.getters.isLoggedIn) {
        console.log("token after log in : "+ this.$store.getters.token);
         this.getUser();
         //document.cookie= "token=" + axios.defaults.headers.Authorization;
         //console.log("this is the headers: "+ document.cookie);
      }
    }
};
</script>
<style Scoped lang="scss">
   .navigation-example{
          min-height: 500px !important;
      }
</style>
