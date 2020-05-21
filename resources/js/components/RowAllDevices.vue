<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        Componente Nuevooooooooo
                        <form @submit.prevent="agregar">

                            <input type="text" v-model="tarea.nombre">
                            <button type="submit">ghc</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                tareas:[],
                tarea:{nombre:""}
            }
        },
        created(){
            axios.get('/devices/1011462256')
                .then(res=>{
                    console.log(res.data);
                });
        },
        methods:{
            agregar(){
                console.log(this.tarea.nombre);
            }
        }
    }
</script>