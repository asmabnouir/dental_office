<template>
  <navbar
    position="fixed"
    type="primary"
    :transparent="transparent"
    :color-on-scroll="colorOnScroll"
    menu-classes="ml-auto"
  >
    <template >
      <router-link v-popover:popover1 class="navbar-brand" to="/">
      <div v-if=" $store.state.isLoggedIn && $store.state.role ==='client' && $route.name === 'profile' ">Réserver un Rdv </div>
      <div v-else> Grand Street Dental</div>
      </router-link> 
    </template>
    <template slot="navbar-menu">
      <li v-if="$route.name === 'index' " class="nav-item"  v-show="!$store.state.isLoggedIn || $store.state.role ==='client'" >
        <a
          class="nav-link"
          href="#services"
        >
          <p>Services</p>
        </a>
      </li>
      <li v-if="$route.name === 'index' "  class="nav-item"  v-show="!$store.state.isLoggedIn || $store.state.role ==='client'" >
        <a
          class="nav-link"
          href="#calendar"
        >
          <p>Prendre RDV</p>
        </a>
      </li>
      <li v-if="$route.name === 'index' "  class="nav-item"   v-show="!$store.state.isLoggedIn || $store.state.role ==='client'" >
        <a
          class="nav-link"
          href="#contact"
        >
          <p>Contact</p>
        </a>
      </li>
      <li class="nav-item" v-show="$store.state.isLoggedIn  && $store.state.role ==='client'">
        <router-link :to="{ name: 'profile' }" >
           <a
            class="nav-link "
            target="_blank"
          ><i class="now-ui-icons users_circle-08"></i>
          </a>
        </router-link>
      </li>
        <li class="nav-item">
            <a
            class="nav-link "
            target="_blank"
          >
            <router-link :to="{ name: 'login' }"  v-if="!$store.state.isLoggedIn" >
            <a> login</a>
           </router-link>
            <div v-else >
            <a @click.prevent="logout()" > logout </a>
            </div>
          </a>
        </li>
    </template>
  </navbar>
</template>


<script>
import { DropDown, NavbarToggleButton, Navbar, NavLink } from '@/components';
import { Popover } from 'element-ui';
import {Button} from '../components';
import axios from 'axios';
import { Bus } from '../bus';

export default {
  name: 'main-navbar',
  props: {
    transparent: Boolean,
    colorOnScroll: Number
  },
  components: {
    DropDown,
    Navbar,
    NavbarToggleButton,
    NavLink,
    [Popover.name]: Popover,
     [Button.name]: Button
  },
  data(){
    return{
      logoutMsg:"",
      }
    },
    methods:{
         logout(){
          axios.post('http://localhost:8000/api/auth/logout',{token:this.$store.state.token}).then(response =>{
            //console.log(response.data.message);
            
            this.logoutMsg = response.data.message;
            this.$store.commit('logout');
            this.$store.state.role = "";
            this.$router.push({name: 'login', params: {logoutState: true , message: this.logoutMsg} });
            this.$store.state.isLoggedIn = false;
          })
        }
    },
    mounted(){
    this.$root.$on("logout", () => {
    return this.logout();
    });
    }
};
</script>

<style scoped>
.profile{
  display:flex;
}
a{
  cursor: pointer;
}
</style>
