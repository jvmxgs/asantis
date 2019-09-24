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
            <div class="col-md-12">
                <h4>Datos generales:</h4>
            </div>
            <div class="col-md-6">

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-weight"></i>
                    </span>
                  </div>
                  <input type="number" placeholder="Peso" v-model="weight" class="form-control" />
                  <div class="input-group-append">
                    <select v-model="weightunit" class="form-control">
                        <option>Kilos</option>
                        <option>Libras</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Descripcion del viaje" v-model="description" rows="4"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Sale desde:</h4>
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
                <div class="form-group">
                    <label for="pickupfrom">Fecha y hora de salida:</label>
                    <date-picker v-model="departuretime" :config="options"></date-picker>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Se dirige hacia:</h4>
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
                <div class="form-group">
                    <label for="pickupfrom">Fecha y hora de llegada:</label>
                    <date-picker v-model="arrivaltime" :config="options"></date-picker>
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
    import datePicker from 'vue-bootstrap-datetimepicker';
    import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

    export default {
        components: {
            datePicker
        },
        data() {
            return {
                isSaving: false,
                estados: [],
                municipiosFrom: [],
                municipiosTo: [],
                errors: [],
                weight: '',
                weightunit: '',
                description: '',

                fromestado_id: '',
                frommunicipio_id: '',
                fromaddress: '',
                departuretime: '',

                toestado_id: '',
                tomunicipio_id: '',
                toaddress: '',
                arrivaltime: '',

                date: new Date(),
                options: {
                    format: 'YYYY/MM/DD H:m',
                    useCurrent: false,
                    showClear: true,
                    showClose: true,
                    icons: {
                      time: 'fas fa-clock',
                      date: 'fas fa-calendar',
                      clear: 'fas fa-trash-alt',
                      close: 'fas fa-times-circle'
                    }
                }
            }
        },
        methods: {
            newLoad () {
                if (this.isSaving) {
                    return
                }

                this.isSaving = true;

                const params = {
                    description: this.description,

                    fromestado_id: this.fromestado_id,
                    frommunicipio_id: this.frommunicipio_id,
                    fromaddress: this.fromaddress,
                    departuretime: this.departuretime,

                    toestado_id: this.toestado_id,
                    tomunicipio_id: this.tomunicipio_id,
                    toaddress: this.toaddress,
                    arrivaltime: this.arrivaltime,

                    weight: this.weight,
                    weightunit: this.weightunit,
                };

                axios.post('/loads', params)
                .then((response) => {
                    //reset all inputs
                    Object.assign(this.$data, this.$options.data.call(this));
                    this.$swal.fire({
                      title: 'Grandioso',
                      text: 'Se ha guardado correctamente la carga',
                      type: 'success',
                      confirmButtonText: 'Genial'
                    })
                    this.$router.push({name: 'myloads'})
                });
            },
            checkForm: function (e) {
                  if (this.weight &&
                            this.toaddress &&
                            this.tomunicipio_id &&
                            this.toestado_id &&
                            this.departuretime &&
                            this.fromaddress &&
                            this.frommunicipio_id &&
                            this.fromestado_id &&
                            this.toaddress &&
                             this.arrivaltime) {
                    return true;
                  }

                  this.errors = [];

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
                  if (!this.departuretime) {
                    this.errors.push('Fecha y hora de salida requerido');
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
                  if (!this.arrivaltime) {
                    this.errors.push('Fecha y hora de llegada requerido');
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
