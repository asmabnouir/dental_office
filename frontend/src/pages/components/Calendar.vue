<template>
<div>
  <div class="calendar-container">
        <h4 >Prendre RDV</h4>
        <div class="row">
          <div class="test col-md-10 ">
            <!-----
            <div class="datepicker-container">
              <fg-input>
                <el-date-picker
                  type="date"
                  popper-class="date-picker date-picker-primary"
                  placeholder="Date Time Picker"
                  v-model="pickers.datePicker"
                >
                </el-date-picker>
              </fg-input>
            </div>
            ----->
            <vue-scheduler/>
          </div>
        </div>
    </div>
  <div
    class="navigation-example"
    style="background-image:url('img/GSD_2.jpg');
            background-attachment: fixed;"
  ></div>
</div>

</template>

<script>
    export default {

      name: 'calendar',
      components: {
      },
      data() {
        return {
        };
      }
    };
    </script>
    <style scoped media="scss" lang="scss">
      .navigation-example{
          min-height: 500px !important;
      };
      .calendar-container{
        h4{text-align: center};
        margin:70px auto;
        text-align: center
      };
     .test{
       margin:auto;
     }
    </style>
