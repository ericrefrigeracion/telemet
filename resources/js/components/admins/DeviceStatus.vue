<template>
    <div class="card mt-3">
        <div class="card-header">
                    Dispositivos - Todos
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr class="text-center">
                        <th>Usr</th>
                        <th>Dispositivo</th>
                        <th>Modelo</th>
                        <th colspan="3">Estado</th>
                        <th colspan="4">Acciones</th>
                        <th>Recibido</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center" v-for="device in devices">
                        <td><a v-bind:href="device.user_route">{{ device.user.id }}</a></td>
                        <td><a v-bind:href="device.device_route">{{ device.id }}</a></td>
                        <td><i v-bind:class="device.type_device_icon" class="m-2" v-bind:title="device.type_device_title"></i></td>
                        <td v-if="device.on_line"><i class="fas fa-link text-success m-2"  title="En Linea"></i></td>
                        <td v-else><i class="fas fa-unlink text-danger m-2" title="Desconectado"></i></td>
                        <td v-if="device.protected"><i class="far fa-eye text-success m-2" title="Protegido"></i></td>
                        <td v-else><i class="far fa-eye-slash text-success m-2" title="Horario Permitido"></i></td>
                        <td><i v-bind:class="device.status_icon" class="m-2" v-bind:title="device.status_title"></i></td>
                        <td>
                            <a v-bind:href="device.configurations_route" class="text-primary" title="Configuracion Del Dispositivo"><i class="fas fa-cogs m-2"></i></a>
                        </td>
                        <td>
                            <a v-bind:href="device.data_receptions_route" class="text-primary" title="Evolucion de las Temperaturas"><i class="fas fa-chart-line m-2"></i></a>
                        </td>
                        <td>
                            <a v-bind:href="device.logs_route" class="text-primary" title="Logs Dispositivo"><i class="fas fa-clipboard-list m-2"></i></a>
                        </td>
                        <td>
                            {{ device.alerts_count }}<a v-bind:href="device.alerts_route" class="text-primary" title="Nuevas Alertas"><i class="fas fa-bell m-2"></i></a>
                        </td>
                        <td>
                            {{ forHumans(device.last_reception_created_at) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import swal from 'sweetalert';
    import moment from 'moment'
    moment.locale('es');
    var audio = new Audio('../../audio/Nextel.mp3');

    export default {
        data(){
            return{
                devices:[],
                oldDevices:[],
                count:0,
                oldCount:0,
            }
        },
        created: function(){
            this.getDevices();
        },
        mounted: function(){
            //swal({ title: 'Usted no puede acceder', text: 'Hasta que no haga una reunion con ERIC LOPEZ', icon: 'error', buttons: true, timer:'5000' });
            setInterval(this.getDevices, 50000);
        },
        methods:{
            getDevices: function(){
                axios.get('/api/centinela/receptions/all')
                .then(response => {
                    this.oldDevices = this.devices;
                    this.devices = response.data;
                    this.compare();
                });
            },
            forHumans: function(d){
                if(d != null){
                    return moment(d).fromNow();
                }else{
                    return 'sin datos';
                }
            },
            alertSound: function(){
                audio.play();
            },
            compare: function(){

                for (var i = 0; i < this.devices.length; i++) this.count += this.devices[i].alerts_count;
                for (var i = 0; i < this.oldDevices.length; i++) this.oldCount += this.oldDevices[i].alerts_count;

                if(this.count > this.oldCount) this.alertSound();

                this.count = 0;
                this.oldCount = 0;
            }

        }
    }
</script>