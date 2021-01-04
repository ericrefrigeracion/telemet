<template>
    <div class="card text-center">
        <div class="card-header" v-bind:class="tiny.status.scripts">
            {{ tiny.name }}
        </div>
        <div class="card-body">
            <div class="row">
                <div v-if="tiny.admin_mon" class="col text-center">
                    <span v-if="tiny.protected" ><i v-bind:class="tiny.status.icon.scripts"></i>  Estado {{ tiny.status.name }}</span>
                </div>
                <div v-else class="col text-center">
                    <small>Monitoreo Vencido - <a v-bind:href="tiny.pay_route">Pagar por el monitoreo</a></small>
                </div>
            </div>
            <div class="row" v-if="tiny.last_data">
                <div class="col-10 display-4">{{ roundValue(tiny.last_data.value) }}°C</div>
                <div class="col-10"><small>{{ forHumans(tiny.last_data.created_at) }}</small></div>
            </div>
            <div class="row" v-else>
                <div class="col-10 display-4"> --.- °C </div>
                <div class="col-10"><small> Sin Datos </small></div>
            </div>
            <div class="row">
                <div class="col">
                    <i v-if="tiny.admin_mon" v-bind:class="tiny.protection.icon.scripts" v-bind:title="tiny.protection.description"></i>
                    <a v-bind:href="tiny.data_receptions_route" class="text-primary m-2" title="Evolucion de Temperaturas"><i class="fas fa-chart-line"></i></a>
                    <a v-bind:href="tiny.configuration_route" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs"></i></a>
                    <a v-bind:href="tiny.logs_route" class="text-primary m-2" title="Bitacora Del Dispositivo"><i class="fas fa-clipboard-list"></i></a>
                    <a v-bind:href="tiny.alerts_route" class="text-danger m-2" title="Nuevas Alertas">{{ tiny.alerts_count }} <i class="fas fa-bell"></i></a>
                </div>
            </div>
        </div>
        <div class="card-footer" v-bind:class="tiny.status.scripts">
            <small v-if="tiny.admin_mon">
                    {{ tiny.on_line ? 'En Linea':'Sin Conexion'}}
            </small>
            <small v-else="tiny.admin_mon"> Monitoreo Vencido</small>
        </div>
        </div>
</template>

<script>
   import axios from 'axios'
   import moment from 'moment'
   moment.locale('es');

    export default {
        props:['device'],
        data(){
            return{
                tiny:[]
            }
        },
        created: function(){
            this.getTiny();
            setInterval(this.getTiny, 15000);
        },
        methods:{
            roundValue: function(v){
                return (Math.round(v*100)/100)
            },
            forHumans: function(d){
                return moment(d).fromNow();
            },
            getTiny: function(){
                var url = '/api/centinela/receptions/now/' + this.device + '/temp1';
                axios.get(url)
                .then(response => {
                    this.tiny = response.data;
                });
            }
        }
    }
</script>
