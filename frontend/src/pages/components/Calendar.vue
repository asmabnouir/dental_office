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
            <vue-scheduler
            :time-range="[8,16]"
            locale="fr"
            initial-view="week"
             @event-clicked="eventClicked"
             />
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
          events:[{
            name:"",
            date:new Date(),
            startTime: "",
            endTime: "",
            }]
        };
      },
      methods: {

      timeClicked(dateWithTime) {
            console.log('Time clicked');
            console.log('Date: ' + dateWithTime.date );
            console.log('Time: ' + dateWithTime.time );
          },
        eventClicked(event){
          console.log(event.name)
        }
      }
    };
    </script>
    <style scoped media="scss" lang="scss">
      .navigation-example{
          min-height: 500px !important;
      }
      .calendar-container{
        h4{text-align: center};
        margin:80px auto;
        padding: 40px ;
        text-align: center
      };
      .v-cal-header{
        padding: 0 !important;
      }
     .test{
       margin:auto;
     }
    </style>
