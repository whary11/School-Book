import Vue from 'vue'
import Vuex from 'vuex'
// import Swal from 'sweetalert2'
Vue.use(Vuex)
const stores = new Vuex.Store({
    state: {
        auth:JSON.parse(localStorage.auth) 
    },
    mutations: {

        login(state, data){
            state.auth = data
            
            localStorage.setItem('auth', data)
        }
        
    },
    getters: {
        
    },
    actions: {
        


    }
})


export default stores;