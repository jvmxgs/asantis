<template>
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <h3 class="panel-title">Mis viajes</h3>
                </div>
                <div class="col col-xs-6 text-right">
                    <router-link class="btn btn-sm btn-primary btn-create" :to="{name: 'newload'}"><i class="fas fa-plus"></i> Nuevo Viaje</router-link>
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
                    <template v-for="(load, index) in loads">
                        <tr class="loadrow">
                            <th class="hidden-xs" scope="row">{{ index + 1 }}</th>
                            <td>
                              <router-link :to="{name: 'loads', params: {loadnumber: load.loadnumber}}"> {{ load.loadnumber }} </router-link>
                              <em class="d-block"><i class="fas fa-weight"></i> {{ load.weight }} {{ load.weightunit}}</em>
                            </td>
                            <td>
                                <div class="clearfix">
                                    <div class="float-left">
                                        <strong>{{ load.fromlocalidad.municipio.estado.nombre }}</strong>
                                        <span class="d-block">{{ load.fromlocalidad.municipio.nombre }}</span>
                                        <span class="d-block">{{ load.fromlocalidad.nombre }}</span>
                                        <small class="text-muted">{{ load.departuretime }}</small>
                                    </div>
                                    <div class="float-right text-right">
                                        <strong>{{ load.tolocalidad.municipio.estado.nombre }}</strong>
                                        <span class="d-block">{{ load.tolocalidad.municipio.nombre }}</span>
                                        <span class="d-block">{{ load.tolocalidad.nombre }}</span>
                                        <small class="text-muted">{{ load.arrivaltime }}</small>
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
                                <a class="btn btn-success"><em class="fa fa-pencil-alt"></em></a>
                                <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col col-xs-4">Pagina 1 de 5</div>
                <div class="col col-xs-8">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">4</a></li>
                            <li class="page-item"><a class="page-link" href="#">5</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
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
                loads: []
            }
        },
        mounted () {
            axios.get('/loads').then((response) =>{
                this.loads = response.data;
            });
        }
    }
</script>
<style scoped>
    .progress-xs {
        height: 4px;
    }
</style>
