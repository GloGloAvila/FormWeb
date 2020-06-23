<template>
  <CDropdown
    inNav
    class="c-header-nav-items"
    placement="bottom-end"
    add-menu-classes="pt-0"
  >
    <template #toggler>
      <CHeaderNavLink>        
        {{user.name}}   
        <CIcon name="cil-user" /> 
      </CHeaderNavLink>
    </template>
    <CDropdownHeader tag="div" class="text-center" color="light">
      <strong>Cuenta de usuario</strong>
    </CDropdownHeader>
    <CDropdownItem v-on:click="cerrarSesion()">
      <CIcon name="cil-lock-locked" /> 
        Cerrar sesión
    </CDropdownItem>
  </CDropdown>
</template>

<script>
export default {
  name: 'TheHeaderDropdownAccnt',
  data () {
    return { 
      user: {}
    }
  },
  mounted () {
    console.log(window)
    this.user = window.user.user
  },
  methods: {
    cerrarSesion () {
      event.preventDefault(); 
      document.getElementById('logout-form').submit();
    }
  }
}
</script>

<style scoped>
  .c-icon {
    margin-right: 0.3rem;
  }
</style>