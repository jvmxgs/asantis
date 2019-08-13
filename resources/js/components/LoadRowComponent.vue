<template>
    <tr>
      <td class="hidden-xs">{{ load.id }}</td>
      <td>{{ load.loadnumber }}</td>
      <td>{{ load.pickupfrom }}</td>
      <td>{{ load.deliverto }}</td>
      <td>{{ load.weight }}</td>
      <td align="center">
        <a class="btn btn-success"><em class="fa fa-pencil-alt"></em></a>
        <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
      </td>
    </tr>
</template>

<script>
    export default {
        props: ['load']
    }
</script>
