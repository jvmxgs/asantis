<template>
    <div>
        <header-bar-component></header-bar-component>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header"><i class="fas fa-user"></i> {{ $t('Error') }}</div>
                                <div class="card-body">
                                    <h1>403 error</h1>
                                    <h3>Zona restringida</h3>
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

    export default {
        components: {
            HeaderBarComponent
        },
        beforeCreate() {
            console.log('Nothing gets called before me!')
        }
    }
</script>
