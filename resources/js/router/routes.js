export default [
    {
      path: '/acceso',
      name: 'login',
      component: require('../layout/auth/login.vue').default
    },
    {
      path: '/registro',
      name: 'register',
      component: require('../layout/auth/register.vue').default
    },
    {
      path: '/',
      component: require('../layout/main.vue').default,
      children: [
        {
          path: '/inicio',
          name: 'home',
          component: require('../views/home.vue').default
        },
        {
          path: '/usuarios',
          name: 'users',
          component: require('../views/users.vue').default
        },
        {
          path: '/estados/venta',
          name: 'sellStates',
          component: require('../views/sellStates.vue').default
        },
        {
          path: '/tipos/maquina',
          name: 'machines',
          component: require('../views/machines.vue').default
        },
        {
          path: '/proveedores',
          name: 'providers',
          component: require('../views/providers.vue').default
        },
        {
          path: '/ventas',
          name: 'sale',
          component: require('../views/sales.vue').default
        },
        {
          path: '/ventas/registro',
          name: 'sales-register',
          component: require('../views/saleRegister.vue').default
        },
        {
          path: '/ventas/:sale_id/detalles',
          name: 'sale-detail',
          component: require('../views/saleDetail.vue').default,
        },
        {
          path: '/ventas/:sale_id/editar',
          name: 'sale-edit',
          component: require('../views/saleEdit.vue').default,
        },
      ]
    },
    {
      path: '/construccion',
      name: 'construction',
      component: require('../views/others/construction.vue').default
    }
]
