<template>
 <div>
      <form>
					
					<div><input type="text" placeholder="Name" v-model="name" /></div>
					<div><input type="text" placeholder="Phone" v-model="phone" /></div>
					<div><datepicker type="text"  :language="pl"  v-model="when" :format="customFormatter" placeholder="Date" ></datepicker></div>
					<div>
            <input type="text" placeholder="Time" v-model="time" list="hours" />
            <datalist id="hours">
               <option v-for="n in 23" :value="n+':00'"></option>              
            </datalist>            
            </div>
					<div><input type="text" placeholder="Start-place" v-model="start" /></div>
					<div><input type="text" placeholder="End-place" v-model="end" /></div>
					<br />
					<div class="vehicle">
             <input type="text" placeholder="Choose vehicle type" v-model="vehicle"   list="vehicle_type"  />
            <datalist id="vehicle_type" >
               <option>economy</option>              
               <option>standard</option>              
               <option>business</option>              
            </datalist> 
            </div>
					
					<button class="form-submit" v-on:click="submit">Submit</button>
				</form>

    </div>
</template>


<script>

  import datepicker from 'vuejs-datepicker';
    export default {
      name: 'booking',

  data: () => ({
    name: '',
    phone: '',
    when: '',
    time: '',
    start: '',
    end: '',
    vehicle: '',
    pl : 'pl'
  }),
  methods: {
    submit: function() {
      //console.log(this.name, this.phone, this.when, this.time, this.start, this.end);
    alert(this.name +' '+ this.phone +' '+ this.customFormatter(this.when) +' '+ this.time +' '+ this.start +' '+ this.end +' '+ this.vehicle);
      this.name = '';
      this.phone = '';
      this.when = '';
      this.time = '';
      this.start = '';
      this.end = '';

      // add bookmark to DB
    },
    customFormatter(date) {
      return moment(date).format('YYYY-MM-DD hh:mm:ss');
    }

    // YYYY-MM-DD HH:MM:SS
  },
  components : { datepicker }
}
//GMaps api: lara-289413 
// key AIzaSyA9Sxi_uxJbak61KZw5IhN5k72ch8NQah8
</script>