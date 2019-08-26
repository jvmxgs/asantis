<template>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                Opciones
            </div>
            <div class="card-body">
                <ul class="nav flex-column nav-pills navbar-light bg-white">
                    <li class="nav-item active" v-for="menuItem in menuItems[menuOwner]">
                        <router-link :to="menuItem.link" class="nav-link">{{menuItem.title}}</router-link>
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
                        {title: 'Panel de control', icon: '', link: {name :'dashboard'}}
                    ],
                    company: [
                        {title: 'Mis cargas', icon: '', link: {name :'myloads'}}
                    ],
                    carrier: [
                        //carrier menu
                    ]
                }
            }
        },
        mounted () {
            console.log(this.menuOwner);
        },
        methods: {
            getOwner () {
                if (this.$auth.check('admin')) {
                    return 'admin'
                } else if (this.$auth.check('company')) {
                    return 'company';
                } else if (this.$auth.check('carrier')) {
                    return 'carrier'
                }
            }
        }
    }
</script>
