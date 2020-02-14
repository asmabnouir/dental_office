<template>
  <div class="page-header clear-filter" filter-color="grey">
    <div
      class="page-header-image"
      style="background-image: url('img/GSD_login.jpg')"
    ></div>
    <div class="content">
      <div class="container">
        <div class="col-md-5 ml-auto mr-auto">
          <card v-if="login" type="login" plain>
            <div slot="header" class="logo-container">
              <img v-lazy="'img/Logo.png'" alt="" />
            </div>

            <fg-input
              class="no-border input-lg"
              addon-left-icon="now-ui-icons users_circle-08"
              placeholder=" Numéro ID..."
            >
            </fg-input>

            <fg-input
              class="no-border input-lg"
              addon-left-icon="now-ui-icons text_caps-small"
              placeholder="Mot de passe ..."
            >
            </fg-input>

            <template slot="raw-content">
              <div class="card-footer text-center">
                <a
                  href="#pablo"
                  class="btn btn-primary btn-round btn-lg btn-block"
                  >Se connecter</a
                >
              </div>
              <div class="pull-left">
                <h6 @click="toogle()">
                  <a class="link footer-link">Cree un compte </a>
                </h6>
              </div>
            </template>
          </card>

          <card v-else type="login" plain>
            <div slot="header" class="logo-container">
              <img v-lazy="'img/Logo.png'" alt="" />
            </div>

            <fg-input
              class="no-border input-lg"
              addon-left-icon="now-ui-icons users_circle-08"
              placeholder=" Nom et prenom ..."
            >
            </fg-input>

            <fg-input
              class="no-border input-lg"
              addon-left-icon="now-ui-icons users_circle-08"
              placeholder=" Numéro ID ..."
            >
            </fg-input>

            <fg-input
              class="no-border input-lg"
              addon-left-icon="now-ui-icons text_caps-small"
              placeholder="Mot de passe ..."
            >
            </fg-input>
            <fg-input
              class="no-border input-lg"
              addon-left-icon="now-ui-icons text_caps-small"
              placeholder="Confirmation mot de passe ..."
            >
            </fg-input>

            <template slot="raw-content">
              <div class="card-footer text-center">
                <a
                  class="btn btn-primary btn-round btn-lg btn-block"
                  >Enregistrer</a
                >
              </div>
              <div class="pull-left">
                <h6 @click="toogle()">
                  <a class="link footer-link">Login</a>
                </h6>
              </div>
            </template>
          </card>

        </div>
      </div>
    </div>
    <main-footer></main-footer>
  </div>
</template>
<script>
import { Card, Button, FormGroupInput } from '@/components';
import MainFooter from '@/layout/MainFooter';
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    Card,
    MainFooter,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput
  },
    data(){
      return {
        login:true,
        register:false,
      }
    },
    methods:{
      toogle(){
          this.login= !this.login
          this.resgister= !this.resgister
      },
    }

};
</script>
<style></style>
