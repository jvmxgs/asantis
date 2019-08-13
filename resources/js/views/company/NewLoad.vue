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
            <div class="col-md-12">
                <label>Ubica en el mapa el origen y destino de la carga</label>
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <div id="map" style="width:100%; height:50vh;">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pickupfrom">Origen:</label>
                        <input type="text" class="form-control" id="pickupfrom" v-model="pickupfrom" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="pickupfrom">Destino:</label>
                        <input type="text" class="form-control" id="deliverto" v-model="deliverto" />
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card p-3 mt-5">
                        <div class="card shadow text-info p-3 my-card" style="position:absolute;left:40%;top:-20px;border-radius:50%;"><span class="fa fa-route" aria-hidden="true"></span></div>
                        <div class="text-info text-center mt-3"><h5>Distancia</h5></div>
                        <div class="text-info text-center mt-2"><h3>{{ distance }}</h3></div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
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
                pickupfrom_latitude: '',
                pickupfrom_longitude: '',
                deliverto: '',
                deliverto_latitude: '',
                deliverto_longitude: '',
                distance: '0'
            }
        },
        methods: {
            newLoad () {
                const params = {
                    loadnumber: this.loadnumber,
                    description: this.description,
                    pickupfrom: this.pickupfrom,
                    pickupfrom_latitude: this.pickupfrom_latitude,
                    pickupfrom_longitude: this.pickupfrom_longitude,
                    deliverto: this.deliverto,
                    deliverto_latitude: this.deliverto_latitude,
                    deliverto_longitude: this.deliverto_longitude,
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
            var geocodeService = L.esri.Geocoding.geocodeService();
            var map = L.map('map').setView([32.505, -116.09], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var control = L.Routing.control({
                waypoints: [
                ],
                routeWhileDragging: true
            }).addTo(map);

            map.on('click', (e) => {
                var container = L.DomUtil.create('div'),
                    startBtn = createButton('Establecer origen', container),
                    destBtn = createButton('Establecer destino', container);

                    L.DomEvent.on(startBtn, 'click', () => {
                        control.spliceWaypoints(0, 1, e.latlng);
                        map.closePopup();
                        geocodeService.reverse().latlng(e.latlng).run((error, result) => {
                            this.pickupfrom = result.address.Match_addr;
                        });
                        this.pickupfrom_latitude = e.latlng.lat;
                        this.pickupfrom_longitude = e.latlng.lng;
                    });
                    L.DomEvent.on(destBtn, 'click', () => {
                        control.spliceWaypoints(control.getWaypoints().length - 1, 1, e.latlng);
                        map.closePopup();
                        geocodeService.reverse().latlng(e.latlng).run((error, result) => {
                            this.deliverto = result.address.Match_addr;
                            console.log(this.deliverto);
                        });
                        this.deliverto_latitude = e.latlng.lat;
                        this.deliverto_longitude = e.latlng.lng;
                    });

                L.popup()
                    .setContent(container)
                    .setLatLng(e.latlng)
                    .openOn(map);
            });

            control.hide();
            control.on('routesfound', (e) => {
               var routes = e.routes;
               var summary = routes[0].summary;
               console.log('Total distance is ' + summary.totalDistance / 1000 + ' km and total time is ' + Math.round(summary.totalTime % 3600 / 60) + ' minutes');
               this.distance = (Math.round(summary.totalDistance / 10, 2) / 100) + " km";
            });

            function createButton(label, container) {
                var btn = L.DomUtil.create('button', '', container);
                btn.setAttribute('type', 'button');
                btn.setAttribute('class', 'btn btn-primary');
                btn.innerHTML = label;
                return btn;
            }
        }
    }
</script>
