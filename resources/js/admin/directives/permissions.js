import Vue from 'vue';
import {
    isArray
} from 'util';

function can(permission) {
    let permissionsUser = (JSON.parse(localStorage.getItem('permissions'))) ? JSON.parse(localStorage.getItem('permissions')) : []
    let rolesUser = (JSON.parse(localStorage.getItem('roles'))) ? JSON.parse(localStorage.getItem('roles')) : []
    let count = 0
    let superAdmin = 'SUPERADMIN'
    let countRole = 0
    rolesUser.map(item => {
        if (item.name == superAdmin) {
            countRole++
        }
    })
    // console.log(permissionsUser);
    if (countRole == 0) {
        permissionsUser.map((per) => {
            if (per.name == permission) {
                count++
            }
        })
        if (count > 0) {
            return true
        } else {
            return false
        }
    } else {
        return true
    }


}
const permissions = {}
permissions.install = () => {
    Vue.directive('permissions', {
        inserted: function (el, b, vnode) {
            let count = 0
            if (isArray(b.value)) {
                b.value.map(p => {
                    // console.log(p);
                    let validate = can(p)
                    if (validate) {
                        count++
                    }
                })
            } else {
                let validate = can(b.value)
                if (validate) {
                    count++
                }
            }
            if (count == 0) {
                el.remove()
            }
            // console.log(count);
        }
    })
}

//Ejemplo para su utilización 
// < div id="algo" v-permissions="['create_students', 'algo', 'create_estudents']" > no mas, borrate </div>


export default permissions;
