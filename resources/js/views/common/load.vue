<template>
    <div class="row">
        <div class="col-md-12">
            <h4>Numero de carga: <strong>{{ load.loadnumber }}</strong></h4>
            <hr />
        </div>
        <div class="col-md-12">
            Descripcion: {{ load.description }}
        </div>
        <div class="col-md-12">
            Peso: {{ load.weight }} {{ load.weightunit }}
        </div>
        <div class="col-md-12">
            <hr/>
            <h5>Origen</h5>
        </div>
        <div class="col-md-12">
            Estado: {{ load.frommunicipio.estado.nombre }}<br/>
            Municipio: {{ load.frommunicipio.nombre }}<br/>
            Direccion: {{ load.fromaddress }}<br/>
        </div>
        <div class="col-md-12">
            <hr/>
            <h5>Destino</h5>
        </div>
        <div class="col-md-12">
            Estado: {{ load.tomunicipio.estado.nombre }}<br/>
            Municipio: {{ load.tomunicipio.nombre }}<br/>
            Direccion: {{ load.toaddress }}<br/>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                load: '',
            }
        },
        mounted() {
            console.log(this.$route.params.loadnumber)
            axios.get('/loads/' + this.$route.params.loadnumber).then((response) =>{
                this.load = response.data;
            });
        }
    }
</script>
