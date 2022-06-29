import Vue from 'vue/dist/vue.min.js'
import Router from 'vue-router';

window.Vue = require('vue');
Vue.use(Router)

import dashboard from './views/Dashboard'
import clientes from './views/Clientes'
import laboratorios from './views/Laboratorios'
import ventas from './views/Ventas'
import usuarios from './views/Usuarios'
import reportes from './views/Reportes'
import comisiones from './views/Comisiones'
import configuracion from './views/Configuracion'
import categoria_productos from './views/Categoria_productos'

export default  new Router({
    routes:[

        {
            path: '/',
            name: 'dashboard',
            component: dashboard,

        },

        {
            path: '/cliente',
            name: 'clientes',
            component: clientes,

        },

        {
            path: '/laboratorio',
            name: 'laboratorios',
            component: laboratorios,

        },

        {
            path: '/venta',
            name: 'ventas',
            component: ventas,

        },

        {
            path: '/usuario',
            name: 'usuarios',
            component: usuarios,

        },

        {
            path: '/reporte',
            name: 'reportes',
            component: reportes,

        },

        {
            path: '/comision',
            name: 'comisiones',
            component: comisiones,

        },

        {
            path: '/configuracion',
            name: 'configuracion',
            component: configuracion,

        },
        {
            path: '/categoria_productos',
            name: 'categoria_productos',
            component: categoria_productos
        }




    ],
    mode: 'history'

})
