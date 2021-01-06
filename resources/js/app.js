

require('alpinejs');

require('jquery');
require('./bootstrap');
require('admin-lte');
require('axios');
require('bootstrap-select');
window.toastr= require('toastr');

window.Vue = require('vue');

Vue.component('driver-component', require('./components/DriverComponent.vue').default);
Vue.component('client-component', require('./components/ClientComponent.vue').default);
Vue.component('create-user-component', require('./components/UserCreateComponent.vue').default);

Vue.component('car-component', require('./components/CarComponent.vue').default);
Vue.component('create-car-component', require('./components/CarNewComponent.vue').default);

Vue.component('model-car-component', require('./components/ModelCarComponent.vue').default);
Vue.component('create-model-car-component', require('./components/ModelCarCreateComponent.vue').default);

Vue.component('documentation-component', require('./components/DocumentationComponent.vue').default);
Vue.component('create-documentation-component', require('./components/DocumentationCreateComponent.vue').default);

Vue.component('price-component', require('./components/PriceComponent.vue').default);

Vue.component('balance-driver-component', require('./components/BalanceDriverComponent.vue').default);

new Vue({
	el: '#app'
});