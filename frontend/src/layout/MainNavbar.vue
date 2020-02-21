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
          <router-link :to="{ name: 'login', params: {} }">
            <a
            class="nav-link"
            target="_blank"
          >
            <i class="now-ui-icons users_circle-08"></i>
          </a>
        </router-link>
        </li>
        <li class="nav-item" @click.prevent="logout()">
            <n-button type="primary" outline round>
            <i class="fa fa-heart"></i> with icon
            </n-button>
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
      }
    },
  methods:{
    logout(){
        Bus.$on(token,
        document.cookie = token +'=; Max-Age=-99999999;'
        );
       //this.$router.push("/login");
        console.log("logout function");
      }
    }
};
</script>

<style scoped></style>
