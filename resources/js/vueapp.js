import './bootstrap'

import { createApp } from 'vue'
import Attributevalues from './components/Attributevalues.vue'
import Productattributes from './components/Productattributes.vue'
import VueSweetalert2 from 'vue-sweetalert2';
const app = createApp({});
app.component('Attributevalues',Attributevalues)
app.component('Productattributes',Productattributes);
app.use(VueSweetalert2)
app.mount('#app')
