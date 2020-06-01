<template>
        <div class="card text-center">
            <canvas id="myChart" width="400" height="400"></canvas>
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
            this.chart();

        },
        mounted: function(){
            this.chart();
            setInterval(this.getData(), 15000);
        },
        methods:{
            getData: function(){
                var url = '../../api/receptions/' + this.device_id;
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
                            label: '# of Votes',
                            data: this.datas,
                            backgroundColor: ['rgba(255, 159, 64, 0.2)'],
                            borderColor: ['rgba(255, 159, 64, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                type: 'time',
                            }]
                        }
                    }
                });
            }

        }

    }
</script>