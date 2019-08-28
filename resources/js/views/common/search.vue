<template>
    <div>
        <form v-on:submit.prevent="search">
            <div class="form-row">
                <div class="form-group col-md-12">
                    <input class="form-control" placeholder="Palabras clave" type="text" v-model="keywords" />
                </div>
                <div class="form-group col-md-12">
                    <label for="range">Rango de peso:</label>
                    <vue-slider :enable-cross="false" :data="rangeData" :marks="true" v-model="range" />
                </div>
            </div>
            <div class="form-row mt-4">
                <div class="form-group col-md-6">
                    <h4>Origen</h4>
                </div>
                <div class="form-group col-md-6">
                    <h4>Destino</h4>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="fromestado_id">Estado:</label>
                    <select class="form-control" v-model="fromestado_id" v-on:input="changeFromEstado($event.target.value)">
                        <option v-for="estado in estados" :value="estado.id">{{estado.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="frommunicipio_id">Municipio:</label>
                    <select class="form-control" v-model="frommunicipio_id">
                        <option v-for="municipio in municipiosFrom" :value="municipio.id">{{municipio.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="toestado_id">Estado:</label>
                    <select class="form-control" v-model="toestado_id" v-on:input="changeToEstado($event.target.value)">
                        <option v-for="estado in estados" :value="estado.id">{{estado.nombre}}</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="tomunicipio_id">Municipio:</label>
                    <select class="form-control" v-model="tomunicipio_id">
                        <option v-for="municipio in municipiosTo" :value="municipio.id">{{municipio.nombre}}</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </div>
        </form>
        <div class="row">
            <search-result :loads="loads">
            </search-result>
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
                keywords: '',
                estados: [],
                municipiosFrom: [],
                municipiosTo: [],
                toestado_id: '',
                fromestado_id: '',
                tomunicipio_id: '',
                frommunicipio_id: '',
                range: ['400', '1200'],
                rangeData: ['200', '400', '600', '800', '1000', '1200', '1400'],
                loads: []
            }
        },
        mounted() {
            axios.get('/localidades').then((response) =>{
                this.estados = response.data;
            })
        },
        methods: {
            search : function () {
                var params = {
                    frommunicipio_id : this.frommunicipio_id,
                    tomunicipio_id : this.tomunicipio_id,
                    keywords : this.keywords
                }

                axios.post('/search', params)
                .then((response) => {
                    this.loads = response.data
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
            }
        }
    }
</script>
