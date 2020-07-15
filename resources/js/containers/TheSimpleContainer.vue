<template>
  <CContainer fluid>
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </CContainer>
</template>

<script>

export default {
  name: 'TheSimpleContainer'
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
