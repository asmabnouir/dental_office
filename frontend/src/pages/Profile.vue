<template>
  <div>
    <div class="page-header clear-filter" filter-color="orange">
      <parallax
        class="page-header-image"
        style="background-image:url('img/GSD_profile.jpg')"
      >
      </parallax>
      <div class="container ProfileTitle">
        <h3 class="title">{{form.name}}</h3>
      </div>
    </div>
    <div class="section">
      <div class="container">
        <div v-show="form.submitted">
            <alert type="success">
        <div class="alert-icon">
              <i class="now-ui-icons ui-2_like"></i>
            </div>
            <strong>Vos informations sont bien enregistrées </strong> 
            </alert>
          </div>
        <div class="row ">
          <div class="col-lg-5 col-md-12">
            <h3 class="title">Données de compte </h3>
            <div class="">
              <p class="h4">Votre E-Mail: </p> 
              <p>{{form.email}}</p>
            </div>
            <div class="">
              <p class="h4">Votre Mot de passe:</p>
                <fg-input placeholder=" ......"></fg-input>
            </div>
          </div>
          <form @submit.prevent="submitForm" class="col-lg-5 col-md-12">
          <div >
            <h3 class="title">Données de patient</h3>
            <div style="margin-bottom:50px">
              <p class="h4">Votre Age : </p><p>{{form.age}}</p>
                <fg-input  v-model="form.age" placeholder="20"></fg-input>
            </div>
            <div class="">
              <p>Problème de santé à signaler :</p>
              <p>{{form.text}}</p>
              <textarea
                class="form-control"
                rows="4"
                cols="80"
                v-model="form.text"
                placeholder="Ajouter des détails ..."
              ></textarea>
            </div>
          </div>
          <button  type="submit" class=" btn btn-primary">Enregistrer les moidification</button>
          <alert
              v-if="error"
              type="primary alert" dismissible>
                <div class="alert-icon">
                      <i class="now-ui-icons ui-2_like"></i>
                    </div>
                    <strong>Oups! , {{warningMsg}}</strong>
              </alert>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {FormGroupInput,Alert} from '@/components';
import axios from 'axios';
import bus from '../bus';

export default {
  name: 'profile',
  bodyClass: 'profile-page',
  components: {
    [FormGroupInput.name]: FormGroupInput,
       Alert,
  },
  data() {
    return {
      form: {
        name:"",
        email: '',
        age:'',
        text: '',
        submitted:false,
      },
      error:false,
    }
  },
  methods:{
    getUser(){
      axios.post('http://localhost:8000/api/auth/me',{token:this.$store.state.token}).then(response =>{
        this.$store.state.UserId = response.data.id;
       this.form.name = response.data.name;
       this.form.email = response.data.email;
       this.form.text = response.data.text;
       this.form.age = response.data.age;
      this.form.submitted=false;
      //console.log( this.form.submitted);
      }).catch(error=>{
      })
  },
    submitForm(){
      this.form.submitted = false;
      axios.post('http://localhost:8000/api/users/profile/submit',{
        token:this.$store.state.token,
        text : this.form.text,
        age  : this.form.age,
      }).then(response =>{
      //console.log(response.data);
      this.form.submitted = true;
      //console.log( this.form.submitted);
      this.getUser();
      //console.log( this.form.submitted);
      }).catch(error=>{
          this.alert= true;
                if (error.response) {
                this.warningMsg= "Vos données ne sont pas enregistré, Veuillez réessayer  "
              }
      });
    }
  },
  created(){
      if (this.$store.getters.isLoggedIn) {
         this.getUser();
      }
    }
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
