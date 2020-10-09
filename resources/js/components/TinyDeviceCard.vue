<template>
    <div class="card-columns col-md-10">
        <div class="card text-center">
            <div class="card-header">
                {{ device.name }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div v-if="device.admin_mon" class="col text-center">
                        <span v-if="device.protected" >{{ device.status_id }} <i v-bind:class="device.status_class"></i></span>
                    </div>
                    <div v-else class="col text-center">
                        <small>Monitoreo Vencido - <a v-bind:href="device.pay_route">Pagar por el monitoreo</a></small>
                    </div>
                </div>
                <div v-if="device.admin_mon" class="row">
                        <i v-if="device.protected" v-bind:class="device.statuss_class" v-bind:title="device.statuss_title"></i>
                        <div class="col-10 display-4">{{ tiny.value }}</div>
                </div>
                <div v-else class="row">
                    <div class="col display-3 m-2">{{ device.id }}</div>
                </div>

                <div class="row">
                    <div class="col">
                        <i v-if="device.admin_mon" v-bind:class="device.protection_class" v-bind:title="device.protection_title"></i>
                        <i v-bind:class="device.signal_class" v-bind:title="device.signal_title"></i>
                        <a v-bind:href="device.receptions_route" class="text-primary m-2" title="Evolucion de Temperaturas"><i class="fas fa-chart-line"></i></a>
                        <a v-bind:href="device.configuration_route" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs"></i></a>
                        <a v-bind:href="device.alerts_route" class="text-danger m-2" title="Nuevas Alertas">{{ tiny.id }} <i class="fas fa-bell"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-footer" v-bind:class="device.bg_class">
                <small class="">
                        {{ tiny.on_line ? 'En Linea':'Sin Conexion'}} - {{  }}
                </small>
            </div>
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
            forHumans: function(d){
                return moment(d).fromNow();
            },
            getTiny: function(){
                var url = '/api/centinela/receptions/now/' + this.device.id + '/temp1';
                axios.get(url)
                .then(response => {
                    this.tiny = response.data;
                });
            }
        }
    }
</script>
