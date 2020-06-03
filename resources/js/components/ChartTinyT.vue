<template>
        <div class="card text-center">
            <canvas id="myChart"></canvas>
        </div>
</template>

<script>
   import axios from 'axios'
   import moment from 'moment'
   import Chart from 'chart.js';
   moment.locale('es');


    export default {
        props:['device_id'],
        data(){
            return{
                datas:[]
            }
        },
        created: function(){
            this.getData();
            //setInterval(this.getData, 15000);

        },
        mounted: function(){
            //this.chart();
            setInterval(this.getLive, 15000);
            setInterval(this.chart, 15000);
        },
        methods:{
            getLive: function(){
                var url = '../../api/receptions/last-hour/' + this.device_id;
                axios.get(url)
                .then(response => {
                    this.datas.push(response.data);
                });
            },
            getData: function(){
                var url = '../../api/receptions/last-hour/' + this.device_id;
                axios.get(url)
                .then(response => {
                    this.datas = response.data;
                });
                console.log(this.datas);
            },
            chart: function(){
                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Red'],
                        datasets: [{
                            label: 'Temperatura',
                            data: this.datas,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            xAxes: [{
                                type: 'time',
                                distribution: 'series',
                                time: {
                                    unit: 'minute'
                                }
                            }]
                        }
                    }
                });
            }

        }

    }
</script>