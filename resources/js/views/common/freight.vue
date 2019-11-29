<template>
    <div v-if="freight.freightnumber">
        <div class="row">
            <div class="col-md-12">
                <h4>{{ freight.freightnumber }}</h4>
                <hr />
            </div>
            <div class="col-md-12">
                <h5>{{ freight.description }}</h5>
            </div>
            <div class="col-md-12 mt-3">
                <div class="clearfix">
                    <div class="float-left">
                        <strong>{{ freight.fromlocalidad.municipio.estado.nombre }}</strong>
                        <span class="d-block">{{ freight.fromlocalidad.municipio.nombre }}</span>
                        <span class="d-block">{{ freight.fromlocalidad.nombre }}</span>
                        <small class="text-muted">{{ freight.departuretime }}</small>
                    </div>
                    <div class="float-right text-right">
                        <strong>{{ freight.tolocalidad.municipio.estado.nombre }}</strong>
                        <span class="d-block">{{ freight.tolocalidad.municipio.nombre }}</span>
                        <span class="d-block">{{ freight.tolocalidad.nombre }}</span>
                        <small class="text-muted">{{ freight.arrivaltime }}</small>
                    </div>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="float-left">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="float-right">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
            </div>
            <div class="col-md-12 mt-2 text-right">
                <small><i class="fas fa-calendar-alt"></i> Publicado:{{ freight.created_at }}</small>
            </div>
        </div>
        <div class="row mt-5" v-if="$auth.check('carrier') || $auth.check('admin')">
            <div class="form-group col-md-12">
                <hr />
                <div v-if="$auth.check('carrier')">
                    <form v-on:submit.prevent="makeProposal" v-if="showProposalForm">
                        <div class="form-group col-12 col-md-6 col-lg-4 p-0">
                            <label for="amount">Monto propuesto</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                              </div>
                              <input type="number" class="form-control" v-model="amount" aria-label="Amount (to the nearest dollar)">
                              <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="proposalText">Deja tu propuesta</label>
                            <textarea class="form-control" v-model="proposalText"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Ofertar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12" v-if="this.showProposalMessage">
                    {{ proposal.proposalText }}
                    {{ proposal.created_at }}
                </div>
                <div v-if="$auth.check('admin')">
                    <div class="alert alert-info col-md-12" role="alert" v-if="!showProposalMessage">
                        <i class="fas fa-exclamation-triangle fa-lg"></i> Nadie ha propuesto nada aun
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                showProposalForm: false,
                showProposalMessage: false,
                freight: [],
                proposal: [],
                amount: "",
                proposalText: ""
            }
        },
        mounted() {
            axios.get('/freights/' + this.$route.params.freightnumber).then((response) =>{
                this.freight = response.data;
                axios.get('/proposals/' + this.freight.id).then((response) =>{
                    this.proposal = response.data;
                    if (!this.proposal.proposalText)
                        this.showProposalForm = true;
                    else
                        this.showProposalMessage = true;
                });
            });
        },
        methods: {
            makeProposal: function () {
                const params = {
                    freight_id: this.freight.id,
                    amount: this.amount,
                    proposalText: this.proposalText
                };

                axios.post('/proposals/', params).then((response) => {
                    this.$swal.fire({
                        title: 'Grandioso',
                        text: 'Has realizado una propuesta a este viaje',
                        type: 'success',
                        confirmButtonText: 'Genial'
                    })
                    this.$router.push({name: 'myproposals'})
                });
            }
        }
    }
</script>
<style scoped>
    .progress-xs {
        height: 4px;
    }
</style>
