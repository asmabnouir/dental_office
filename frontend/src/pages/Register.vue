<template>
  <div class="page-header clear-filter" filter-color="grey">
    <div
      class="page-header-image"
      style="background-image: url('img/GSD_login.jpg')"
    ></div>
    <div class="content">
      <div class="container">
        <div class="col-md-5 ml-auto mr-auto">
          
          <card  type="login" plain>
            <div slot="header" class="logo-container">
              <img v-lazy="'img/Logo.png'" alt="" />
            </div>

            <fg-input
              v-model="user.name"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons users_circle-08"
              placeholder=" Nom et prenom ..."
            >
            </fg-input>

            <fg-input
              v-model="user.email"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons users_circle-08"
              placeholder=" E mail..."
            >
            </fg-input>

            <fg-input
              v-model="user.password"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons text_caps-small"
              placeholder="Mot de passe ..."
            >
            </fg-input>
            <fg-input
            v-model="user.password_confirmation"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons text_caps-small"
              placeholder="Confirmation mot de passe ..."
            >
            </fg-input>

            <template slot="raw-content">
              <div class="card-footer text-center">
                <a
                  @click.prevent="register()"
                  class="btn btn-primary btn-round btn-lg btn-block"
                  >Enregistrer</a
                >
              </div>
              <alert
              v-if="error"
              type="primary alert" dismissible>
                <div class="alert-icon">
                      <i class="now-ui-icons ui-2_like"></i>
                    </div>
                    <strong>Oups! , {{warningMsg}}</strong>
              </alert>
              <div class="pull-left">
                <h5 >
                  <router-link :to="{ name: 'login'}">
                    <a class="link footer-link">Login</a>
                  </router-link>
                </h5>
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
import axios from 'axios';
export default {
  name: 'Register-page',
  bodyClass: 'login-page',
  components: {
    Card,
    MainFooter,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput
  },
    data(){
      return {
          user:{
            name:"",
            email:"",
            password:"",
            password_confirmation:"",
        },
          error: false,
          errors: false,
          success: false
      }
    },
    methods:{
        register(){
           axios.post('http://localhost:8000/api/auth/register',{
             name:this.user.name,
            email:this.user.email,
            password:this.user.password,
            password_confirmation: this.user.password_confirmation,
        }).then(response =>{
          this.$router.push({ name: 'login'});
        }).catch(error=>{
         if (error.response) {
                this.error=true;
                switch (error.response.status) {
                  case 401 :
                  this.warningMsg= 'Email ou mot de passe incorrect';
                  break;
                  default: this.warningMsg= "La connexion n'a pu être établie "
                  }
              }
        })
      }
    }

};
</script>
<style scoped >
.pull-left{
margin-top: 30px; 
}
fg-input{
  padding: 20px;
}
</style>
