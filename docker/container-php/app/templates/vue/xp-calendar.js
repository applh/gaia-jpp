import XpGaia from "XpGaia"


let data = {

}

let month_names = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
    'July',
    'August',
    'September',
    'October',
    'November',
    'December',
]

let methods = {
    month: function(m) {
        return month_names[m-1]
    }
}

export default {
    template: '#xp-calendar',
    // WARNING: copy data for each instance 
    data: () => Object.assign({}, data),
    // props,
    // computed,
    // created,
    methods,
}