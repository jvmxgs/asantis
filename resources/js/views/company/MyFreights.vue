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
                    <FreightRow
                        v-for="(freight, index) in freights.data"
                        :freight="freight"
                        :index="index"
                        :key="freight.id"
                        v-on:updateFreightList="getMyFreights"
                        :showActionButtons="true">
                    </FreightRow>
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
    import FreightRow from '../ui/FreightRow';

    export default {
        components: {
            FreightRow
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
            getMyFreights(page = 1) {
                axios.get('/freights?page=' + page).then((response) =>{
                    this.freights = response.data;
                });
            }
        }
    }
</script>
