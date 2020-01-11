<template>
    <tr class="freightrow">
        <th class="hidden-xs" scope="row">{{ index + 1 }}</th>
        <td>
          <router-link :to="{name: 'freights', params: {freightnumber: freight.freightnumber}}"> {{ freight.freightnumber }} </router-link>
          <em class="d-block"><i class="fas fa-weight"></i> {{ freight.weight }} {{ freight.weightunit}}</em>
          <em class="d-block"><i class="fas fa-truck"></i> {{ freight.trucktype }}</em>
          <em class="d-block text-success"><i class="fas fa-dollar-sign"></i> {{ freight.amount }}</em>
        </td>
        <td>
            <div class="clearfix">
                <div class="float-left">
                    <strong>{{ freight.fromlocalidad.municipio.estado.nombre }}</strong>
                    <span class="d-block">{{ freight.fromlocalidad.municipio.nombre }}</span>
                    <span class="d-block">{{ freight.fromlocalidad.nombre }}</span>
                    <small class="text-muted">{{ freight.departuretime }}</small>
                </div>
                <div class="float-right text-right">
                    <strong>{{ freight.tolocalidad.municipio.estado.nombre }}</strong>
                    <span class="d-block">{{ freight.tolocalidad.municipio.nombre }}</span>
                    <span class="d-block">{{ freight.tolocalidad.nombre }}</span>
                    <small class="text-muted">{{ freight.arrivaltime }}</small>
                </div>
            </div>
            <div class="progress progress-xs">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="float-left">
                <i class="fas fa-truck"></i>
            </div>
            <div class="float-right">
                <i class="fas fa-map-marker-alt"></i>
            </div>
        </td>
        <td align="center" v-if="showActionButtons">
            <router-link :to="{name: 'updatefreight', params: {freight_number: freight.freightnumber }}" class="btn btn-success"><em class="fa fa-pencil-alt text-dark"></em></router-link>
            <a class="btn btn-danger" v-on:click="deleteFreight(freight.id)"><em class="fa fa-trash"></em></a>
        </td>
    </tr>
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
        props: ['freight', 'index', 'showActionButtons'],
        methods: {
            goToFreight(ln) {
                var routeData = this.$router.resolve({ name: 'freights', params: {freightnumber: ln} });
                window.open(routeData.href, '_blank');
            },
            deleteFreight(freight_id) {
                this.$swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡No podras deshacer esto!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, borralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                  if (result.value) {
                      axios.delete('/freights/' + freight_id)
                      .then((response) => {

                          this.$swal.fire(
                            'Borrado!',
                            'El representante ha sido borrado',
                            'success'
                          )
                          this.$emit('updateFreightList')
                      });
                  }
                })
            }
        }
    }
</script>
