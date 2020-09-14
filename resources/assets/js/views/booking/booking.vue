<template>
 <div>
      <form  id="form" @submit.prevent="submit3"><!-- @submit.prevent="submit3" -->
					
					<div><input type="text" placeholder="Name" v-model="name" /></div>
					<div><input type="text" placeholder="Phone" v-model="phone" /></div>
					<div><datepicker type="text"  :language="pl"  v-model="date" :format="customFormatter" placeholder="Date" ></datepicker></div>
					<div>
            <input type="text" placeholder="Time" v-model="time" list="hours" />
            <datalist id="hours">
               <option v-for="n in 23" :value="n+':00'"></option>              
            </datalist>            
            </div>
					<div><!--<input type="text" placeholder="Start-place" v-model="startplace"  id="autocomplete" />-->
            <vue-google-autocomplete 
            v-model="startplace" 
             id="map"
            classname="form-control"
            placeholder="Start place"
            v-on:placechanged="getAddressData"
    ></vue-google-autocomplete>

            </div>
					<div><!--<input type="text" placeholder="End-place" v-model="endplace" />-->
           <vue-google-autocomplete 
            v-model="endplace" 
             id="map2"
            classname="form-control"
            placeholder="End place"
            v-on:placechanged="getAddressData2"
    ></vue-google-autocomplete>
          </div>
					
					<div class="vehicle">
             <input type="text" placeholder="Choose vehicle type" v-model="vehicle_class_id"  list="vehicle_type" @input="saveSelectionAndReset"  />
            <datalist id="vehicle_type" >
               <option value="1">economy</option>              
               <option value="2">standard</option>              
               <option value="3">business</option>              
            </datalist> 
            </div>
					
					<button class="form-submit"  >Submit</button><!-- v-on:click="submit" v-on:click="storeBooking" -->
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

  data() {
            return {
    pl : 'pl',
    location: null,
    address: '',
    
    name:'',
    phone:'',
    date:'',
    time:'',
    startplace:'',
    endplace:'',
    vehicle_class_id:'',
    output: '',

    bookingForm: new Form({ 
      'name' : '',
      'phone' : '',
      'when': '',
    'time': '',
    'start': '',
    'end': '',
    'vehicle': '',
    
    })
  }}, 
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
      this.vehicle = '';

      // add bookmark to DB
    },
    
    customFormatter(date) {
      return moment(date).format('YYYY-MM-DD');
    },
    getAddressData(addressData, placeResultData, id) {
                this.startplace =addressData.route+', '+addressData.locality;
                console.log(addressData);
                //this.address = addressData;
            },
            getAddressData2(addressData, placeResultData, id) {
                this.endplace = addressData.route+' '+addressData.street_number+', '+addressData.locality;
                console.log(addressData);
                //this.address = addressData;
            },

            
            storeBooking(){
                this.bookingForm.post('/api/booking')
                .then(response => {
                    toastr['success'](response.message);
                    //this.$emit('completed', response.booking);
                    console.log('ok '+response.booking);
                    return response.booking;
                })
                .catch(response => {
                    toastr['error'](response.message);
                    console.log('err '+response.message);
                });
                
            },
            submit2: function(e) {
              //var form = document.getElementById('form');
              var formData = this.bookingForm;//new FormData(form);
              
              axios.post('/api/booking', formData)
              .then((response) => {
                  // success callback
                  toastr['success']('Formularz wysłany');//+response.message);
                      
                      console.log('ok '+ formData.phone);
                      return formData;
              }, (response) => {
                  // error callback
                  toastr['error']('Błąd wysłania formularza '+response.message);
                      console.log('err '+e+response.message);
              });
          },
          submit3(e){

             e.preventDefault();
                let currentObj = this;
                axios.post('/api/booking', {
                    name: this.name,
                    phone: this.phone,
                    date: this.customFormatter(this.date),
                    time: this.time,
                    startplace: this.startplace,
                    endplace: this.endplace, 
                    vehicle_class_id: this.vehicle_class_id
                })
                .then(function (response) {
                    currentObj.output = response.data;
                    //console.log(response.data);
                    toastr['success']('Wysłano formularz '+response.message);
                })
                .catch(function (error) {
                    currentObj.output = error;
                    toastr['success']('Błąd wysyłania formularza '+response.message);
                });

                console.log(this.startplace);
                console.log(this.endplace);
          },

          saveSelectionAndReset(e) {
            let val = e.target.value;
            if (val) {
              this.vehicle_class_id = val;
            }
            e.target.value = "";
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