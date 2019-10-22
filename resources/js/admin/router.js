import VueRouter from 'vue-router'
import Login from '../components/auth/Login'
import Dashboard from '../components/Dashboard/Dashboard.vue'
import PermissionsUsers from '../components/Roles/PermissionsUsers'
import PermissionsRoles from '../components/Roles/PermissionsRoles'

import CreateStudents from '../components/Users/CraeteStudents'
import CreateTeachers from '../components/Users/CreateTeachers'
import Perfil from '../components/Users/Perfil'
import Enrollment from '../components/Enrollment/Enrollment'

import CreatePlanning from '../components/Planning/CreatePlanning'
import EditPlanning from '../components/Planning/EditPlanning'
// import Login from '../components/auth/LoginComponent'

const routes = [{
        path: '/gateway',
        name: 'dashboard',
        component: Dashboard,
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
                next(true)
            }
        }

    },
    {
        path: '/gateway/permissions_roles',
        name: 'permissions_roles',
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
        name: 'permissions_users',
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
    {
        path: '/gateway/students',
        name: 'students',
        component: CreateStudents,
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
        path: '/gateway/create-planning',
        name: 'create-planning',
        component: CreatePlanning,
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
        path: '/gateway/edit-planning',
        name: 'edit-planning',
        component: EditPlanning,
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
        path: '/gateway/teachers',
        name: 'teachers',
        component: CreateTeachers,
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
        path: '/gateway/perfil',
        name: 'perfil',
        component: Perfil,
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
        path: '/gateway/enrollments',
        name: 'enrollments',
        component: Enrollment,
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

    let count = 0;

    permissionsUser.map((per) => {
        if (per.name == permission) {
            // console.log(per.name);
            count++
        }
    })


    if (count > 0) {
        return true
    } else {
        return false
    }
}

// console.log(can('students create'))
export default router;
