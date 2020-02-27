<template>
  <navbar
    position="fixed"
    type="primary"
    :transparent="transparent"
    :color-on-scroll="colorOnScroll"
    menu-classes="ml-auto"
  >
    <template slot-scope="{ toggle, isToggled }">
      <router-link v-popover:popover1 class="navbar-brand" to="/">
      Grand Street Dental
      </router-link>
    </template>
    <template slot="navbar-menu">
      <li v-if="$route.name === 'index' " class="nav-item">
        <a
          class="nav-link"
          href="#services"
        >
          <p>Services</p>
        </a>
      </li>
      <li v-if="$route.name === 'index' "  class="nav-item">
        <a
          class="nav-link"
          href="#calendar"
        >
          <p>Prendre RDV</p>
        </a>
      </li>
      <li v-if="$route.name === 'index' "  class="nav-item">
        <a
          class="nav-link"
          href="#contact"
        >
          <p>Contact</p>
        </a>
      </li>
        <li class="nav-item">
            <a
            class="nav-link "
            target="_blank"
          >
            <router-link :to="{ name: 'login' }"  v-if="!this.$store.state.isLoggedIn" >
            <i class="now-ui-icons users_circle-08"></i>
            <a> login</a>
           </router-link>
            <div v-else >
              <i class="now-ui-icons users_circle-08"></i>
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
import { Bus } from '../main';

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
            console.log(response.data.message);
            this.logoutMsg = response.data.message;
           this.$store.commit('logout');
           this.$router.push({name: 'login', params: {logoutState: true , message: this.logoutMsg} });
          }),
          console.log( this.$store.state.isLoggedIn +"  // logout function");
        }
    }
};
</script>

<style scoped>
.profile{
  display:flex;
  
}
</style>
