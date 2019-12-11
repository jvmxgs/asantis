<template>
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-12 mt-2">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-info">
                                <i class="fa fa-user fa-5x text-white"></i>
                            </div>
                            <div class="p-2 media-body">
                                <h2 class="text-center font-weight-bold">2</h2>
                                <p class="small-text text-center">Usuarios nuevos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12 mt-2">
                <div class="card">
                    <div class="card-content">
                        <div class="media align-items-stretch">
                            <div class="p-2 text-center bg-info">
                                <i class="fa fa-truck fa-5x text-white"></i>
                            </div>
                            <div class="p-2 media-body">
                                <h2 class="text-center font-weight-bold">5</h2>
                                <p class="small-text text-center">Viajes nuevos</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-12 mt-2">
                <a class="text-decoration-none" href="asdf">
                    <div class="card">
                        <div class="card-content">
                            <div class="media align-items-stretch">
                                <div class="p-2 text-center bg-info">
                                    <i class="fa fa-comments fa-5x text-white"></i>
                                </div>
                                <div class="p-2 media-body">
                                    <h2 class="text-center font-weight-bold mb-0">10</h2>
                                    <p class="small-text text-center mb-0">Propuestas nuevas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <div class="panel panel-default panel-table">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col col-xs-6">
                                <h5 class="panel-title">Ultimos viajes</h5>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <template v-for="(freight, index) in freights.data">
                                    <tr class="freightrow">
                                        <th class="hidden-xs" scope="row">{{ index + 1 }}</th>
                                        <td>
                                          <router-link :to="{name: 'freights', params: {freightnumber: freight.freightnumber}}"> {{ freight.freightnumber }} </router-link>
                                          <em class="d-block"><i class="fas fa-weight"></i> {{ freight.weight }} {{ freight.weightunit}}</em>
                                        </td>
                                        <td>
                                            <div class="clearfix">
                                                <div>
                                                    <i class="fas fa-truck"></i>
                                                    <small>{{ freight.fromlocalidad.municipio.estado.nombre }}</small> |
                                                    <small>{{ freight.fromlocalidad.municipio.nombre }}</small>
                                                    <small class="text-muted">{{ freight.departuretime }}</small>
                                                </div>
                                                <div>
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <small>{{ freight.tolocalidad.municipio.estado.nombre }}</small> |
                                                    <small>{{ freight.tolocalidad.municipio.nombre }}</small>
                                                    <small class="text-muted">{{ freight.arrivaltime }}</small>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                freights: {}
            }
        },
        mounted () {
            axios.get('/freights').then((response) =>{
                this.freights = response.data;
            });
        }
    }
</script>
