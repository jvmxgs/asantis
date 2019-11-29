<template>
    <div class="panel panel-default panel-table">
        <div class="panel-heading">
            <div class="row">
                <div class="col col-xs-6">
                    <h3 class="panel-title">Representantes de Asantis</h3>
                </div>

                <div class="col col-xs-6 text-right">
                    <router-link class="btn btn-sm btn-primary btn-create" :to="{name: 'addrepresentative'}"><i class="fas fa-plus"></i> Nuevo representante</router-link>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-sm-4 mt-2" v-for="representative in representatives">
                      <div class="card">
                        <img src="/images/noprofile.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ representative.name }}</h5>
                          <p class="card-text">{{ representative.username }}</p>
                        </div>
                      </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                representatives: []
            }
        },
        mounted() {
            axios.get('/representatives').then((response) =>{
                this.representatives = response.data;
            });
        }
    }
</script>
