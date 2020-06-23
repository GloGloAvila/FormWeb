<template>
  <CFooter :fixed="false">
    <div>
      <span class="mr-1">Sistema de Información Comunidad Virtual</span>
      <span class="ml-1">&copy; {{new Date().getFullYear()}}</span>
    </div>
    <div class="ml-auto">
      <span class="mr-1">Resolución 293 de 2017</span>
    </div>
  </CFooter>
</template>

<script>
export default {
  name: 'TheFooter'
}
</script>
