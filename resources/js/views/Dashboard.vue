<template>
    <div>
        <header-bar-component></header-bar-component>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <menu-layout-component></menu-layout-component>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header"><i class="fas fa-tachometer-alt"></i> Panel de control</div>

                            <div class="card-body">
                                    <router-view name="content"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
<script>
    import HeaderBarComponent from '../layout/header-bar';
    import MenuLayoutComponent from '../layout/menu-layout';

    export default {
        components: {
            HeaderBarComponent,
            MenuLayoutComponent
        }
    }
</script>
