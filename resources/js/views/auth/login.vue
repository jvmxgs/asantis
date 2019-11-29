<template>
    <div>
        <header-bar-component></header-bar-component>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"><i class="fas fa-user"></i> {{ $t('Login') }}</div>

                            <div class="card-body">
                            <div class="alert alert-danger" v-if="has_error">
                                <p>{{ $t('auth.failed') }}</p>
                            </div>
                                <form autocomplete="off" @submit.prevent="login" method="post">
                                    <div class="form-group row">
                                        <label for="username" class="col-md-4 col-form-label text-md-right">{{ $t('E-Mail Address or Username') }}</label>

                                        <div class="col-md-6">
                                            <input id="username" v-model="username" type="username" class="form-control" name="username" value="" required autocomplete="email" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ $t('Password') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" v-model="password" class="form-control" name="password" required autocomplete="current-password">
                                        </div>
                                    </div>


                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ $t('Login') }}
                                            </button>
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
        username: null,
        password: null,
        has_error: false
      }
    },
    mounted() {

    },
    methods: {
      login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          params: {
            email: app.username,
            password: app.password
          },
          success: function() {
            const redirectTo = '/dashboard'
            this.$router.push(redirectTo)
          },
          error: function() {
            app.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>
