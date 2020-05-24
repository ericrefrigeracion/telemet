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
                        <td>{{ device.user_id }}</td>
                        <td>{{ device.id }}</td>
                        <td v-if="device.on_line"><i class="fas fa-link text-success m-2"  title="En Linea"></i></td>
                        <td v-else="device.on_line"><i class="fas fa-unlink text-danger m-2" title="Desconectado"></i></td>
                        <td v-if="device.protected" ><i class="far fa-eye text-success m-2" title="Protegido"></i></td>
                        <td v-else="device.protected" ><i class="far fa-eye-slash text-success m-2" title="Horario Permitido"></i></td>
                        <td v-if="device.on_temp" ><i class="fas fa-temperature-high text-success m-2" title="Temperatura dentro de los Limites"></i></td>
                        <td v-else="device.on_temp" ><i class="fas fa-temperature-high text-danger m-2" title="Temperatura fuera de Rango"></i></td>
                        <td v-if="device.on_performance" ><i class="far fa-check-circle text-success m-2" title="Rendimiento Normal"></i></td>
                        <td v-else="device.on_performance" ><i class="far fa-times-circle text-danger m-2" title="Rendimiento Bajo"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data(){
            return{
                devices:[],
                device:{}
            }
        },
        created: function(){
            this.getDevices();
            setInterval(this.getDevices, 10000);
        },
        methods:{
            getDevices: function(){
                axios.get('/api/devices')
                .then(response => {
                    this.devices = response.data;
                    console.log(this.devices);
                });
            }


        }
    }
</script>