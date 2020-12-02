
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


import VueRouter from 'vue-router'
import Routes from './route'
import jsPDF from 'jspdf'

// require('./bootstrap');




window.Vue = require('vue');

Vue.use (VueRouter);

const router = new VueRouter({
	routes: Routes,
    base: '/',
    mode: 'history',
    history: true
});




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('home', require('./components/Home.vue').default);
Vue.component('sessions', require('./components/Sessions.vue').default);
Vue.component('configure_session', require('./components/ConfigureSession.vue').default);
Vue.component('users', require('./components/Users.vue').default);
Vue.component('questions', require('./components/Questions.vue').default);
Vue.component('excelExport', require('./components/excelExport.vue').default);
Vue.component('exam_types', require('./components/ExamType.vue').default);
Vue.component('file-upload', require('./components/FileUploadComponent.vue').default);
Vue.component('user_exam_upload', require('./components/UserExamUpload.vue').default);
Vue.component('testsetups', require('./components/TestSetup.vue').default);
Vue.component('exams', require('./components/Exams.vue').default);
Vue.component('gradings', require('./components/Gradings.vue').default);
Vue.component('access', require('./components/Access.vue').default);
Vue.component('students', require('./components/Students.vue').default);
Vue.component('parentDetails', require('./components/ParentDetails.vue').default);
Vue.component('classes', require('./components/Classes.vue').default);
Vue.component('subjects', require('./components/Subjects.vue').default);
Vue.component('staff', require('./components/Staff.vue').default);
Vue.component('staffSubjects', require('./components/StaffSubjects.vue').default);
Vue.component('staffQualifications', require('./components/StaffQualifications.vue').default);
Vue.component('student_upload', require('./components/StudentUpload.vue').default);
Vue.component('studentExcelExport', require('./components/studentExcelExport.vue').default);
Vue.component('staff_upload', require('./components/StaffUpload.vue').default);
Vue.component('staffExcelExport', require('./components/staffExcelExport.vue').default);
Vue.component('subjectExcelExport', require('./components/subjectExcelExport.vue').default);
Vue.component('classExcelExport', require('./components/classExcelExport.vue').default);
Vue.component('sessionExcelExport', require('./components/sessionExcelExport.vue').default);
Vue.component('TimeTables', require('./components/TimeTables.vue').default);
Vue.component('timetable_upload', require('./components/TimeTableUpload.vue').default);
Vue.component('TimeTableExcelExport', require('./components/TimeTableExcelExport.vue').default);
Vue.component('Fees', require('./components/Fees.vue').default);
Vue.component('Yearbook', require('./components/Yearbook.vue').default);
Vue.component('student-profile', require('./components/studentProfile.vue').default);
Vue.component('result', require('./components/Results.vue').default);
Vue.component('Exam-Setup', require('./components/ExamSetup.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue(
{
    el: '#app',
    router: router
});
