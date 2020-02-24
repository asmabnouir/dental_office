<template>
  <div class="page-header clear-filter" filter-color="grey">
    <div
      class="page-header-image"
      style="background-image: url('img/GSD_login.jpg')"
    ></div>
    <div class="content">
      <div class="container">
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
                <h6 >
                  <router-link :to="{ name: 'register'}">
                    <a class="link footer-link">Cree un compte </a>
                  </router-link>
                </h6>
              </div>
            </template>
              <alert
              v-if="error"
              type="primary alert" dismissible>
                <div class="alert-icon">
                      <i class="now-ui-icons ui-2_like"></i>
                    </div>
                    <strong>Oups!</strong> Votre email ou mot de passe est incorrecte
                    {{error}}
              </alert>
              <template>
                <div>
                  {{isLogged}}
                  <div class=" col-md-5 ml-auto mr-auto ">
                      <a  v-if="isLogged"> login</a>
                      <a v-else  @click.prevent="logout()" > logout </a>
                    </div>
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
import { Card, Button, FormGroupInput, Alert} from '@/components';
import MainFooter from '@/layout/MainFooter';
import axios from 'axios';
import { Bus } from '../main';
export default {
  name: 'login-page',
  bodyClass: 'login-page',
  components: {
    Card,
    MainFooter,
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput,
    Alert,
  },
    data(){
      return {
        user:{
          email:"",
          password:""
        },
        isLogged:false,
        error:"",
        token:""
      }
    },
    methods:{
      login(){
       axios.post('http://localhost:8000/api/auth/login',{
            email:this.user.email,
            password:this.user.paswword
        }).then(response =>{
          console.log(response.data);
          //this.token = response.data.access_token;
         // document.cookie = this.token;
         //this.$router.push({ name: 'profile'});
        }).catch(error=>{
        console.log(error.message)
        })
        console.log("login function");
      },
      /*eraseCookie(name) {
        document.cookie = name + '=; Max-Age=0'
          },*/
      logout(){
        /*Bus.$on("clicked",token =>{
          document.cookie = token + '=; Max-Age=0'
        });*/
        this.isLogged = false;
        //axios.post('http://localhost:8000/api/auth/logout').then(response =>{
       //  console.log(response)});
       //this.$router.push({name: 'login'});

        console.log( this.isLogged +"  // logout function");
      }
    }

};
</script>
<style></style>