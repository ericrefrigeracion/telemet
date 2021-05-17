<template>
    <div class="col mb-5">
        <div class="row">
            <canvas :id="view.order"></canvas>
        </div>
        <div class="row">
            <div class="col"><button class="btn btn-secondary">Semana</button></div>
            <div class="col"><button class="btn btn-secondary">Ayer</button></div>
            <div class="col"><button class="btn btn-secondary">Hoy</button></div>
            <div class="col"><button class="btn btn-secondary">Fecha</button></div>
        </div>
    </div>
</template>

<script>
    import Chart from 'Chart.js';
    import moment from 'moment';

    export default {
        props: ['view', 'device_id'],
        data(){
            return{
                receptions:[],
                content:[]
            }
        },
        created: function(){
            this.getReceptions();
            //setInterval(this.getData, 15000);
        },
        mounted() {

        },
        methods:{
            getReceptions: function(){
                this.view.display_topics.forEach(topic => {
                    var slug = topic.topic.slug;
                    var name = topic.topic.name;
                    var unit = topic.topic.unit;
                    var color = topic.topic.color;
                    var fill = topic.topic.filled == '1' ? true : false;
                    var start_time = Date.now() - (24 * 60 * 60 * 1000);
                    var end_time = Date.now();
                    var url = '/api/centinela/receptions/data/' + this.device_id + '/' + slug + '/' + start_time + '-' + end_time;
                    axios.get(url)
                    .then(response => {
                        this.receptions = response.data;
                        this.content.push({'label':name,
                        'data':this.receptions,
                        'pointRadius':1,
                        'hoverRadius':3,
                        'backgroundColor': color,
                        'borderColor': color,
                        'fill': fill,
                        });
                        //console.log(this.content);
                        //window.myLine.update();
                        this.mountChart();
                    });
                });
            },
            getData: function(){},
            mountChart: function(){
                var ctx = document.getElementById(this.view.order).getContext('2d');
                var timeFormat = 'YYYY/MM/DD HH:mm';
                new Chart(ctx, {
                    type: this.view.display,
                    data: {
                        datasets: this.content
                    },
                    options: {
                        legend: {
                            labels:{
                                usePointStyle:true
                            },
                            position:'bottom',
                        },
                        title: {},
                        animation: {
                            duration: 0
                        },
                        hover: {
                            animationDuration: 0
                        },
                        responsive: true,
                        responsiveAnimationDuration: 0,
                        scales: {
                            xAxes: [{
                                type: 'time',
                                time: {
                                    parser: timeFormat,
                                    tooltipFormat: 'll HH:mm',
                                    parser: function(date) {
                                        return moment(date).utcOffset('+0100');
                                    }
                                },
                                scaleLabel: {
                                    display: true,
                                    //labelString: 'Fecha',
                                }
                            }],
                            yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    //labelString: 'Valores'.
                                }
                            }]
                        },
                    }
                });
            }
        }
    }
</script>