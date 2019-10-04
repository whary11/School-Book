import Vue from 'vue';
import moment from 'moment-timezone'

function format(date) {

    var fecha1 = moment(date);
    var fecha2 = moment(new Date());

    console.log(fecha2.diff(fecha1, 'years'), ' años de diferencia');
    return fecha2.diff(fecha1, 'years');
}
const age = {}
age.install = () => {
    Vue.filter('age', (date) => {
        return format(date)
    })
}

export default age;
