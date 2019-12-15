<template>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Opciones
            </div>
            <div class="card-body">
                <ul class="nav flex-column nav-pills navbar-light bg-white">
                    <li class="nav-item">
                        <router-link :to="{name: 'dashboard'}" class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</router-link>
                    </li>
                    <li class="nav-item active">
                        <router-link :to="{name: 'search'}" class="nav-link"><i class="fas fa-search"></i> Buscar</router-link>
                    </li>
                    <li class="nav-item active" v-for="menuItem in menuItems[menuOwner]">
                        <router-link :to="menuItem.link" class="nav-link"><i :class="'fas fa-' + menuItem.icon"></i> {{menuItem.title}}</router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                menuOwner: this.getOwner(),
                menuItems : {
                    admin: [
                        {title: 'Representantes', icon: 'user-tie', link: {name :'representatives'}}
                    ],
                    representative: [
                        {title: 'Propuestas', icon: 'comment-dots', link: {name :'proposals'}}
                    ],
                    company: [
                        {title: 'Mis viajes', icon: 'truck-loading', link: {name :'myfreights'}}
                    ],
                    carrier: [
                        {title: 'Mis propuestas', icon: 'comment-dots', link: {name :'myproposals'}}
                    ]
                }
            }
        },
        mounted () {

        },
        methods: {
            getOwner () {
                if (this.$auth.check('admin')) {
                    return 'admin'
                } else if (this.$auth.check('representative')) {
                    return 'representative'
                } else if (this.$auth.check('company')) {
                    return 'company';
                } else if (this.$auth.check('carrier')) {
                    return 'carrier'
                }
            }
        }
    }
</script>
