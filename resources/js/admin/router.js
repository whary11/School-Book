import VueRouter from 'vue-router'
import Login from '../components/auth/Login'
import Dashboard from '../components/Dashboard/Dashboard.vue'
import PermissionsUsers from '../components/Roles/PermissionsUsers'
import PermissionsRoles from '../components/Roles/PermissionsRoles'
// import Login from '../components/auth/LoginComponent'

const routes = [{
        path: '/gateway',
        name: 'dashboard',
        component: Dashboard,


    },
    {
        path: '/gateway/login',
        name: 'login',
        component: Login,
        beforeEnter: (to, from, next) => {
            console.log(to.name);
            if (JSON.parse(localStorage.getItem('auth'))) {
                next({
                    path: '/gateway'
                })
            } else {
                console.log('Ir a login');
                next(true)
            }
        }

    },
    {
        path: '/gateway/permissions_roles',
        name: 'roles',
        component: PermissionsRoles,
        beforeEnter: (to, from, next) => {
            if (JSON.parse(localStorage.getItem('auth'))) {
                next(true)
            } else {
                next({
                    path: '/gateway/login'
                })
            }
        }

    },
    {
        path: '/gateway/permissions_users',
        name: 'roles',
        component: PermissionsUsers,
        beforeEnter: (to, from, next) => {
            if (JSON.parse(localStorage.getItem('auth'))) {
                next(true)
            } else {
                next({
                    path: '/gateway/login'
                })
            }
        }

    },
]


const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})



function existToken() {
    if ((localStorage.auth != null || localStorage.auth != undefined) && JSON.parse(localStorage.auth) == true) {
        return true;
    } else {
        return false;
    }
}





router.beforeEach((to, from, next) => {
    if (to.name == 'login' && JSON.parse(localStorage.getItem('auth'))) {
        // console.log(to.name);
        next({
            path: '/gateway'
        })
    } else {
        next()
    }

});



function can(permission) {
    let permissionsUser = (JSON.parse(localStorage.getItem('currentUser'))) ? JSON.parse(localStorage.getItem('currentUser')).user.permissions : []
    // console.log(permission);

    permissionsUser.map((per) => {
        if (per.name == permission) {
            // console.log(per.name);
            return 'OK'
        }
    })
}

console.log(can('students create'))
export default router;
