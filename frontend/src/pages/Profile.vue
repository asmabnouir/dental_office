<template>
  <div>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class="page-header-image"
        style="background-image:url('img/GSD_profile.jpg')"
      >
      </parallax>
      <div class="container ProfileTitle">
        <h3 class="title">Ryan Scheinder</h3>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div class="row ">
          <div class="col-lg-5 col-md-12">
            <h3 class="title">Données de compte </h3>
            <div class="">
              <p>Votre ID :</p>
                <fg-input placeholder="num ID: 02586547125"></fg-input>
            </div>
            <div class="">
              <p>Votre Mail:</p>
              <fg-input placeholder="mail: mail@mail.com"></fg-input>
            </div>
            <div class="">
              <p>Votre Mail:</p>
                <fg-input placeholder="password: ......"></fg-input>
            </div>
          </div>
          <div class="col-lg-5 col-md-12">
            <h3 class="title">Données de patient</h3>
            <div style="margin-bottom:50px">
              <p>Votre Age :</p>
                <fg-input placeholder="20"></fg-input>
            </div>
            <div class="">
              <p>Problème de santé à signaler :</p>
              <textarea
                class="form-control"
                name="name"
                rows="4"
                cols="80"
                v-model="form.message"
                placeholder="Ecrire voter message ..."
              ></textarea>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {FormGroupInput} from '@/components';
export default {
  name: 'profile',
  bodyClass: 'profile-page',
  components: {
    [FormGroupInput.name]: FormGroupInput,
  },
  data() {
    return {
      form: {
        firstName: '',
        email: '',
        message: ''
      }
    }
  },
};
</script>
<style scoped media="scss">
.row{
  justify-content: space-around !important;
}
.ProfileTitle{
  margin-top: 100px;
}
</style>
