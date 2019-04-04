import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
      loggedIn: localStorage.getItem('access_token') || null
    },
    mutations: {
      loggedInPerform (state) {
        state.loggedIn = localStorage.getItem('access_token')
      },
      loggedOutPerform (state) {
        state.loggedIn = null
      }
    },
    actions: {
  
    }
  })