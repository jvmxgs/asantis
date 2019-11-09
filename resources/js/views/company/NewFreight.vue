<template>
    <form  @submit="checkForm" v-on:submit.prevent="newFreight">
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
                        <option value=""></option>
                        <option value="kg">Kilos</option>
                        <option value="lb">Libras</option>
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
                <div class="form-group autocomplete" v-if="origentexto === ''">
                    <label for="pickupfrom">Buscar cabecera municipal:</label>
                    <input type="text" class="form-control autocomplete" v-model="origeninput" v-on:keyup="getLoacalidades(origeninput, 'origen')" />
                    <ul class="autocompleteresults list-group">
                        <li class="list-group-item" v-for="acresult in origenresults" v-on:click="handleSelectMunicipioFrom(acresult, 'origen')">{{acresult.nombre}} - {{acresult.estado.nombre}}</li>
                    </ul>
                </div>
                <div class="alert alert-info" role="alert" v-if="origentexto">
                    {{ origentexto }}
                    <button type="button" class="close" aria-label="Close" v-on:click="origenclose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group" v-if="localidadesFrom.length">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" v-model="origenenlocalidad" />
                        <label class="form-check-label" for="origenenlocalidad">El origen se encuentra en una localidad de este municipio</label>
                    </div>
                    <div class="form-group" v-if="origenenlocalidad">
                        <label for="fromlocalidad_id">Localidad:</label>
                        <select class="form-control" v-model="fromlocalidad_id">
                            <option v-for="localidad in localidadesFrom" :value="localidad.id">{{localidad.nombre}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="toaddress">Dirección:</label>
                    <input type="text" class="form-control" v-model="toaddress" />
                </div>
                <div class="form-group">
                    <label for="arrivaltime">Fecha y hora de salida:</label>
                    <date-picker v-model="arrivaltime" :config="options"></date-picker>
                </div>
            </div>


            <div class="col-md-6">
                <h4>Se dirige hacia:</h4>
                <div class="form-group autocomplete" v-if="destinotexto === ''">
                    <label for="pickupfrom">Buscar cabecera municipal:</label>
                    <input type="text" class="form-control autocomplete" v-model="destinoinput" v-on:keyup="getLoacalidades(destinoinput)" />
                    <ul class="autocompleteresults list-group">
                        <li class="list-group-item" v-for="acresult in destinoresults" v-on:click="handleSelectMunicipioFrom(acresult)">{{acresult.nombre}} - {{acresult.estado.nombre}}</li>
                    </ul>
                </div>
                <div class="alert alert-info" role="alert" v-if="destinotexto">
                    {{ destinotexto }}
                    <button type="button" class="close" aria-label="Close" v-on:click="destinoclose">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group" v-if="localidadesTo.length">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" v-model="destinoenlocalidad" />
                        <label class="form-check-label" for="destinoenlocalidad">El destino se encuentra en una localidad de este municipio</label>
                    </div>
                    <div class="form-group" v-if="destinoenlocalidad">
                        <label for="tolocalidad_id">Localidad:</label>
                        <select class="form-control" v-model="tolocalidad_id">
                            <option v-for="localidad in localidadesTo" :value="localidad.id">{{localidad.nombre}}</option>
                        </select>
                    </div>
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
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr/>
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
                <router-link class="btn btn-secondary btn-create" :to="{name: 'myfreights'}"><i class="fas fa-ban"></i> Cancelar</router-link>
            </div>
        </div>
    </form>
</template>
<style scoped>
    .autocomplete {
        position: relative;
        display: inline-block;
        width:100%;
    }
    .autocompleteresults li:hover {
        background:#eee;
    }
    .autocompleteresults {
        list-style-type:none;
        position: absolute;
        z-index: 99;
        top: 100%;
        left: 0;
        right: 0;
    }
</style>
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
                errors: [],

                origeninput: '',
                origentexto: '',
                origenmunicipioid: '',
                origenresults: [],
                origenenlocalidad: false,
                localidadesTo: [],
                tolocalidad_id: '',
                toaddress: '',
                arrivaltime: '',

                destinoinput: '',
                destinotexto: '',
                destinomunicipioid: '',
                destinoresults: [],
                destinoenlocalidad: false,
                localidadesFrom: [],
                fromlocalidad_id: '',
                fromaddress: '',
                departuretime: '',

                weight: '',
                weightunit: '',
                description: '',

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
            newFreight () {
                if (!this.errors.length) {
                    if (this.isSaving) {
                        return
                    }

                    this.isSaving = true;

                    const params = {
                        description: this.description,

                        origenmunicipioid: this.origenmunicipioid,
                        fromlocalidad_id: this.fromlocalidad_id,
                        fromaddress: this.fromaddress,
                        departuretime: this.departuretime,

                        destinomunicipioid: this.destinomunicipioid,
                        tolocalidad_id: this.tolocalidad_id,
                        toaddress: this.toaddress,
                        arrivaltime: this.arrivaltime,

                        weight: this.weight,
                        weightunit: this.weightunit,
                    };

                    axios.post('/freights', params)
                    .then((response) => {
                        //reset all inputs
                        Object.assign(this.$data, this.$options.data.call(this));
                        this.$swal.fire({
                            title: 'Grandioso',
                            text: 'Se ha guardado correctamente la carga',
                            type: 'success',
                            confirmButtonText: 'Genial'
                        })
                        this.$router.push({name: 'myfreights'})
                    });
                }
            },
            checkForm: function (e) {
                this.errors = [];
                if (this.weight &&
                    this.weightunit &&
                    this.fromaddress &&
                    this.departuretime &&
                    this.fromlocalidad_id &&
                    this.toaddress &&
                    this.arrivaltime &&
                    this.tolocalidad_id) {
                    return true;
                }

                if (!this.weight) {
                    this.errors.push('Peso requerido');
                }
                if (!this.weightunit) {
                    this.errors.push('Unidad de peso requerido');
                }
                if (!this.fromlocalidad_id) {
                    this.errors.push('Origen requerido');
                }
                if (!this.fromaddress) {
                    this.errors.push('Direccion de origen requerido');
                }
                if (!this.departuretime) {
                    this.errors.push('Fecha y hora de salida requerido');
                }
                if (!this.tolocalidad_id) {
                    this.errors.push('Destino requerido');
                }
                if (!this.toaddress) {
                    this.errors.push('Direccion de destino requerido');
                }
                if (!this.arrivaltime) {
                    this.errors.push('Fecha y hora de llegada requerido');
                }
                e.preventDefault();
            },
            getLoacalidades : function (searchtext, on) {
                axios.get('/localidades/buscarlocalidad/' + searchtext).then((response) =>{
                    if (on === "origen") {
                        this.origenresults = response.data;
                    } else {
                        this.destinoresults = response.data;
                    }
                });
            },
            handleSelectMunicipioFrom : function (item, on) {
                if (on === "origen") {
                    this.origeninput = item.nombre;
                    this.origentexto = item.nombre + " - " + item.estado.nombre;
                    this.origenmunicipioid = item.id;
                    this.origenresults = [];
                    this.fromlocalidad_id = '0';
                } else {
                    this.destinoinput = item.nombre;
                    this.destinotexto = item.nombre + " - " + item.estado.nombre;
                    this.destinomunicipioid = item.id;
                    this.destinoresults = [];
                    this.tolocalidad_id = '0';
                }
            },
            origenclose: function () {
                this.origentexto = "";
                this.origenmunicipioid = "";
                this.localidadesFrom = "";
                this.origenenlocalidad = false;
                this.fromlocalidad_id = '';
            },
            destinoclose: function () {
                this.destinotexto = "";
                this.destinomunicipioid = "";
                this.localidadesTo = "";
                this.destinoenlocalidad = false;
                this.tolocalidad_id = '';
            }
        },
        watch: {
            origentexto: function () {
                if (this.origenmunicipioid) {
                    axios.get('/municipios/' + this.origenmunicipioid + '/localidades').then((response) =>{
                        this.localidadesFrom = response.data;
                    });
                }
            },
            destinotexto: function () {
                if (this.destinomunicipioid) {
                    axios.get('/municipios/' + this.destinomunicipioid + '/localidades').then((response) =>{
                        this.localidadesTo = response.data;
                    });
                }
            },
        }
    }
</script>
