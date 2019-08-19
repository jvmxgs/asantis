<template>
    <div id="app">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    @if(Auth::user()->hasRole('admin'))
                                        <a class="dropdown-item" href="/"> <i class="fas fa-sign-out-alt"></i> Admin</a>
                                    @elseif(Auth::user()->hasRole('company'))
                                        <a class="dropdown-item" href="/">Company</a>
                                    @elseif(Auth::user()->hasRole('carrier'))
                                        <a class="dropdown-item" href="/">Carrier</a>
                                    @endif

                                    <a class="dropdown-item" href=""
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <router-view></router-view>
        </main>
    </div>
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
