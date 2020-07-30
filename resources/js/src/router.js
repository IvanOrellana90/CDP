/*=========================================================================================
  File Name: router.js
  Description: Routes for vue-router. Lazy loading is enabled.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/


import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: '/',
  scrollBehavior () {
    return { x: 0, y: 0 }
  },
  routes: [

    {
    // =============================================================================
    // MAIN LAYOUT ROUTES
    // =============================================================================
      path: '',
      component: () => import('./layouts/main/Main.vue'),
      children: [
      // =============================================================================
      // Theme Routes
      // =============================================================================
        {
          path: '/',
          name: 'home',
          component: () => import('./views/Home.vue')
        },
        {
          path: '/initiatives',
          name: 'initiatives',
          component: () => import('./views/Initiatives.vue')
        },

        // =============================================================================
        // FORMS
        // =============================================================================
        {
          path: '/new-organization',
          name: 'new-organization',
          component: () => import('./views/forms/NewOrganization.vue'),
          meta: {
            breadcrumb: [
              { title: 'Inicio', url: '/' },
              { title: 'Nueva' },
              { title: 'Organización', active: true }
            ],
            pageTitle: 'Nueva Organización'
          }
        },
        {
          path: '/new-event',
          name: 'new-event',
          component: () => import('./views/forms/NewEvent.vue'),
          meta: {
            breadcrumb: [
              { title: 'Inicio', url: '/' },
              { title: 'Nueva' },
              { title: 'Actividad', active: true }
            ],
            pageTitle: 'Nueva Actividad'
          }
        }
      ]
    },
    // =============================================================================
    // FULL PAGE LAYOUTS
    // =============================================================================
    {
      path: '',
      component: () => import('./layouts/full-page/FullPage.vue'),
      children: [
      // =============================================================================
      // PAGES
      // =============================================================================
        {
          path: '/pages/login',
          name: 'page-login',
          component: () => import('./views/pages/Login.vue')
        },
        {
          path: '/pages/error-404',
          name: 'page-error-404',
          component: () => import('./views/pages/Error404.vue')
        }
      ]
    },
    // Redirect to 404 page, if no match found
    {
      path: '*',
      redirect: '/pages/error-404'
    }
  ]
})

router.afterEach(() => {
// Remove initial loading
  const appLoading = document.getElementById('loading-bg')
  if (appLoading) {
    appLoading.style.display = 'none'
  }
})

export default router
