<template>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="/">
                Asantis
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" :aria-label="$t('Toggle navigation')">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item" v-if="!$auth.check()">
                                <a class="nav-link" :href="routes.unlogged.login">
                                    {{ $t('Login') }}
                                </a>
                            </li>
                            <li class="nav-item" v-if="!$auth.check()">
                                <a class="nav-link" :href="routes.unlogged.register">
                                    {{ $t('Register') }}
                                </a>
                            </li>

                            <li class="nav-item dropdown" v-if="$auth.check()">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user"></i>
                                        {{ $auth.user().name }}
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" v-if="$auth.check('admin')" href="/"> <i class="fas fa-sign-out-alt"></i> Admin</a>
                                    <a class="dropdown-item" v-if="$auth.check('carrier')" href="/"> <i class="fas fa-sign-out-alt"></i> Carrier</a>
                                    <a class="dropdown-item" v-if="$auth.check('company')" href="/"> <i class="fas fa-sign-out-alt"></i> Company</a>

                                    <a class="dropdown-item" href=""
                                       @click.prevent="$auth.logout()">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ $t('Logout') }}
                                    </a>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
</template>
<script>
    export default {
        data() {
          return {
            routes: {
              // UNLOGGED
              unlogged: {
                login: 'login',
                register: 'register',
              },
              // LOGGED USER
              user: {

              },
              // LOGGED ADMIN
              admin: {
                adminDashboard: 'admin.dashboard'
              }
            }
          }
        },
        mounted() {

        },
        methods: {

        },
    }
</script>
