
import Home from './components/Home.vue';
import Sessions from './components/Sessions.vue';
import ConfigureSession from './components/ConfigureSession.vue';
import Users from './components/Users.vue';
import Questions from './components/Questions.vue';
import Tests from './components/Tests.vue';
import ExamType from './components/ExamType.vue';
import TestSetup from './components/TestSetup.vue';
import Exams from './components/Exams.vue';
import Gradings from './components/Gradings.vue';
import Access from './components/Access.vue';
import Students from './components/Students.vue';
import Classes from './components/Classes.vue';
import Subjects from './components/Subjects.vue';
import Staff from './components/Staff.vue';
import ParentDetails from './components/ParentDetails.vue';
import TimeTables from './components/TimeTables.vue';
import StaffSubjects from './components/StaffSubjects.vue';
import StaffQualifications from './components/StaffQualifications.vue';
import Fees from './components/Fees.vue';
import Yearbook from './components/Yearbook.vue';
import studentProfile from './components/studentProfile.vue';
import Results from './components/Results.vue';
import ExamSetup from './components/ExamSetup.vue';

export default 
[

	{path: '/home', component: Home},

	{path: '/sessions', component: Sessions},

	{path: '/configure_session/:id', component: ConfigureSession},

	{path: '/', component: Sessions},

	{path: '/users', component: Users},

	{path: '/questions', component: Questions},

	{path: '/tests', component: Tests},

	{path: '/exam_types', component: ExamType},

	{path: '/exams', component: Exams},

	{path: '/gradings', component: Gradings},

	{path: '/testsetups', component: TestSetup},

	{path: '/access/:id', component: Access},

	{path: '/students', component: Students},

	{path: '/class', component: Classes},

	{path: '/subjects', component: Subjects},

	{path: '/staff', component: Staff},

	{path: '/parentDetails/:id', component: ParentDetails},

	{path: '/timetable', component: TimeTables},

	{path: '/staffSubjects/:id', component: StaffSubjects},

	{path: '/staffQualifications/:id', component: StaffQualifications},

	{path: '/fees', component: Fees},

	{path: '/year-book', component: Yearbook},

	{path: '/student-profile/:id', component: studentProfile},

	{path: '/results', component: Results},

	{path: '/exam-setup', component: ExamSetup}
]