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
             @time-clicked="timeClicked"
             @event-created="eventCreated"
             :events="events"
             />
          </div>
        </div>
        <div><button @click.prevent="getIndex()">mon test get </button></div>
    </div>
  <div
    class="navigation-example"
    style="background-image:url('img/GSD_2.jpg');
            background-attachment: fixed;"
  ></div>
</div>

</template>

<script>
import axios from 'axios';
    export default {

      name: 'calendar',
      components: {
      },
      data() {
        return {
          events:[],
            error:"",
        }
      },
      computed:{
      },
      methods: {
      timeClicked(dateWithTime) {
            console.log('Time clicked');
            console.log('Date: ' + dateWithTime.date );
            console.log('Time: ' + dateWithTime.time );
            //console.dir(this.events);
      },
      eventCreated(dateWithTime){
        axios.post('http://localhost:8000/api/event/create',  {
            event_date:dateWithTime.date,
            start_time:dateWithTime.time,
        }).then(response=>{
          console.dir(response);
        })
      },
      getIndex(){
        axios.get('http://localhost:8000/api/event/index',  {
        }).then(response=>{
          console.dir(response.data);
          this.events=response.data;
          console.dir(this.events);
        }).catch(error=>{
        console.log(error.message)
        });
      },
    }

    }
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
