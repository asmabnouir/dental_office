<template>
  <div class="">
          <div class="section section-contact-us text-center">
            <div class="container">
              <h2 class="title">Pour nous contacter</h2>
              <div class="row">
                <div class="col-lg-6 col-md-12">
                  <div class="team-player">
                    <i style="height: 24px"  class="now-ui-icons location_pin "></i>
                    <h4 class="title">Adresse</h4>
                    <p class="description">
                        57 GRAND STREET, BROOKLYN, NY 11249
                    </p>
                  </div>
                </div>
                <div class="col-lg-5 text-center ml-auto mr-auto col-md-8">
                  <form >
                  <fg-input
                    class="input-lg"
                    placeholder="Nom ..."
                    v-model="form.firstName"
                    addon-left-icon="now-ui-icons users_circle-08"
                  >
                  </fg-input>
                  <fg-input
                    class="input-lg"
                    placeholder="Email ..."
                    v-model="form.email"
                    addon-left-icon="now-ui-icons ui-1_email-85"
                  >
                  </fg-input>
                  <div class="textarea-container">
                    <textarea
                      class="form-control"
                      name="name"
                      rows="4"
                      cols="80"
                      v-model="form.message"
                      placeholder="Ecrire voter message ..."
                    ></textarea>
                  </div>
                  <div class="send-button">
                    <n-button  @click.prevent="submitForm(), alertDispaly()" type="primary" round block size="lg"
                      >Envoyer Message</n-button
                    >
                  </div>
                  <div class ='alert' v-show="alert" >
                    <alert v-if="success" type="success" dismissible>
                      <div class="alert-icon">
                          <i class="now-ui-icons ui-2_like"></i>
                      </div>
                        <strong>{{successMsg}}</strong>
                     </alert>
                    <alert v-else-if="!success" type="warning" dismissible>
                      <div class="alert-icon">
                          <i class="now-ui-icons ui-2_like"></i>
                      </div>
                        <strong>{{warningMsg}}</strong>
                     </alert>
                    </div>
                  </form>
                  </div>

      </div>
    </div>
  </div>
  </div>
</template>
<script>
import { Button, FormGroupInput, Alert } from '@/components';
import axios from 'axios';
export default {
  name: 'contact',
  components: {
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput,
    Alert,
  },
  data() {
    return {
      form: {
        firstName: '',
        email: '',
        message: '',
    },
      alert:false,
      success:null,
     successMsg : "",
     warningMsg : "",
  }
  },
methods:{
    alertDispaly(){
      setTimeout(() => {
             this.alert = true;
              }, 3000);
    },
     submitForm(){
            return axios.post('http://localhost:8000/api/contact', {
                name:this.form.firstName,
                email:this.form.email,
                message:this.form.message,
            }).then(data => {
             this.success= true;
             this.successMsg=  'Votre message a été envoyé ';
            }).catch(
              error=>{
                  this.success= false;
                if (error.response) {
                switch (error.response.status) {
                  case 422 : 
                  this.warningMsg= 'vous devez remplir tous les données ';
                  break;
                  default: this.warningMsg= "Votre message n'a pu être envoyé "
                  }
              }
            });
        }
  }
}
</script>
<style scoped media="scss"  lang="scss">
  h4{
    margin-top:0 !important;
    padding-top:0 !important;
  }

  .team-player {
      padding-top: 15%;
  }
  h2{
    margin-bottom: 50px !important;
  }
  i{
    font-size: 30px;
  }
  .alert{
    padding-top: 20px!important ; 
    padding-bottom: 20px!important ;
    margin-bottom : 20px;
  }
</style>
