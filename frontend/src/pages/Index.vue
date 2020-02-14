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
    <contact id="contact"></contact>

  </div>
</template>
<script>
import { Parallax } from '@/components';
import TabsSection from './components/Tabs';
import Calendar from './components/Calendar';
import Contact from './components/Contact';


export default {
  name: 'index',
  bodyClass: 'index-page',
  components: {
    Parallax,
    TabsSection,
    Calendar,
    Contact
  }
};
</script>
<style Scoped lang="scss">
.page-header {

}
</style>
