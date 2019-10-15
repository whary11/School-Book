import Vue from 'vue'
import Vuex from 'vuex'
// import Swal from 'sweetalert2'
Vue.use(Vuex)
const stores = new Vuex.Store({
    state: {
        auth: JSON.parse(localStorage.getItem('auth')),
        currentUser: JSON.parse(localStorage.getItem('currentUser')),
        user: {}
    },
    mutations: {

        login(state, data) {
            // state.auth = data
            localStorage.setItem('auth', data.status)
            localStorage.setItem('currentUser', JSON.stringify(data))
        },


        setUser(state, data) {
            let permissions = data.permissions;
            data.roles.map(rol => {
                console.log('algo');
                rol.permissions.map(permission => {
                    permissions.push(permission)
                })
            })

            localStorage.setItem('permissions', JSON.stringify(permissions))
            localStorage.setItem('roles', JSON.stringify(data.roles))
            state.user = data
        }





    },


    getters: {

    },
    actions: {
        getUser({
            commit
        }) {
            axios
                .get("/api/auth/getUser")
                .then(res => {
                    if (!res.data.transaction.status && res.data.message.type == 'token') {
                        localStorage.removeItem('auth')
                        localStorage.removeItem('currentUser')
                        // location.reload()
                    }
                    commit('setUser', res.data.data)
                })
                .catch(function (error) {});
        },


        rediretNoAuth({
            commit
        }) {
            localStorage.clear()
            // localStorage.removeItem('auth')
            // localStorage.removeItem('currentUser')
            location.reload()
        }

    }
})


export default stores;
