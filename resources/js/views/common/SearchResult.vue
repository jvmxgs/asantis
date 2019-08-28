<template>
    <table class="table table-striped table-bordered table-list">
        <tbody v-for="load in loads" v-bind:key="load.id">
            <tr>
              <td rowspan="2" class="hidden-xs">{{ load.id }}</td>
              <td rowspan="2">{{ load.loadnumber }}</td>
              <td>{{ load.frommunicipio.estado.nombre }}</td>
              <td>{{ load.tomunicipio.estado.nombre }}</td>
              <td rowspan="2">{{ load.weight }}</td>
              <td rowspan="2" align="center">
                <a class="btn btn-success"><em class="fa fa-plus"></em></a>
              </td>
            </tr>
            <tr>
                <td>{{ load.frommunicipio.nombre }}</td>
                <td>{{ load.tomunicipio.nombre }}</td>
            </tr>
            <tr v-if="!loads.length">
              <td colspan="6" class="text-center">No se encontraron registros</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: ['loads']
    }
</script>
