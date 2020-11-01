<template>
    <canvas :id="view.order"></canvas>
</template>

<script>
    import Chart from 'Chart.js';
    import moment from 'moment';

    export default {
        props: ['view', 'device'],
        data(){
            return{
                receptions:[],
                content:[]
            }
        },
        created: function(){
            this.getReceptions();
            setInterval(this.getData, 15000);
        },
        mounted() {
            var ctx = document.getElementById(this.view.order).getContext('2d');
            var timeFormat = 'YYYY/MM/DD HH:mm';
            window.myLine = new Chart(ctx, {
                type: this.view.display,
                data: {
                    datasets: this.content
                },
                options: {
                title: {},
                scales: {
                    xAxes: [{
                        type: 'time',
                        time: {
                            parser: timeFormat,
                            // round: 'day'
                            tooltipFormat: 'll HH:mm',
                            parser: function(date) {
                                return moment(date).utcOffset('+0100');
                            }
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Fecha'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Valores'
                        }
                    }]
                },
                responsive: true,
    maintainAspectRatio: false,
    animation: {
        duration: 0
    },
    hover: {
        animationDuration: 0
    },
    responsiveAnimationDuration: 0
            }
            });
        },
        methods:{
            getReceptions: function(){
                this.view.display_topics.forEach(topic => {
                    var slug = topic.topic.slug;
                    var name = topic.topic.name;
                    var unit = topic.topic.unit;
                    var color = topic.topic.color;
                    var fill = topic.topic.filled;
                    var start_time = Date.now() - (2 * 60 * 60 * 1000);
                    var end_time = Date.now();
                    var url = '/api/centinela/receptions/data/' + this.device.id + '/' + slug + '/' + start_time + '-' + end_time;
                    axios.get(url)
                    .then(response => {
                        this.receptions = response.data;
                        this.content.push({'label':name,
                        'data':this.receptions,
                        'borderColor': color,
                        'backgroundColor': color,
                        'fill': fill,
                        });
                        //console.log(this.content);
                        window.myLine.update();
                    });
                });
            },
            getData: function(){}
        }
    }
</script>