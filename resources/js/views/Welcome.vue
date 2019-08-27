<template>
    <div class="flex-center position-ref full-height">

                    <div class="top-right links">

                            <a href="/dashboard" v-if="$auth.check()">Inicio</a>

                            <a href="/login" v-if="!$auth.check()">Acceder</a>

                            <a href="/register" v-if="!$auth.check()">Registro</a>
                    </div>



        <div class="content">
            <div class="title m-b-md">
                <img src="/images/logo.png" />
            </div>

            <div class="links">
                <a href="https://laravel.com/docs">COMPAÑIAS</a>
                <a href="https://laracasts.com">TRANSPORTISTAS</a>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted () {
            console.log("welcome mounted");
        }
    }
</script>
<style scoped>
    html, body {
        background-color: #fff;
        color: #636b6f;
        font-family: 'Nunito', sans-serif;
        font-weight: 200;
        height: 100vh;
        margin: 0;
    }
    .full-height {
        height: 100vh;
    }
    .flex-center {
        align-items: center;
        display: flex;
        justify-content: center;
    }
    .position-ref {
        position: relative;
    }
    .top-right {
        position: absolute;
        right: 10px;
        top: 18px;
    }
    .content {
        text-align: center;
    }
    .title {
        font-size: 84px;
    }
    .links > a {
        color: #636b6f;
        padding: 0 25px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: .1rem;
        text-decoration: none;
        text-transform: uppercase;
    }
    .m-b-md {
        margin-bottom: 30px;
    }
</style>
