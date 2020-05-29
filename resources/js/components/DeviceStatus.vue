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
                        <th colspan="4">Estado</th>
                        <th colspan="4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center" v-for="device in devices">
                        <td><a v-bind:href="device.user_route">{{ device.user_id }}</a></td>
                        <td><a v-bind:href="device.route">{{ device.id }}</a></td>
                        <td v-if="device.on_line"><i class="fas fa-link text-success m-2"  title="En Linea"></i></td>
                        <td v-else="device.on_line"><i class="fas fa-unlink text-danger m-2" title="Desconectado"></i></td>
                        <td v-if="device.protected" ><i class="far fa-eye text-success m-2" title="Protegido"></i></td>
                        <td v-else="device.protected" ><i class="far fa-eye-slash text-success m-2" title="Horario Permitido"></i></td>
                        <td><i v-bind:class="device.class_1" v-bind:title="device.title_1"></i></td>
                        <td><i v-bind:class="device.class_2" v-bind:title="device.title_2"></i></td>
                        <td>
                            <a v-bind:href="device.configuration_route" class="text-primary m-2" title="Configuracion Del Dispositivo"><i class="fas fa-cogs m-2"></i></a>
                        </td>
                        <td>
                            <a v-bind:href="device.receptions_route" class="text-primary m-2" title="Evolucion de las Temperaturas"><i class="fas fa-chart-line m-2"></i></a>
                        </td>
                        <td>
                            <a v-bind:href="device.logs_route" class="text-primary m-2" title="Logs Dispositivo"><i class="fas fa-clipboard-list m-2"></i></a>
                        </td>
                        <td>
                            <a v-bind:href="device.alerts_route" class="text-primary m-2" title="Nuevas Alertas"><i class="fas fa-bell m-2"></i></a>
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

    export default {
        data(){
            return{
                devices:[],
            }
        },
        created: function(){
            this.getDevices();
            setInterval(this.getDevices, 20000);
            swal({
              title: 'Telemet',
              text: 'You clicked the button!',
              icon: 'error',
              buttons: true,
              timer:'3000',
            });
        },
        methods:{
            getDevices: function(){
                axios.get('/api/devices/all')
                .then(response => {
                    this.devices = response.data;
                });
            }
        }
    }
</script>