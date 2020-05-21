require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('row-all-devices', require('./components/RowAllDevices.vue').default);

const app = new Vue({
    el: '#app',
});
