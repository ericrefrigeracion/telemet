require('./bootstrap');

window.Vue = require('vue');

Vue.component('device-status', require('./components/admins/DeviceStatus.vue').default);
Vue.component('tiny-device-card', require('./components/devices/TinyDeviceCard.vue').default);
Vue.component('health-device-card', require('./components/devices/HealthDeviceCard.vue').default);
Vue.component('full-device-card', require('./components/devices/FullDeviceCard.vue').default);
Vue.component('plot-data-receptions', require('./components/plots/PlotDataReceptions.vue').default);

const app = new Vue({
    el: '#app',
});
