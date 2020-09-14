<template>
<div>
    <div class="row page-titles">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Booking</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item active">Booking</li>
                </ol>
            </div>
    </div>
    <div class="row page-titles">
        <ul>
        <li v-for="booking in bookings.data">
        {{ booking.name }}
        {{ booking.phone }} 
        </li>
        </ul>
    </div>
</div>

</template>

<script>
    
    import pagination from 'laravel-vue-pagination'
    import helper from '../../services/helper'
    import ClickConfirm from 'click-confirm'

    export default {
        components : {  pagination, ClickConfirm },
        data() {
            return {
                bookings: {},
            }
        },

        created() {
            this.getBookings();
        },

        methods: {
            getBookings(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                //let url = helper.getFilterURL(this.filterTaskForm);
                //axios.get('/api/vehicle?page=' + page + url)
                axios.get('/api/bookings?page=' + page)
                    .then(response => this.bookings = response.data );
            },
   
        },
        filters: {
          moment(date) {
            return helper.formatDate(date);
          }
        }
    }
</script>
