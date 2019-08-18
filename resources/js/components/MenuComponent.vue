<template>
<div class="wrapper">
    <!-- Sidebar -->
    <nav id="sidebar">

        <ul class="list-unstyled components">
            <li class="nav-item">
                <router-link class="nav-link" to="/home">Inicio</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" to="/company/myloads">Mis cargas</router-link>
            </li>
        </ul>
    </nav>

</div>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
