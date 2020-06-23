<template>
  <div>
    <div v-if="can('edit post')">

    </div>
    <div v-else>
      No tiene permisos
    </div>
    Hola
  </div>
</template>

<script>

export default {
  name: 'PuntosAtencion',
  components: {
  },
  mounted() {
  },
  data () {
    return {
    }
  },
  methods: {
  }
}
</script>
