<template>
    <div class="card text-center">
        <div class="card-header">
            {{ dairy.name }}
        </div>
        <div class="card-body">
            <div class="row">
                <div v-if="dairy.admin_mon" class="col text-center">
                    <span v-if="dairy.protected" ><i v-bind:class="dairy.status.icon.scripts"></i>  Estado {{ dairy.status.name }}</span>
                </div>
                <div v-else class="col text-center">
                    <small>Monitoreo Vencido - <a v-bind:href="dairy.pay_route">Pagar por el monitoreo</a></small>
                </div>
            </div>
            <div class="row" v-if="dairy.last_data">
                <div class="col-10 display-4">{{ dairy.last_data.value }}°C</div>
                <div class="col-10"><small>{{ forHumans(dairy.last_data.created_at) }}</small></div>
            </div>
            <div class="row" v-else>
                <div class="col-10 display-4"> --.- °C </div>
                <div class="col-10"><small> Sin Datos </small></div>
            </div>
            <div class="row">
                <div class="col">
                    <i v-if="dairy.admin_mon" v-bind:class="dairy.protection.icon.scripts" v-bind:title="dairy.protection.description"></i>
                    <a v-bind:href="dairy.data_receptions_route" class="text-primary m-2" title="Evolucion de Temperaturas"><i class="fas fa-chart-line"></i></a>
                    <a v-bind:href="dairy.configuration_route" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs"></i></a>
                    <a v-bind:href="dairy.logs_route" class="text-primary m-2" title="Bitacora Del Dispositivo"><i class="fas fa-clipboard-list"></i></a>
                    <a v-bind:href="dairy.alerts_route" class="text-danger m-2" title="Nuevas Alertas">{{ dairy.alerts_count }} <i class="fas fa-bell"></i></a>
                </div>
            </div>
        </div>
        <div class="card-footer" v-bind:class="">
            <small class="">
                    {{ dairy.on_line ? 'En Linea':'Sin Conexion'}}
            </small>
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
                dairy:[]
            }
        },
        created: function(){
            this.getDairy();
            setInterval(this.getDairy, 15000);
        },
        methods:{
            forHumans: function(d){
                return moment(d).fromNow();
            },
            getDairy: function(){
                var url = '/api/centinela/receptions/now/' + this.device + '/product';
                axios.get(url)
                .then(response => {
                    this.dairy = response.data;
                });
            }
        }
    }
</script>
