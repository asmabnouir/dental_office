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
    <tabs-section id="services"  v-show="!$store.state.isLoggedIn || $store.state.role ==='client'" ></tabs-section>
    <calendar id="calendar"></calendar>
        <div
    class="navigation-example"
    style="background-image:url('img/GSD_2.jpg');
            background-attachment: fixed;"
  ></div>
    <contact id="contact"  v-show="!$store.state.isLoggedIn || $store.state.role ==='client'" ></contact>

  </div>
</template>
<script>
import { Parallax } from '@/components';
import TabsSection from './components/Tabs';
import Calendar from './components/Calendar';
import Contact from './components/Contact';
import axios from 'axios';
import {setCookie} from "../helpers";

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
      }).catch(
        error=>{
        if(error.response.status == 401){
        alert("Votre session a expirée. Veuillez vous reconnecter ");
        //this.$root.$emit("logout") //if the token will expired I logout
         this.$store.commit('logout');
            this.$store.state.role = "";
            this.$router.push({name: 'login', params: {logoutState: true , message: "Veuillez vous reconnecter"} });
            this.$store.state.isLoggedIn = false;
        }
        })
          },

  },
  created(){
      if (this.$store.getters.isLoggedIn) {
         this.getUser();
      }
    },

};
</script>
<style Scoped lang="scss">
   .navigation-example{
          min-height: 500px !important;
      }
</style>
