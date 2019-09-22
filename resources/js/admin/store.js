import Vue from 'vue'
import Vuex from 'vuex'
// import Swal from 'sweetalert2'
Vue.use(Vuex)
const stores = new Vuex.Store({
    state: {
        auth: JSON.parse(localStorage.getItem('auth')),
        currentUser: JSON.parse(localStorage.getItem('currentUser'))
    },
    mutations: {

        login(state, data) {
            // state.auth = data
            localStorage.setItem('auth', data.status)
            localStorage.setItem('currentUser', JSON.stringify(data))
        },





    },


    getters: {

    },
    actions: {


        rediretNoAuth({
            commit
        }) {
            localStorage.removeItem('auth')
            localStorage.removeItem('currentUser')
            location.reload()
        }

    }
})


export default stores;
