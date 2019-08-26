<template>
<div class="panel panel-default panel-table">
    <div class="panel-heading">
    <div class="row">
      <div class="col col-xs-6">
        <h3 class="panel-title">Mis cargas</h3>
      </div>
      <div class="col col-xs-6 text-right">
        <router-link class="btn btn-sm btn-primary btn-create" :to="{name: 'newload'}"><i class="fas fa-plus"></i> Nueva carga</router-link>
      </div>
    </div>
    </div>
    <div class="panel-body">
    <table class="table table-striped table-bordered table-list">
      <thead>
        <tr>
            <th class="hidden-xs">ID</th>
            <th>Numero de carga</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Peso</th>
            <th style="min-width: 15%"><em class="fa fa-cog"></em></th>
        </tr>
      </thead>
      <tbody>
            <load-row
                v-for="load in loads"
                :key="load.id"
                :load="load">
            </load-row>
        </tbody>
    </table>

    </div>
    <div class="panel-footer">
    <div class="row">
      <div class="col col-xs-4">Pagina 1 de 5
      </div>
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
    import LoadRow from './LoadRow';

    export default {
        components: {
            LoadRow
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
