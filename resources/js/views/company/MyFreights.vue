<template>
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <h3 class="panel-title">Mis viajes</h3>
                </div>
                <div class="col col-xs-6 text-right">
                    <router-link class="btn btn-sm btn-primary btn-create" :to="{name: 'newfreight'}"><i class="fas fa-plus"></i> Nuevo Viaje</router-link>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="hidden-xs">ID</th>
                        <th>Datos del viaje</th>
                        <th colspan="1" class="text-center">Origen - Destino</th>
                        <th style="min-width: 15%" class="text-center"><em class="fa fa-cog"></em></th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(freight, index) in freights.data">
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
                            <td align="center">
                                <router-link :to="{name: 'updatefreight', params: {freight_number: freight.freightnumber }}" class="btn btn-success"><em class="fa fa-pencil-alt text-dark"></em></router-link>
                                <a class="btn btn-danger" v-on:click="deleteFreight(freight.id)"><em class="fa fa-trash"></em></a>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col col-xs-4">Pagina {{ freights.current_page }} de {{ freights.last_page }}</div>
                <div class="col col-xs-8">
                    <pagination :data="freights" @pagination-change-page="getMyFreights" class="justify-content-end">
                        <span slot="prev-nav">&lt; Anterior</span>
	                    <span slot="next-nav">Siguiente &gt;</span>
                    </pagination>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        components: {
        },
        data() {
            return {
                freights: {}
            }
        },
        mounted () {
            this.getMyFreights();
        },
        methods: {
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
                          this.getMyFreights()
                      });
                  }
                })
            },
            getMyFreights(page = 1) {
                axios.get('/freights?page=' + page).then((response) =>{
                    this.freights = response.data;
                });
            }
        }
    }
</script>
