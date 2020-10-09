require('./bootstrap');

window.Vue = require('vue');

Vue.component('device-status', require('./components/DeviceStatus.vue').default);
Vue.component('tiny-device-card', require('./components/TinyDeviceCard.vue').default);
Vue.component('dairy-device-card', require('./components/DairyDeviceCard.vue').default);

const app = new Vue({
    el: '#app',
});
