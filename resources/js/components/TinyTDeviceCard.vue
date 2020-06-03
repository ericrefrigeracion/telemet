<template>
    <div class="card-columns col-md-10">
        <div v-for="device in tinyTDevices" class="card text-center">
            <div class="card-header" v-bind:class="device.bg_class">
                {{ device.name }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div v-if="device.admin_mon" class="col text-center">
                        <span v-if="device.protected" >{{ device.status_text }} <i v-bind:class="device.status_class"></i></span>
                    </div>
                    <div v-else class="col text-center">
                        <small>Monitoreo Vencido - <a v-bind:href="device.pay_route">Pagar por el monitoreo</a></small>
                    </div>
                </div>
                <div v-if="device.admin_mon" class="row">
                        <i v-if="device.protected" v-bind:class="device.statuss_class" v-bind:title="device.statuss_title"></i>
                        <div class="col-10 display-4">{{ device.last_data01 }}</div>
                </div>
                <div v-else class="row">
                    <div class="col display-3 m-2">{{ device.last_data01 }}</div>
                </div>

                <div class="row">
                    <div class="col">
                        <i v-if="device.admin_mon" v-bind:class="device.protection_class" v-bind:title="device.protection_title"></i>
                        <i v-bind:class="device.signal_class" v-bind:title="device.signal_title"></i>
                        <a v-bind:href="device.receptions_route" class="text-primary m-2" title="Evolucion de Temperaturas"><i class="fas fa-chart-line"></i></a>
                        <a v-bind:href="device.configuration_route" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs"></i></a>
                        <a v-bind:href="device.alerts_route" class="text-danger m-2" title="Nuevas Alertas">{{ device.alerts_count }} <i class="fas fa-bell"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-footer" v-bind:class="device.bg_class">
                <small class="">
                        {{ device.on_line ? 'En Linea':'Sin Conexion'}} - {{ forHumans(device.last_created_at) }}
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
        props:['userid'],
        data(){
            return{
                tinyTDevices:[]
            }
        },
        created: function(){
            this.getTinyTDevices();
            setInterval(this.getTinyTDevices, 15000);
        },
        methods:{
            forHumans: function(d){
                return moment(d).fromNow();
            },
            getTinyTDevices: function(){
                var url = '/api/devices/tiny-t/' + this.userid;
                axios.get(url)
                .then(response => {
                    this.tinyTDevices = response.data;
                });
            }
        }
    }
</script>
