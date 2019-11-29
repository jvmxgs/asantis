<template>
    <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
        <div class="col-md-10">
            <div class="form-group row">
                <label for="name" class="text-md-right col-md-4 col-form-label">{{ $t('Name') }}</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" v-model="name" value="" required autocomplete="name" autofocus>
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ $t('Username') }}</label>
                <div class="col-md-8">
                    <input type="text" class="form-control" v-model="username" value="" required>
                    <div class="alert alert-danger mt-1" role="alert" v-if='has_error && errors.username'>
                        {{ errors.username[0] }}
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ $t('E-Mail Address') }}</label>
                <div class="col-md-8">
                    <input type="email" class="form-control" v-model="email" value="" required autocomplete="email">
                    <div class="alert alert-danger mt-1" role="alert" v-if='has_error && errors.email'>
                        {{ errors.email[0] }}
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ $t('Password') }}</label>
                <div class="col-md-4">
                    <input type="password" class="form-control" v-model="password" required autocomplete="new-password" :placeholder="$t('Password')">
                </div>
                <div class="col-md-4">
                    <input type="password" class="form-control" v-model="password_confirmation" required autocomplete="new-password" :placeholder="$t('Confirm Password')">
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
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> {{$t('Add') }}
                </button>
                <router-link class="btn btn-secondary btn-create" :to="{name: 'representatives'}"><i class="fas fa-ban"></i> {{ $t('Cancel') }} </router-link>
            </div>
        </div>
    </form>
</template>
<script>

export default {
    data() {
      return {
        role: 'representative',
        name: '',
        username: '',
        email: '',
        password: '',
        password_confirmation: '',
        has_error: false,
        error: '',
        errors: {},
        success: false
      }
    },
    methods: {
      register() {
        var app = this
        this.$auth.register({
          data: {
            name: app.name,
            username: app.username,
            email: app.email,
            password: app.password,
            password_confirmation: app.password_confirmation,
            role: app.role,

            has_error: false,
            errors: []
          },
          success: function (response) {
            app.success = true
            this.$swal.fire({
                title: 'Grandioso',
                text: 'Se ha guardado agregado el correctamente un nuevo representante',
                type: 'success',
                confirmButtonText: 'Genial'
            })
            this.$router.push({name: 'representatives'})
          },
          error: function (res) {
            app.has_error = true
            app.errors = res.response.data.errors || {}
          }
        })
      }
    }
}

</script>
