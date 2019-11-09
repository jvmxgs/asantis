<template>
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <h3 class="panel-title">Mis propuestas</h3>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="hidden-xs">ID</th>
                        <th>Propuesta</th>
                        <th colspan="1" class="text-center">Núm. de viaje</th>
                        <th style="min-width: 15%" class="text-center"><em class="fa fa-cog"></em></th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(proposal, index) in proposals">
                        <tr class="proposalrow">
                            <th class="hidden-xs" scope="row">{{ index + 1 }}</th>
                            <td>
                              {{ proposal.proposalText }}
                            </td>
                            <td>
                                <router-link :to="{name: 'freights', params: {freightnumber: proposal.freight.freightnumber}}"> {{ proposal.freight.freightnumber }} </router-link>
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
        data() {
            return {
                proposals: []
            }
        },
        mounted() {
            axios.get('/proposals').then((response) =>{
                this.proposals = response.data;
            });
        }
    }
</script>
