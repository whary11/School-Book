import VueRouter from 'vue-router'
import Login from '../components/auth/Login'
// import Login from '../components/auth/LoginComponent'

const routes = [
    {
        path: '/gateway/login',
        name: 'login',
        component: Login,
        
    },
]


const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})



function existToken() {
    if ((localStorage.auth != null || localStorage.auth != undefined) &&  JSON.parse(localStorage.auth) == true) {
        return true;
    } else {
        return false;
    }
}





router.beforeEach( (to, from, next) => {
    console.log(to);
    if ((to.name == 'login')  && JSON.parse(localStorage.auth) == true) {
        console.log(to.name);
        next({ path: '/gateway' })
    }
});
export default router;