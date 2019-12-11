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
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="hidden-xs">ID</th>
                            <th>Nombre</th>
                            <th colspan="1" class="text-center">Usuario</th>
                            <th style="min-width: 15%" class="text-center"><em class="fa fa-cog"></em></th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(representative, index) in representatives">
                            <tr class="freightrow">
                                <th class="hidden-xs" scope="row">{{ index + 1 }}</th>
                                <td>
                                  <em class="d-block"><i class="fas fa-user"></i> {{ representative.username }}</em>
                                </td>
                                <td>
                                    <router-link :to="{name: 'representatives', params: {freightnumber: representative.username }}"> {{ representative.name }} </router-link>
                                </td>
                                <td align="center">
                                    <a class="btn btn-success"><em class="fa fa-pencil-alt"></em></a>
                                    <a class="btn btn-danger" v-on:click="deleteRepresentative()"><em class="fa fa-trash"></em></a>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                </table>

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
        },
        methods : {
            deleteRepresentative() {
                this.$swal.fire({
                    title: '¿Estas seguro?',
                    text: "¡No podras deshacer esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, borralo!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                  if (result.value) {
                      axios.post('/representatives/register', params)
                      .then((response) => {
                          //reset all inputs

                          this.$swal.fire(
                            'Borrado!',
                            'El representante ha sido borrado',
                            'success'
                          )
                          this.$router.push({name: 'representatives'})
                      })
                      .catch((error) => {
                          this.has_error = true
                          this.errors = error.response.data.errors
                      });
                  }
                })
            }
        }
    }
</script>
