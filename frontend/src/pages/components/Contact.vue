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
                    <n-button type="primary" round block size="lg"
                      >Envoyer Message</n-button
                    >
                  </div>
        </div>

      </div>
    </div>
  </div>
  </div>
</template>
<script>
import { Button, FormGroupInput } from '@/components';
export default {
  name: 'contact',
  components: {
    [Button.name]: Button,
    [FormGroupInput.name]: FormGroupInput
  },
  data() {
    return {
      form: {
        firstName: '',
        email: '',
        message: ''
      }
    };
  }
};
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
</style>
