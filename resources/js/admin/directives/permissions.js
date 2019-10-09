import Vue from 'vue';

function can(permission) {
    let permissionsUser = (JSON.parse(localStorage.getItem('permissions'))) ? JSON.parse(localStorage.getItem('permissions')) : []
    let count = 0
    console.log(permissionsUser);
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
}
const permissions = {}
permissions.install = () => {
    Vue.directive('permissions', {
        inserted: function (el, b, vnode) {
            let count = 0
            b.value.map(p => {
                // console.log(p);

                let validate = can(p)
                if (validate) {
                    count++
                }
            })
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
