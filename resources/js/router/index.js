import Vue from 'vue'
import Router from 'vue-router'

// Containers
const TheContainer = () => import('../containers/TheContainer')

// Views
const PuntosAtencion = () => import('../components/PuntosAtencion')

Vue.use(Router)

export default new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})

function configRoutes () {
  return [
    {
      path: '/',
      redirect: '/puntos-atencion',
      name: 'Home',
      component: TheContainer,
      children: [
        {
          path: 'puntos-atencion',
          name: 'Puntos de atención',
          component: PuntosAtencion
        },
      ]
    },
  ]
}

