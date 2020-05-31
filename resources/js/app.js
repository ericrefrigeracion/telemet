require('./bootstrap');

window.Vue = require('vue');

Vue.component('chart-tiny-t', require('./components/ChartTinyT.vue').default);
Vue.component('device-status', require('./components/DeviceStatus.vue').default);
Vue.component('tiny-t-device-card', require('./components/TinyTDeviceCard.vue').default);
Vue.component('tiny-pump-device-card', require('./components/TinyPumpDeviceCard.vue').default);

const app = new Vue({
    el: '#app',
});
