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


    </template>
  </navbar>
</template>

<script>
import { DropDown, NavbarToggleButton, Navbar, NavLink } from '@/components';
import { Popover } from 'element-ui';
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
    [Popover.name]: Popover
  }
};
</script>

<style scoped></style>
