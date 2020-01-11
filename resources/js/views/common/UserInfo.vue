<template>
    <div>
        <form autocomplete="off" @submit.prevent="sendForm" method="post" class="row justify-content-center">
            <div class="col-md-10">
                <h4>Mi cuenta</h4>
                <hr />
                <div class="form-group row">
                    <label for="name" class="text-md-right col-md-4 col-form-label">{{ $t('Name') }}</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" v-model="representative.name" value="" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ $t('Username') }}</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" v-model="representative.username" value="" required>
                        <div class="alert alert-danger mt-1" role="alert" v-if='has_error && errors.username'>
                            {{ errors.username[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ $t('E-Mail Address') }}</label>
                    <div class="col-md-8">
                        <input type="text" class="form-control" v-model="representative.email" value="" required autocomplete="email">
                        <div class="alert alert-danger mt-1" role="alert" v-if='has_error && errors.email'>
                            {{ errors.email[0] }}
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ $t('Password') }}</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" v-model="representative.password" required autocomplete="new-password" :placeholder="$t('Password')">
                    </div>
                    <div class="col-md-4">
                        <input type="password" class="form-control" v-model="representative.password_confirmation" required autocomplete="new-password" :placeholder="$t('Confirm Password')">
                    </div>
                </div>

                <div class="row justify-content-end" v-if='has_error && errors.password'>
                    <div class="col-md-8">
                        <div class="alert alert-danger mt-1" role="alert">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <SubmitButton
                        icon="user"
                        :buttonText="buttonText"
                        :saving="updateRepresentativeSaving"></SubmitButton>
                    <router-link class="btn btn-secondary btn-create" :to="{name: 'representatives'}"><i class="fas fa-ban"></i> {{ $t('Cancel') }} </router-link>
                </div>
            </div>
        </form>
        <form @submit.prevent="updatePassword" class="row justify-content-center mt-3">
            <div class="col-md-10">
                <h4>Cambiar contraseña</h4>
                <hr />
                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ $t('Password') }}</label>
                    <div class="col-md-4">
                        <input type="password" class="form-control" v-model="representative.password" required autocomplete="new-password" :placeholder="$t('Password')">
                    </div>
                    <div class="col-md-4">
                        <input type="password" class="form-control" v-model="representative.password_confirmation" required autocomplete="new-password" :placeholder="$t('Confirm Password')">
                    </div>
                </div>

                <div class="row justify-content-end" v-if='has_error && errorsPassword.password'>
                    <div class="col-md-8">
                        <div class="alert alert-danger mt-1" role="alert">
                            {{ errorsPassword.password[0] }}
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <SubmitButton
                        icon="user"
                        :buttonText="$t('Change password')"
                        :saving="updatePasswordSaving"></SubmitButton>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import SubmitButton from '../ui/SubmitButton'

export default {
    components: {
        SubmitButton
    },
    data() {
         return {
            updatePasswordSaving: false,
            updateRepresentativeSaving: false,
            representative: {
                role: 'representative',
                name: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: ''
            },
            has_error: false,
            buttonText: '',
            error: '',
            errors: {},
            errorsPassword: {}
        }
    },
    mounted () {
        this.buttonText = this.$t('Save')
        if (this.$route.params.representative_id) {
            this.buttonText = this.$t('Update')
            this.getRepresentative(this.$route.params.representative_id);
        }
    },
    methods: {
      sendForm() {
          this.updateRepresentativeSaving = true
          const params = this.representative
          this.errors = {}
          axios.put('/representatives/' + this.$route.params.representative_id, params)
          .then((response) => {
              this.updateRepresentativeSaving = false
              //reset all inputs
              this.$swal.fire({
                  title: 'Grandioso',
                  text: 'Se ha actualizado correctamente el representante',
                  type: 'success',
                  confirmButtonText: 'Genial'
              })
          })
          .catch((error) => {
              this.updateRepresentativeSaving = false
              this.has_error = true
              this.errors = error.response.data.errors
          });
      },
      updatePassword() {
          this.updatePasswordSaving = true
          this.errorsPassword = {}
          const params = this.representative
          axios.put('/representatives/' + this.$route.params.representative_id + '/updatepassword', params)
          .then((response) => {
              //reset all inputs
              this.updatePasswordSaving = false
              this.$swal.fire({
                  title: 'Grandioso',
                  text: 'Se ha actualizado correctamente la contraseña del representante',
                  type: 'success',
                  confirmButtonText: 'Genial'
              })
          })
          .catch((error) => {
              this.updatePasswordSaving = false
              this.has_error = true
              this.errorsPassword = error.response.data.errors
          });
      },
      getRepresentative(id) {
          axios.get('/representatives/' + id).then((response) =>{
              this.representative = response.data;
          });
      }
    }
}

</script>
