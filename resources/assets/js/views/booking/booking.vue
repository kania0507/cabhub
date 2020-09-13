<template>
 <div>
      <form >
					
					<div><input type="text" placeholder="Name" v-model="bookingForm.name" /></div>
					<div><input type="text" placeholder="Phone" v-model="bookingForm.phone" /></div>
					<div><datepicker type="text"  :language="pl"  v-model="bookingForm.when" :format="customFormatter" placeholder="Date" ></datepicker></div>
					<div>
            <input type="text" placeholder="Time" v-model="bookingForm.time" list="hours" />
            <datalist id="hours">
               <option v-for="n in 23" :value="n+':00'"></option>              
            </datalist>            
            </div>
					<div><input type="text" placeholder="Start-place" v-model="bookingForm.start"  id="autocomplete" />
            <!--<vue-google-autocomplete 
            
             id="map"
            classname="form-control"
            placeholder="Start typing"
            v-on:placechanged="getAddressData"
    ></vue-google-autocomplete>-->
            </div>
					<div><input type="text" placeholder="End-place" v-model="bookingForm.end" /></div>
					<br />
					<div class="vehicle">
             <input type="text" placeholder="Choose vehicle type" v-model="bookingForm.vehicle"  list="vehicle_type"  />
            <datalist id="vehicle_type" >
               <option value="1">economy</option>              
               <option value="2">standard</option>              
               <option value="3">business</option>              
            </datalist> 
            </div>
					
					<button class="form-submit" v-on:click="submit">Submit</button>
				</form>

    </div>
</template>


<script>
 /* 
import 'https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyA9Sxi_uxJbak61KZw5IhN5k72ch8NQah8';
new google.maps.places.Autocomplete(
      document.getElementById("autocomplete")
  );
*/
  import datepicker from 'vuejs-datepicker';
  import VueGoogleAutocomplete from 'vue-google-autocomplete';

    export default {
      name: 'booking',

  data: () => ({ 
    pl : 'pl',
    location: null,
    address: '',
    bookingForm: new Form({ 
      'name' : '',
                    'phone' : '',
                    'when': '',
    'time': '',
    'start': '',
    'end': '',
    'vehicle': ''
    
    })
  }), 
  methods: {
    submit: function() {
      //console.log(this.name, this.phone, this.when, this.time, this.start, this.end);
    alert(this.bookingForm.name +' '+ this.bookingForm.phone +' '+ this.customFormatter(this.bookingForm.when) +' '+ this.bookingForm.time +' '+ this.bookingForm.start +' '+ this.bookingForm.end +' '+ this.bookingForm.vehicle);
      this.name = '';
      this.phone = '';
      this.when = '';
      this.time = '';
      this.start = '';
      this.end = '';
      

      // add bookmark to DB
    },
    
    customFormatter(date) {
      return moment(date).format('YYYY-MM-DD');
    },
    getAddressData(addressData, placeResultData, id) {
                this.start = addressData;
                console.log(addressData);
                //this.address = addressData;
            },

            
            storeBooking(){
                this.bookingForm.post('/booking')
                .then(response => {
                    toastr['success'](response.message);
                    this.$emit('completed',response.booking)
                })
                .catch(response => {
                    toastr['error'](response.message);
                });
            }

    /*
    initLocationSearch() {
         let autocomplete = new window.google.maps.places.Autocomplete(this.$refs.search);
         autocomplete.addListener("place_changed", function() {
            let place = autocomplete.getPlace();
            if (place && place.address_components) {
               console.log(place.address_components);
            }
         });
      }

    */
  },
 
  components : { datepicker, VueGoogleAutocomplete }
}
//GMaps api: lara-289413 
// key AIzaSyA9Sxi_uxJbak61KZw5IhN5k72ch8NQah8
</script>