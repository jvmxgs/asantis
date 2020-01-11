<template>
    <div>
        <form v-on:submit.prevent="doSearch">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control" placeholder="Palabras clave" type="text" v-model="keywords" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12" v-if="weightslider.rangeData.length">
                    <label for="range">Rango de peso (kg):</label>
                    <vue-slider :min="weightslider.min" :tooltip="'always'" :marks="weightslider.rangeData" :max="weightslider.max" v-model="weightslider.range">
                    </vue-slider>
                </div>
            </div>
            <hr />
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <h4>Origen</h4>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="fromestado_id">Estado:</label>
                            <select class="form-control" v-model="fromestado_id" v-on:input="changeFromEstado($event.target.value)">
                                <option value="">Cualquiera</option>
                                <option v-for="estado in estados" :value="estado.id">{{estado.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12" v-if="municipiosFrom.length">
                            <label for="frommunicipio_id">Municipio:</label>
                            <select class="form-control" v-model="frommunicipio_id" v-on:input="changeFromMunicipio($event.target.value)">
                                <option value="">Cualquiera</option>
                                <option v-for="municipio in municipiosFrom" :value="municipio.id">{{municipio.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12" v-if="localidadesFrom.length">
                            <label for="fromlocalidad_id">Localidad:</label>
                            <select class="form-control" v-model="fromlocalidad_id">
                                <option value="">Cualquiera</option>
                                <option v-for="localidad in localidadesFrom" :value="localidad.id">{{localidad.nombre}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <h4>Destino</h4>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="toestado_id">Estado:</label>
                            <select class="form-control" v-model="toestado_id" v-on:input="changeToEstado($event.target.value)">
                                <option value="">Cualquiera</option>
                                <option v-for="estado in estados" :value="estado.id">{{estado.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12" v-if="municipiosTo.length">
                            <label for="tomunicipio_id">Municipio:</label>
                            <select class="form-control" v-model="tomunicipio_id" v-on:input="changeToMunicipio($event.target.value)">
                                <option value="">Cualquiera</option>
                                <option v-for="municipio in municipiosTo" :value="municipio.id">{{municipio.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12" v-if="localidadesTo.length">
                            <label for="tolocalidad_id">Localidad:</label>
                            <select class="form-control" v-model="tolocalidad_id">
                                <option value="">Cualquiera</option>
                                <option v-for="localidad in localidadesTo" :value="localidad.id">{{localidad.nombre}}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <hr />
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Buscar</button>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-hover">
                    <tbody>
                        <FreightRow
                            v-for="(freight, index) in freights.data"
                            :freight="freight"
                            :index="index"
                            :key="freight.id">
                        </FreightRow>
                    </tbody>
                </table>
                <div class="alert alert-warning col-md-12" role="alert" v-if="!freights.total && searchdone">
                    <i class="fas fa-exclamation-triangle fa-lg"></i> No se encontraron registros, con los parametro de busqueda
                </div>
                <div class="alert alert-info col-md-12" role="alert" v-if="!searchdone">
                    <i class="fas fa-exclamation-triangle fa-lg"></i> Configure las opciones de busqueda y presione el boton buscar.
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <div class="row" v-if="freights.total && searchdone">
                <div class="col col-xs-4">Pagina {{ freights.current_page }} de {{ freights.last_page }}</div>
                <div class="col col-xs-8">
                    <pagination :data="freights" @pagination-change-page="search" class="justify-content-end">
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
    import VueSlider from 'vue-slider-component'
    import '../../../../node_modules/vue-slider-component/theme/antd.css'

    export default {
        components: {
            VueSlider,
            FreightRow
        },
        data() {
            return {
                searchdone: false,
                keywords: '',
                estados: [],
                municipiosFrom: [],
                municipiosTo: [],
                localidadesFrom: [],
                localidadesTo: [],
                toestado_id: '',
                fromestado_id: '',
                tomunicipio_id: '',
                frommunicipio_id: '',
                tolocalidad_id: '',
                fromlocalidad_id: '',
                weightslider: {
                    min: 0,
                    max: 100,
                    range: [20, 50],
                    rangeData: []
                },
                freights: {}
            }
        },
        mounted() {
            axios.get('/estados').then((response) => {
                this.estados = response.data;
            })

            axios.get('/rangeweight').then((response) => {
                this.weightslider = {
                    min: parseInt(response.data.min),
                    max: parseInt(response.data.max),
                    range: [parseInt(response.data.min), parseInt(response.data.max)],
                    rangeData: Array.from(new Set(this.getRange(parseInt(response.data.max), parseInt(response.data.min))))
                }
            })
        },
        methods: {
            doSearch: function () {
                this.search();
            },
            search (page = 1) {
                this.searchdone = false
                var params = {
                    fromestado_id : this.fromestado_id,
                    toestado_id : this.toestado_id,
                    frommunicipio_id : this.frommunicipio_id,
                    tomunicipio_id : this.tomunicipio_id,
                    fromlocalidad_id : this.fromlocalidad_id,
                    tolocalidad_id : this.tolocalidad_id,
                    keywords : this.keywords,
                    rangeweight: this.weightslider.range
                }

                axios.post('/search?page=' + page, params)
                .then((response) => {
                    this.freights = response.data
                    this.searchdone = true
                }).catch((e) => {
                    console.log(e)
                })
            },
            changeFromEstado : function (e) {
                this.frommunicipio_id = '';
                this.fromlocalidad_id = '';
                this.municipiosFrom = [];
                this.localidadesFrom = [];
                if (e != "") {
                    axios.get('/estados/' + e + '/municipios').then((response) =>{
                        this.municipiosFrom = response.data;
                    });
                }
            },
            changeToEstado : function (e) {
                this.tomunicipio_id = '';
                this.tolocalidad_id = '';
                this.municipiosTo = [];
                this.localidadesTo = [];
                if (e != "") {
                    axios.get('/estados/' + e + '/municipios').then((response) =>{
                        this.municipiosTo = response.data;
                    });
                }
            },
            changeFromMunicipio : function (e) {
                this.fromlocalidad_id = '';
                this.localidadesFrom = [];
                if (e != "") {
                    axios.get('/municipios/' + e + '/localidades').then((response) =>{
                        this.localidadesFrom = response.data;
                    });
                }
            },
            changeToMunicipio : function (e) {
                this.tolocalidad_id = '';
                this.localidadesTo = [];
                if (e != "") {
                    axios.get('/municipios/' + e + '/localidades').then((response) =>{
                        this.localidadesTo = response.data;
                    });
                }
            },
            getRange: function (upper, lower) {
                const difference = upper - lower
                    //var size = Math.floor(Math.log(Math.abs(upper)) / Math.LN10);
                    //var magnitude = Math.pow(10, size) / 2;
                    //var steps = Math.ceil(upper / magnitude);
                var steps = 5;
                const increment = difference / (steps - 1)
                return [lower, ...Array(steps - 2).fill('').map((_, index) =>
                    this.RoundedMax(lower + (increment * (index + 1)), upper)
                ), upper]
            },
            RoundedMax: function (mx, upper) {
                if (mx == 0) {return 0};
                var size = Math.floor(Math.log(Math.abs(mx)) / Math.LN10);
                var magnitude = Math.pow(10, size) / 2;
                var yMax = Math.ceil(mx / magnitude) * magnitude;
                if (yMax > upper) {return upper};
                return yMax;
            }
        }
    }
</script>
