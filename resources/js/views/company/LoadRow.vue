<template>
    <fragment>
        <tr>
          <td rowspan="2" class="hidden-xs">{{ load.id }}</td>
          <td rowspan="2">{{ load.loadnumber }}</td>
          <td>{{ load.frommunicipio.estado.nombre }}</td>
          <td>{{ load.tomunicipio.estado.nombre }}</td>
          <td rowspan="2">{{ load.weight }}</td>
          <td rowspan="2" align="center">
            <a class="btn btn-success"><em class="fa fa-pencil-alt"></em></a>
            <a class="btn btn-danger"><em class="fa fa-trash"></em></a>
          </td>
        </tr>
        <tr>
            <td>{{ load.frommunicipio.nombre }}</td>
            <td>{{ load.tomunicipio.nombre }}</td>
        </tr>
    </fragment>
</template>

<script>
    export default {
        props: ['load']
    }
</script>
