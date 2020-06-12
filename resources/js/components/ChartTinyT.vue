<template>
  <div class="container">
    <line-chart
      v-if="loaded"
      :chartdata="chartdata"
      :options="options"/>
  </div>
</template>

<script>
    import axios from 'axios'
    import moment from 'moment'
    import { Line } from 'vue-chartjs'
    moment.locale('es');


    export default {
        props:['device_id'],
        extends: Line,
        data(){
            return{
                chartdata: {
                    labels: ['January', 'February'],
                    datasets: [{
                        label: 'Data One',
                        backgroundColor: '#f87979',
                        data: [40, 20]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            }
        },
        created: function(){
            this.getData();

        },
        mounted: function(){
            setInterval(this.getLive, 5000);
            this.renderChart(this.chartdata, this.options)
        },
        methods:{
            getLive: function(){
                var url = '../../api/receptions/last-hour/' + this.device_id;
                axios.get(url)
                .then(response => {
                    this.datas = response.data;
                });
                console.log('live');
                console.log(this.datas);
            },
            getData: function(){
                var url = '../../api/receptions/last-hour/' + this.device_id;
                axios.get(url)
                .then(response => {
                    this.datas = response.data;
                });
                console.log('get');
                console.log(this.datas);
            },

        }

    }
</script>