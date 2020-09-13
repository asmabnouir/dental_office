<template>
  <div class="page-header clear-filter" filter-color="grey">
    <div
      class="page-header-image"
      style="background-image: url('img/GSD_login.jpg')"
    ></div>
    <div class="content">
      <div class="container">
        <div v-show="this.$route.params.logoutState">
        <alert type="success" dismissible>
          <div class="alert-icon">
              <i class="now-ui-icons ui-2_like"></i>
           </div>
            <strong>{{this.$route.params.message}}</strong>
      </alert>
        </div>
        <div class="col-md-5 ml-auto mr-auto">
          <card type="login" plain>
            <div slot="header" class="logo-container">
              <img v-lazy="'img/Logo.png'" alt="" />
            </div>

            <fg-input
              v-model="user.email"
              name="email"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons users_circle-08"
              placeholder=" E-mail..."
            >
            </fg-input>

            <fg-input
              v-model="user.password"
              name="password"
              class="no-border input-lg"
              addon-left-icon="now-ui-icons text_caps-small"
              placeholder="Mot de passe ..."
            >
            </fg-input>

            <template slot="raw-content">
              <div class="card-footer text-center">
                <a
                 @click.prevent="login()"
                  class="btn btn-primary btn-round btn-lg btn-block"
                  >Se connecter</a
                >
              </div>
              <div class="pull-left">
                <h5>
                  <router-link :to="{ name: 'register'}">
                    <a class="link footer-link">Cree un compte </a>
                  </router-link>
                </h5>
              </div>
            </template>
              <alert
              v-if="error"
              type="primary alert" dismissible>
                <div class="alert-icon">
                      <i class="now-ui-icons ui-2_like"></i>
                    </div>
                    <strong>Oups! , {{warningMsg}}</strong>
              </alert>
          </card>
        </div>
      </div>
    </div>
    <main-footer></main-footer>
  </div>
</template>
<script>
import { Card, Button, FormGroupInput, Alert} from '@/components';
import MainFooter from '@/layout/MainFooter';
import MainNavbar from '@/layout/MainNavbar';
import axios from 'axios';
import { Bus } from '../bus';
import { getLocalUser, setCookie,  getCookie } from "../helpers";

export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    Card,
    MainFooter,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput,
    Alert,
    MainNavbar
  },
    data(){
      return {
        user:{
          email:"",
          password:""
        },
        error:false,
        warningMsg:""
      }
    },
    methods:{
      
       handleToken(){
         if(this.$store.state.isLoggedIn){
           // refresh the token after 50min befor the accees_token is expired in 60 min 
            setTimeout(() => {
              axios.post('http://localhost:8000/api/auth/refresh',{token:this.$store.getters.token})
              .then(response =>{
                setCookie('token', response.data , 30);
                //console.log(response.data.token)
                this.$store.state.token = response.data.token;
                //console.log(response.data);
              //logout 5 min before the refresh token is expired ()
                setTimeout(() => {
                    alert("Votre session a expirée. Veuillez vous reconnecter ");
                     this.$root.$emit("logout") //if the token will expired I logout
                },  1123200000); //for 13 days
                })
            }, 3,6e+6);
         }
       },
      login(){
        if (!this.user.email && !this.user.password ) {
           this.error.push('email or Password required.');
        } else {
          axios.post('http://localhost:8000/api/auth/login',{
            email:this.user.email,
            password:this.user.password
        }).then(response =>{
          setCookie('token', response.data.access_token , 30)
          this.$store.state.token = response.data.access_token;
          this.$store.state.userId = response.data.user.id;
          this.$store.state.role = response.data.user.role;
          this.$store.commit("loginSuccess", response);
          if(this.$store.getters.role === 'admin'){
              this.$router.push({ name: 'index'})
          }else{
              this.$router.push({ name: 'profile'});
          }
          //console.log(response.data);
          //envoyer le token juste après le login 
          this.handleToken()
        }).catch(
              error=>{
                if (error.response) {
                    this.error=true;
                switch (error.response.status) {
                  case 401 :
                  this.warningMsg= 'Email ou mot de passe incorrect';
                  break;
                  default: this.warningMsg= "La connexion n'a pu être établie "
                  }
              }
            });
        }
      },
    },

};
</script>
<style scoped >
.pull-left{
margin-top: 30px; 
}
</styles>