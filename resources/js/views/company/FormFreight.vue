<template>
    <form v-on:submit.prevent="sendForm">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="danger" v-if="Object.keys(errors).length">
                    <b>Por favor, corrija los siguiente errores:</b>
                    <ul>
                        <template v-for="error in errors">
                            <li v-for="msg in error">{{ msg }}</li>
                        </template>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <h4>Datos generales:</h4>
                <hr/>
            </div>
            <div class="col-md-6">

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fas fa-weight"></i>
                    </span>
                  </div>
                  <input type="number" placeholder="Peso" v-model="freight.weight" class="form-control" />
                  <div class="input-group-append">
                    <select v-model="freight.weightunit" class="form-control">
                        <option value="" hidden></option>
                        <option value="kg">Kilos</option>
                        <option value="lb">Libras</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                    <select class="form-control" v-model="freight.trucktype">
                        <option value="" hidden>Tipo de unidad</option>
                        <option value="panel">Panel</option>
                        <option value="rabon">Rabon</option>
                        <option value="caja53">Caja de 53 pies</option>
                        <option value="termorefrigerado">Termo refrigerado</option>
                    </select>
                </div>

            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <textarea class="form-control" placeholder="Descripcion del viaje" v-model="freight.description" rows="4"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <h4>Sale desde:</h4>
                <div class="form-group autocomplete" v-if="origentexto === ''">
                    <label for="pickupfrom">Buscar cabecera municipal:</label>
                    <input type="text" class="form-control autocomplete" v-model="origeninput" v-on:keyup="getLocalidades(origeninput, 'origen')" />
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
                        <select class="form-control" v-model="freight.fromlocalidad_id">
                            <option v-for="localidad in localidadesFrom" :value="localidad.id">{{localidad.nombre}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="toaddress">Dirección:</label>
                    <input type="text" class="form-control" v-model="freight.toaddress" />
                </div>
                <div class="form-group">
                    <label for="arrivaltime">Fecha y hora de salida:</label>
                    <date-picker v-model="freight.arrivaltime" :config="options"></date-picker>
                </div>
            </div>


            <div class="col-md-6">
                <h4>Se dirige hacia:</h4>
                <div class="form-group autocomplete" v-if="destinotexto === ''">
                    <label for="pickupfrom">Buscar cabecera municipal:</label>
                    <input type="text" class="form-control autocomplete" v-model="destinoinput" v-on:keyup="getLocalidades(destinoinput)" />
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
                        <select class="form-control" v-model="freight.tolocalidad_id">
                            <option v-for="localidad in localidadesTo" :value="localidad.id">{{localidad.nombre}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Dirección:</label>
                    <input type="text" class="form-control" v-model="freight.fromaddress" />
                </div>
                <div class="form-group">
                    <label for="pickupfrom">Fecha y hora de llegada:</label>
                    <date-picker v-model="freight.departuretime" :config="options"></date-picker>
                </div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-12">
                <h4>Pago:</h4>
                <hr/>
            </div>
            <div class="col-md-4">
                <label for="amount">Presupuesto disponible</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                  </div>
                  <input type="number" class="form-control" v-model="freight.amount" aria-label="Amount (to the nearest dollar)">
                  <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                  </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <hr/>

                <button type="submit" class="btn btn-primary">
                    <div v-if="isSaving" class="spinner-border spinner-border-sm" role="status">
                      <span class="sr-only">Guardando...</span>
                    </div>
                    <span v-else><i class="fas fa-save"></i> Guardar</span>
                </button>
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
                editMode: false,
                isSaving: false,
                errors: {},

                freight: {
                    weight: '',
                    weightunit: '',
                    description: '',

                    origenmunicipioid: '',
                    fromlocalidad_id: '',
                    fromaddress: '',
                    departuretime: '',

                    destinomunicipioid: '',
                    tolocalidad_id: '',
                    toaddress: '',
                    arrivaltime: '',

                    trucktype: '',
                    amount: ''
                },

                origeninput: '',
                origentexto: '',
                origenresults: [],
                origenenlocalidad: false,
                localidadesTo: [],

                destinoinput: '',
                destinotexto: '',
                destinoresults: [],
                destinoenlocalidad: false,
                localidadesFrom: [],

                date: new Date(),
                options: {
                    format: 'YYYY/MM/DD HH:mm',
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
        mounted () {
            if (this.$route.params.freight_number) {
                this.editMode = true;
                this.getFreight(this.$route.params.freight_number);
            }
        },
        methods: {
            sendForm () {
                if (this.isSaving) {
                    return
                }
                this.errors = {}
                this.isSaving = true;

                const params = this.freight;

                if (this.editMode) {
                    axios.put('/freights/' + this.$route.params.freight_number, params)
                    .then((response) => {
                        //reset all inputs
                        Object.assign(this.$data, this.$options.data.call(this));
                        this.$swal.fire({
                            title: 'Grandioso',
                            text: 'Se ha actualizado correctamente el viaje',
                            type: 'success',
                            confirmButtonText: 'Genial'
                        })
                        this.$router.push({name: 'myfreights'})
                    }).catch((error) => {
                        this.isSaving = false;
                        this.errors = error.response.data.errors
                    });
                } else {
                    axios.post('/freights', params)
                    .then((response) => {
                        //reset all inputs
                        Object.assign(this.$data, this.$options.data.call(this));
                        this.$swal.fire({
                            title: 'Grandioso',
                            text: 'Se ha guardado correctamente el viaje',
                            type: 'success',
                            confirmButtonText: 'Genial'
                        })
                        this.$router.push({name: 'myfreights'})
                    }).catch((error) => {
                        this.isSaving = false;
                        this.errors = error.response.data.errors
                    });
                }
            },
            getFreight(freightnumber) {
                axios.get('/freights/' + freightnumber).then((response) =>{
                    this.freight = response.data;
                    if (this.editMode) {
                        let fromlocalidad_id = this.freight.fromlocalidad_id
                        let tolocalidad_id = this.freight.tolocalidad_id
                        this.handleSelectMunicipioFrom(this.freight.fromlocalidad.municipio, 'origen')
                        this.handleSelectMunicipioFrom(this.freight.tolocalidad.municipio)
                        this.getLocalidades(this.origentexto, 'origen')
                        this.getLocalidades(this.destinotexto)
                        this.destinoenlocalidad = true
                        this.origenenlocalidad = true
                        this.freight.fromlocalidad_id = fromlocalidad_id
                        this.freight.tolocalidad_id = tolocalidad_id
                    }
                });
            },
            getLocalidades : function (searchtext, on) {
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
                    this.freight.origenmunicipioid = item.id;
                    this.origenresults = [];
                    this.freight.fromlocalidad_id = '0';
                } else {
                    this.destinoinput = item.nombre;
                    this.destinotexto = item.nombre + " - " + item.estado.nombre;
                    this.freight.destinomunicipioid = item.id;
                    this.destinoresults = [];
                    this.freight.tolocalidad_id = '0';
                }
            },
            origenclose: function () {
                this.origentexto = "";
                this.freight.origenmunicipioid = "";
                this.localidadesFrom = "";
                this.origenenlocalidad = false;
                this.freight.fromlocalidad_id = '';
            },
            destinoclose: function () {
                this.destinotexto = "";
                this.freight.destinomunicipioid = "";
                this.localidadesTo = "";
                this.destinoenlocalidad = false;
                this.freight.tolocalidad_id = '';
            }
        },
        watch: {
            origentexto: function () {
                if (this.freight.origenmunicipioid) {
                    axios.get('/municipios/' + this.freight.origenmunicipioid + '/localidades').then((response) =>{
                        this.localidadesFrom = response.data;
                    });
                }
            },
            destinotexto: function () {
                if (this.freight.destinomunicipioid) {
                    axios.get('/municipios/' + this.freight.destinomunicipioid + '/localidades').then((response) =>{
                        this.localidadesTo = response.data;
                    });
                }
            },
        }
    }
</script>
