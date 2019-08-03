<template>
    <div class="form-group row justify-content-center">
        <div class="col-sm-12 col-md-8">
            <h3>{{ __('I am a') }}</h3>kjj
        </div>

        <div class="col-sm-12 col-md-8 d-flex justify-content-center">

            <div class="btn-group" role="group" data-toggle="button">
                <button type="button" class="btn btn-gray">
                    <i class="fas fa-user fa-7x"></i>
                    <span class="">{{ trans('asantis.Company') }}</span>
                </button>
                <button type="button" class="btn btn-gray">
                  <i class="fas fa-truck fa-7x"></i>
                  <span>{{ trans('asantis.Carrier') }}</span>
                </button>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
