<template>
    <table class="table table-striped table-hover">
        <tbody>
            <template v-for="(freight, index) in freights">
                <tr class="freightrow" @click="goToFreight(freight.freightnumber)">
                    <th class="hidden-xs" scope="row">{{ index + 1 }}</th>
                    <td class="hidden-xs">
                        <strong class="text-primary">{{ freight.freightnumber }}</strong>
                        <em><i class="fas fa-weight"></i> {{ freight.weight }} {{ freight.weightunit}}</em>
                    </td>
                    <td>
                        <span><i class="fas fa-map-marked-alt"></i> {{ freight.fromlocalidad.municipio.estado.nombre }}</span>
                        <i><i class="fas fa-map-marker-alt"></i> {{ freight.fromlocalidad.municipio.nombre }}</i>
                        <em><i class="fas fa-map-marker-alt"></i> {{ freight.fromlocalidad.nombre }}</em>
                        <em><i class="fas fa-calendar-alt"></i> {{ freight.departuretime }}</em>
                    </td>
                    <td>
                        <i class="fas fa-angle-right fa-3x"></i>
                    </td>
                    <td>
                        <span><i class="fas fa-map-marked-alt"></i> {{ freight.tolocalidad.municipio.estado.nombre }}</span>
                        <i><i class="fas fa-map-marker-alt"></i> {{ freight.tolocalidad.municipio.nombre }}</i>
                        <em><i class="fas fa-map-marker-alt"></i> {{ freight.tolocalidad.nombre }}</em>
                        <em><i class="fas fa-calendar-alt"></i> {{ freight.arrivaltime }}</em>
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
</template>

<style scoped>
    .freightrow {
        cursor: pointer;
        border-left:3px solid transparent;
    }

    .freightrow:hover{
        border-color: var(--blue);
    }

    .freightrow td span {
        display: block;
        font-weight: bold;
    }
    .freightrow td em {
        display: block;
    }
</style>

<script>
    export default {
        props: ['freights'],
        methods: {
            goToFreight(ln) {
                var routeData = this.$router.resolve({ name: 'freights', params: {freightnumber: ln} });
                window.open(routeData.href, '_blank');
            }
        }
    }
</script>
