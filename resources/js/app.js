require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('device-status', require('./components/DeviceStatus.vue').default);

const app = new Vue({
    el: '#app',
});
