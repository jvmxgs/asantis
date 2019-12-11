<template>
    <AdminDashboard v-if="$auth.check('admin')"></AdminDashboard>
</template>
<script>
import AdminDashboard from './admin/dashboard';

export default {
    components: {
        AdminDashboard
    }
}
</script>
