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
                    <input type="text" class="form-control" id="pickupfrom" v-model="pickupfrom" />
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Municipio:</label>
                    <input type="text" class="form-control" id="pickupfrom" v-model="pickupfrom" />
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Dirección:</label>
                    <input type="text" class="form-control" id="pickupfrom" v-model="pickupfrom" />
                </div>
            </div>
            <div class="col-md-6">
                <h5>Datos de destino</h5>
                <div class="form-group">
                    <label for="pickupfrom">Estado:</label>
                    <input type="text" class="form-control" id="deliverto" v-model="deliverto" />
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Municipio:</label>
                    <input type="text" class="form-control" id="deliverto" v-model="deliverto" />
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Dirección:</label>
                    <input type="text" class="form-control" id="deliverto" v-model="deliverto" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <hr/>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</template>
<script>
    export default {
        data() {
            return {
                errors: [],
                loadnumber: '',
                weight: '',
                description: '',
                pickupfrom: '',
                deliverto: ''
            }
        },
        methods: {
            newLoad () {
                const params = {
                    loadnumber: this.loadnumber,
                    description: this.description,
                    pickupfrom: this.pickupfrom,
                    deliverto: this.deliverto,
                    weight: this.weight,
                };

                axios.post('/loads', params)
                .then((response) => {
                    //reset all inputs
                    Object.assign(this.$data, this.$options.data.call(this));
                });
            },
            checkForm: function (e) {
                  if (this.loadnumber && this.weight && this.pickupfrom && this.deliverto) {
                    return true;
                  }

                  this.errors = [];

                  if (!this.loadnumber) {
                    this.errors.push('Numero de carga requerido');
                  }
                  if (!this.weight) {
                    this.errors.push('Peso requerido');
                  }
                  if (!this.pickupfrom) {
                    this.errors.push('Origen requerido');
                  }
                  if (!this.deliverto) {
                    this.errors.push('Destino requerido');
                  }

                  e.preventDefault();
            }
        },
        mounted() {

        }
    }
</script>
