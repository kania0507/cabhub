<template>
<div>
    <div class="row page-titles">
            <div class="col-md-6 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">Vehicle</h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/home">Home</router-link></li>
                    <li class="breadcrumb-item active">Vehicle</li>
                </ol>
            </div>
    </div>
    <div class="row page-titles">
        <ul>
        <li v-for="vehicle in vehicles.data">
        {{ vehicle.mark }}
        {{ vehicle.prod_year }} 
        </li>
        </ul>
    </div>
</div>

</template>

<script>
    //import TaskForm from './form'
    import pagination from 'laravel-vue-pagination'
    import helper from '../../services/helper'
    import ClickConfirm from 'click-confirm'

    export default {
        components : {  pagination, ClickConfirm },
        data() {
            return {
                vehicles: {},
                /*filterTaskForm: {
                    sortBy : 'start_date',
                    order: 'desc',
                    status: '',
                    title: '',
                    pageLength: 5
                }*/
            }
        },

        created() {
            this.getVehicles();
        },

        methods: {
            getVehicles(page) {
                if (typeof page === 'undefined') {
                    page = 1;
                }
                //let url = helper.getFilterURL(this.filterTaskForm);
                //axios.get('/api/vehicle?page=' + page + url)
                axios.get('/api/vehicle?page=' + page)
                    .then(response => this.vehicles = response.data );
            },
    /*
            getProgress(task){
                return 'width: '+task.progress+'%;';
            },
            getProgressColor(task){
                return helper.taskColor(task.progress);
            },
            deleteTask(task){
                axios.delete('/api/task/'+task.id).then(response => {
                    toastr['success'](response.data.message);
                    this.getTasks();
                }).catch(error => {
                    toastr['error'](error.response.data.message);
                });
            },
            editTask(task){
                this.$router.push('/task/'+task.uuid+'/edit');
            },
            getTaskStatus(task){
                return (task.status) ? '<span class="label label-success">Completed</span>' : '<span class="label label-danger">Pending</span>';
            },
            toggleTaskStatus(task){
                axios.post('/api/task/status',{id:task.id}).then((response) => {
                    this.getTasks();
                });
            }
            */
        },
        filters: {
          moment(date) {
            return helper.formatDate(date);
          }
        }
    }
</script>
