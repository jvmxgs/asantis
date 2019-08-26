<template>
    <div>
        <header-bar-component></header-bar-component>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"><i class="fas fa-user-plus"></i> {{ $t('asantis.Join to') }} Asantis</div>

                            <div class="card-body">
                                <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">

                                <div class="alert alert-danger" v-if="has_error && !success">
                                    <p">Erreur(s) de validation, veuillez consulter le(s) message(s) ci-dessous.</p>
                                </div>

                                    <div class="form-group row justify-content-center">
                                        <div class="col-sm-12 col-md-8">
                                            <h3>{{ $t('I am a') }}</h3>
                                            <input type="hidden" value="" v-model="role" />
                                        </div>

                                        <div class="col-sm-12 col-md-8 d-flex justify-content-center">

                                            <div class="btn-group" role="group" data-toggle="button">
                                                <button type="button" class="btn btn-gray btn-gray-company">
                                                    <i class="fas fa-user fa-7x"></i>
                                                    <span class="">{{ $t('asantis.Company') }}</span>
                                                </button>
                                                <button type="button" class="btn btn-gray btn-gray-carrier">
                                                  <i class="fas fa-truck fa-7x"></i>
                                                  <span>{{ $t('asantis.Carrier') }}</span>
                                                </button>
                                            </div>

                                        </div>
                                    </div>

                                    <div id="hiddenForm" class="hide">
                                        <div class="form-group row">
                                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ $t('Name') }}</label>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control" v-model="name" value="" required autocomplete="name" autofocus>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ $t('Username') }}</label>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control" v-model="username" value="" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ $t('E-Mail Address') }}</label>

                                            <div class="col-md-6">
                                                <input type="email" class="form-control" v-model="email" value="" required autocomplete="email">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ $t('Password') }}</label>

                                            <div class="col-md-6">
                                                <input type="password" class="form-control" v-model="password" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="password_confirm" class="col-md-4 col-form-label text-md-right">{{ $t('Confirm Password') }}</label>

                                            <div class="col-md-6">
                                                <input type="password" class="form-control" v-model="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{$t('Register me') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
    import HeaderBarComponent from '../../layout/header-bar';

    export default {
        components: {
            HeaderBarComponent
        },
    data() {
      return {
        role: '',
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
            role: app.role
          },
          success: function () {
            app.success = true
            this.$router.push({name: 'login', params: {successRegistrationRedirect: true}})
          },
          error: function (res) {
            console.log(res.response.data.errors)
            app.has_error = true
            app.error = res.response.data.error
            app.errors = res.response.data.errors || {}
          }
        })
      }
    },
    mounted() {
        $(document).ready(function() {
            $("#hiddenForm").hide();
        });

        $(".btn-gray").click(function() {
            $("#hiddenForm").slideDown();
        });

        $(".btn-gray-company").click(() => {
            this.role = "company";
            $(".btn-gray-company").fadeTo( "slow", 1 );
            $(".btn-gray-carrier").fadeTo( "slow", 0.33 );
        });

        $(".btn-gray-carrier").click(() => {
            this.role = "carrier";
            $(".btn-gray-carrier").fadeTo( "slow", 1 );
            $(".btn-gray-company").fadeTo( "slow", 0.33 );
        });
    }
  }
</script>
