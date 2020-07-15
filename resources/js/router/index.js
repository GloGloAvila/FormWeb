import Vue from 'vue'
import Router from 'vue-router'

// Containers
const TheContainer = () => import('../containers/TheContainer')
const TheSimpleContainer = () => import('../containers/TheSimpleContainer')

// Views
const PuntosAtencion = () => import('../components/PuntosAtencion')
const Prestadores = () => import('../components/Prestadores')
const Vigencias = () => import('../components/Vigencias')

Vue.use(Router)

export default new Router({
  mode: 'hash', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})

function configRoutes() {
  return [
    {
      path: '/',
      redirect: '/vigencias',
      name: 'home',
      component: TheContainer,
      children: [
        {
          path: 'vigencias',
          name: 'gestion-vigencias',
          meta: {
            label: 'Vigencias'
          },
          redirect: '/vigencias/listado',
          component: TheSimpleContainer,
          children: [
            {
              path: 'listado',
              name: 'gestion-vigencias-listado-vigencias',
              meta: {
                label: 'Listado'
              },
              component: Vigencias
            },
            {
              path: 'prestadores',
              name: 'gestion-vigencias-prestadores',
              meta: {
                label: 'Prestadores'
              },
              redirect: '/vigencias/prestadores/listado',
              component: TheSimpleContainer,
              children: [
                {
                  path: 'listado',
                  name: 'gestion-vigencias-listado-prestadores',
                  meta: {
                    label: 'Listado'
                  },
                  component: Prestadores
                },
                {
                  path: 'puntos-atencion',
                  name: 'gestion-vigencias-prestadores-listado-puntos-atencion',
                  meta: {
                    label: 'Puntos de atención'
                  },
                  component: PuntosAtencion
                },
              ]
            },
          ]
        },
      ]
    },
  ]
}

