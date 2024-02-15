import { createApp } from 'vue'
import ClassifiedEmailFilterForm from './components/ClassifiedEmailFilterForm.vue'
 
const app = createApp()
 
app.component('classified-email-filter-form', ClassifiedEmailFilterForm)
 
app.mount('#app')