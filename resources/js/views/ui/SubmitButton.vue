<template>
    <button type="submit" class="btn btn-primary">
        <div v-if="saving">
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="sr-only">Guardando...</span>
            </div>
            {{ $t('Saving') }}...
        </div>
        <span v-else><i :class="'fas fa-' + icon"></i> {{ buttonText }}</span>
    </button>
</template>
<script>
    export default {
        props: ['icon', 'buttonText', 'saving']
    }
</script>
