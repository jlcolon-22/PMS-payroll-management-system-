require('./bootstrap');
import {createApp} from 'vue';
import Paginate from "vuejs-paginate-next";
import VueBarcode from '@chenfengyuan/vue-barcode';


import Login from './components/Login.vue';
import Dashboard from './components/admin/Dashboard.vue';
import Department from './components/admin/Department.vue';
import Position from './components/admin/Position.vue';
import Employee from './components/admin/Employee.vue';
import Attendance from './components/admin/Attendance.vue';
import Payroll from './components/admin/Payroll.vue';
import Setting from './components/admin/Setting.vue';
import Scan from './components/admin/Scan.vue';
const app = createApp({});
app.use(Paginate);
app.component(VueBarcode.name, VueBarcode);

app.component('Login',Login);
app.component('Dashboard',Dashboard);
app.component('Department',Department);
app.component('Position',Position);
app.component('Employee',Employee);
app.component('Attendance',Attendance);
app.component('Payroll',Payroll);
app.component('Setting',Setting);
app.component('Scan',Scan);
app.mount('#root');