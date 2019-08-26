<template>
    <form v-on:submit.prevent="newLoad" @submit="checkForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="danger" v-if="errors.length">
                    <b>Por favor, corrija los siguiente errores:</b>
                    <ul>
                      <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="loadnumber">Numero de carga:</label>
                    <input type="text" v-model="loadnumber" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="weight">Peso:</label>
                    <input type="number"  v-model="weight" class="form-control" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="description">Descripción:</label>
                    <textarea class="form-control"  v-model="description" rows="4"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h5>Datos de origen</h5>
                <div class="form-group">
                    <label for="pickupfrom">Estado:</label>
                    <select class="form-control" v-model="fromestado_id">
                        <option v-for="estado in estados" :value="estado.id">{{estado.nombre}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Municipio:</label>
                    <select class="form-control" v-model="frommunicipio_id">
                        <option v-for="municipio in municipiosFrom" :value="municipio.id">{{municipio.nombre}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Dirección:</label>
                    <input type="text" class="form-control" v-model="fromaddress" />
                </div>
            </div>
            <div class="col-md-6">
                <h5>Datos de destino</h5>
                <div class="form-group">
                    <label for="pickupfrom">Estado:</label>
                    <select class="form-control" v-model="toestado_id">
                        <option v-for="estado in estados" :value="estado.id">{{estado.nombre}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Municipio:</label>
                    <select class="form-control" v-model="tomunicipio_id">
                        <option v-for="municipio in municipiosTo" :value="municipio.id">{{municipio.nombre}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Dirección:</label>
                    <input type="text" class="form-control" id="deliverto" v-model="toaddress" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr/>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                <router-link class="btn btn-secondary btn-create" :to="{name: 'myloads'}"><i class="fas fa-ban"></i> Cancelar</router-link>
            </div>
        </div>
    </form>
</template>
<script>
    export default {
        data() {
            return {
                estados: [],
                municipiosFrom: [],
                municipiosTo: [],
                errors: [],
                loadnumber: '',
                weight: '',
                description: '',
                fromestado_id: '',
                frommunicipio_id: '',
                fromaddress: '',
                toestado_id: '',
                tomunicipio_id: '',
                toaddress: ''
            }
        },
        methods: {
            newLoad () {
                const params = {
                    loadnumber: this.loadnumber,
                    description: this.description,
                    fromestado_id: this.fromestado_id,
                    frommunicipio_id: this.frommunicipio_id,
                    fromaddress: this.fromaddress,
                    toestado_id: this.toestado_id,
                    tomunicipio_id: this.tomunicipio_id,
                    toaddress: this.toaddress,
                    weight: this.weight,
                };

                axios.post('/loads', params)
                .then((response) => {
                    //reset all inputs
                    Object.assign(this.$data, this.$options.data.call(this));
                    this.$router.push({name: 'myloads'})
                });
            },
            checkForm: function (e) {
                  if (this.loadnumber &&
                            this.weight &&
                            this.toaddress &&
                            this.tomunicipio_id &&
                            this.toestado_id &&
                            this.fromaddress &&
                            this.frommunicipio_id &&
                            this.fromestado_id &&
                             this.deliverto) {
                    return true;
                  }

                  this.errors = [];

                  if (!this.loadnumber) {
                    this.errors.push('Numero de carga requerido');
                  }
                  if (!this.weight) {
                    this.errors.push('Peso requerido');
                  }
                  if (!this.toaddress) {
                    this.errors.push('Direccion de destino requerido');
                  }
                  if (!this.tomunicipio_id) {
                    this.errors.push('municipio de destino requerido');
                  }
                  if (!this.toestado_id) {
                    this.errors.push('Estado de destino requerido');
                  }
                  if (!this.fromaddress) {
                    this.errors.push('Direccion de origen requerido');
                  }
                  if (!this.frommunicipio_id) {
                    this.errors.push('municipio de origen requerido');
                  }
                  if (!this.fromestado_id) {
                    this.errors.push('Estado de origen requerido');
                  }


                  e.preventDefault();
            }
        },
        mounted() {
            axios.get('/localidades').then((response) =>{
                this.estados = response.data;
            });
        },
        watch: {
            fromestado_id: function (newVal) {
                axios.get('/localidades/' + newVal).then((response) =>{
                    this.municipiosFrom = response.data;
                });
            },
            toestado_id: function (newVal) {
                axios.get('/localidades/' + newVal).then((response) =>{
                    this.municipiosTo = response.data;
                });
            }
        }
    }
</script>
