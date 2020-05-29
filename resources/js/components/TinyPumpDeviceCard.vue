<template>
    <div class="card-columns col-md-10">
        <div v-for="device in tinyPumpDevices" class="card text-center">
            <div v-bind:class="device.on_line ? 'card-header' : 'card-header bg-danger'">
                {{ device.name }}
            </div>
            <div class="card-body">
                <div class="row">
                     <div v-if="device.admin_mon" class="col">
                            <i v-bind:class="device.channel1_class" v-bind:title="device.channel1_title"></i>
                            <i v-bind:class="device.channel2_class" v-bind:title="device.channel2_title"></i>
                            <i v-bind:class="device.channel3_class" v-bind:title="device.channel3_title"></i>
                            <small v-if="!device.admin_mon">Monitoreo Vencido - <a v-bind:href="device.pay_route">Pagar por el monitoreo</a></small>
                    </div>
                </div>
                <div class="row">
                    <div class="col display-4">{{ device.last_data01 }}</div>
                </div>
                <div class="row">
                    <div class="col">
                            <i v-bind:class="device.protection_class" v-bind:title="device.protection_title"></i>
                            <i v-bind:class="device.signal_class" v-bind:title="device.signal_title"></i>
                            <a v-bind:href="device.receptions_route" class="text-primary m-2" title="Evolucion de Nivel"><i class="fas fa-chart-line"></i></a>
                            <a v-bind:href="device.configuration_route" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs"></i></a>
                            <a v-bind:href="device.alerts_route" class="text-danger m-2" title="Nuevas Alertas">{{ device.alerts_count }} <i class="fas fa-bell"></i></a>
                    </div>
                </div>
            </div>
            <div v-bind:class="device.on_line ? 'card-footer' : 'card-footer bg-danger'">
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
                tinyPumpDevices:[]
            }
        },
        created: function(){
            this.getTinyPumpDevices();
            setInterval(this.getTinyPumpDevices, 15000);
        },
        methods:{
            forHumans: function(d){
                return moment(d).fromNow();
            },
            getTinyPumpDevices: function(){
                var url = '/api/devices/tiny-pump/' + this.userid;
                axios.get(url)
                .then(response => {
                    this.tinyPumpDevices = response.data;
                });
            }
        }
    }
</script>
