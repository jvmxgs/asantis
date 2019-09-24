<template>
    <div>
        <form v-on:submit.prevent="search">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control" placeholder="Palabras clave" type="text" v-model="keywords" />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
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
                        <div class="form-group col-md-6">
                            <label for="fromestado_id">Estado:</label>
                            <select class="form-control" v-model="fromestado_id" v-on:input="changeFromEstado($event.target.value)">
                                <option value="">Cualquiera</option>
                                <option v-for="estado in estados" :value="estado.id">{{estado.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="frommunicipio_id">Municipio:</label>
                            <select class="form-control" v-model="frommunicipio_id">
                                <option value="">Cualquiera</option>
                                <option v-for="municipio in municipiosFrom" :value="municipio.id">{{municipio.nombre}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group col-md-12">
                        <h4>Destino</h4>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="toestado_id">Estado:</label>
                            <select class="form-control" v-model="toestado_id" v-on:input="changeToEstado($event.target.value)">
                                <option value="">Cualquiera</option>
                                <option v-for="estado in estados" :value="estado.id">{{estado.nombre}}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tomunicipio_id">Municipio:</label>
                            <select class="form-control" v-model="tomunicipio_id">
                                <option value="">Cualquiera</option>
                                <option v-for="municipio in municipiosTo" :value="municipio.id">{{municipio.nombre}}</option>
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
                <search-result :loads="loads">
                </search-result>
                <div class="alert alert-warning col-md-12" role="alert" v-if="!loads.length && searchdone">
                    <i class="fas fa-exclamation-triangle fa-lg"></i> No se encontraron registros, con los parametro de busqueda
                </div>
                <div class="alert alert-info col-md-12" role="alert" v-if="!searchdone">
                    <i class="fas fa-exclamation-triangle fa-lg"></i> Configure las opciones de busqueda y presione el boton buscar.
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import SearchResult from './SearchResult';
    import VueSlider from 'vue-slider-component'
    import '../../../../node_modules/vue-slider-component/theme/antd.css'

    export default {
        components: {
            VueSlider,
            SearchResult
        },
        data() {
            return {
                searchdone: false,
                keywords: '',
                estados: [],
                municipiosFrom: [],
                municipiosTo: [],
                toestado_id: '',
                fromestado_id: '',
                tomunicipio_id: '',
                frommunicipio_id: '',
                weightslider: {
                    min: 0,
                    max: 100,
                    range: [20, 50],
                    rangeData: []
                },
                loads: []
            }
        },
        mounted() {
            axios.get('/localidades').then((response) => {
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
            search : function () {
                var params = {
                    fromestado_id : this.fromestado_id,
                    toestado_id : this.toestado_id,
                    frommunicipio_id : this.frommunicipio_id,
                    tomunicipio_id : this.tomunicipio_id,
                    keywords : this.keywords,
                    rangeweight: this.weightslider.range
                }

                axios.post('/search', params)
                .then((response) => {
                    this.loads = response.data
                    this.searchdone = true
                }).catch((e) => {
                    console.log(e)
                })
            },
            changeFromEstado : function (e) {
                this.frommunicipio_id = '';
                axios.get('/localidades/' + e).then((response) =>{
                    this.municipiosFrom = response.data;
                });
            },
            changeToEstado : function (e) {
                this.tomunicipio_id = '';
                axios.get('/localidades/' + e).then((response) =>{
                    this.municipiosTo = response.data;
                });
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
