<template>
    <table class="table table-striped table-hover">
        <tbody>
            <template v-for="(load, index) in loads">
                <tr class="loadrow">
                    <th class="hidden-xs" scope="row">{{ index + 1 }}</th>
                    <td class="hidden-xs">
                        <router-link :to="{name: 'loads', params: {loadnumber: load.loadnumber}}"> {{ load.loadnumber }} </router-link>
                        <em><i class="fas fa-weight"></i> {{ load.weight }} {{ load.weightunit}}</em>
                    </td>
                    <td>
                        <span><i class="fas fa-map-marked-alt"></i> {{ load.frommunicipio.estado.nombre }}</span>
                        <i><i class="fas fa-map-marker-alt"></i> {{ load.frommunicipio.nombre }}</i>
                        <em><i class="fas fa-calendar-alt"></i> {{ load.departuretime }}</em>
                    </td>
                    <td>
                        <i class="fas fa-angle-right fa-3x"></i>
                    </td>
                    <td>
                        <span><i class="fas fa-map-marked-alt"></i> {{ load.tomunicipio.estado.nombre }}</span>
                        <i><i class="fas fa-map-marker-alt"></i> {{ load.tomunicipio.nombre }}</i>
                        <em><i class="fas fa-calendar-alt"></i> {{ load.arrivaltime }}</em>
                    </td>
                    <td align="center">
                        <a class="btn btn-success"><em class="fa fa-plus"></em></a>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</template>

<style scoped>
    .loadrow td span {
        display: block;
        font-weight: bold;
    }
    .loadrow td em {
        display: block;
    }
</style>

<script>
    export default {
        props: ['loads']
    }
</script>
