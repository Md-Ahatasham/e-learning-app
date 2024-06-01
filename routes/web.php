<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth/login');
});

Route::group(['middleware' => ['auth','activityTracker']], function () {

  Route::get('/', 'HomeController@index');
  Route::get('dashboard', 'HomeController@index');
  Route::get('/login', 'HomeController@index');

  ## user role route
  Route::resource('roles','Role\RoleController');

  ## user route
  Route::resource('users','User\UserController');
  Route::get('checkEmail','User\UserController@checkEmail');
  Route::get('userInfoById', 'User\UserController@userInfoById')->name('users.userInfoById');
  Route::get('profile', 'User\UserController@viewProfile')->name('users.profile');
  Route::post('updatePassword', 'User\UserController@updatePassword')->name('users.updatePassword');
  Route::get('editProfile/{id}', 'User\UserController@editProfile')->name('users.editProfile');

  ## student route

  Route::resource('students','Student\StudentController');
  Route::get('dataTableStudentList','Student\StudentController@dataTableStudentList');

  ## student route

  Route::resource('teachers','Teacher\TeacherController');
  Route::post('assignCourse','Teacher\TeacherController@assignCourse')->name('assign.courses');
  Route::put('getCourseInfo','Teacher\TeacherController@getCourseInfoByTeacher')->name('assignCourse.edit');

  ## batch route
  Route::resource('batches','Batch\BatchController');
  Route::get('/batchInfoById', 'Batch\BatchController@batchInfoById')->name('batches.batchInfoById');
  Route::put('/batchInfoUpdate', 'Batch\BatchController@update')->name('batches.update');

  ## course route
  Route::resource('courses','Course\CourseController');
  Route::get('/coursesInfoById', 'Course\CourseController@courseInfoById')->name('courses.courseInfoById');
  Route::put('/coursesInfoUpdate', 'Course\CourseController@update')->name('courses.update');
  Route::get('/coursesEnrolledByStudent/{id}', 'Course\CourseController@getEnrolledCourseByStudent')->name('courses.enrolled');


  Route::resource('rounders','RounderController');
  Route::get('dataTableRounderList','RounderController@dataTableRounderList');
  Route::get('dataTableTabletList','RounderController@dataTableTabletList');
  Route::get('deleteRounderList/{id}','RounderController@deleteRounder');
  Route::get('changeStatus/{id}','RounderController@changeStatus')->name('rounders.changeStatus');

  Route::get('tabletActivityByrounderId/{id}','RounderController@tabletActivityByrounderId');
  Route::get('rounderActivity','RounderController@roundingActivity')->name('rounders.roundingActivity');


  Route::post('rounderAssign','PatientController@assign')->name('patients.assign');
  Route::get('queueList','PatientController@getQueueList')->name('patients.queueList');
  Route::get('queuePatientList','PatientController@getQueuePatientList');
  Route::get('assignRounder/{id}','PatientController@assignRounder');

  Route::get('dischargePatient/{id}','PatientController@dischargePatient')->name('patients.dischargePatient');
  Route::get('dischargedPatientlist','PatientController@dischargedPatientlist')->name('patients.dischargedPatientlist');
  Route::get('dischargedPatient','PatientController@dischargedPatient')->name('patients.dischargedPatient');
  Route::get('dashboardPatientList','HomeController@dataTablePatientList');
  Route::get('deletePatientList/{id}','PatientController@deletePatient');
  Route::get('/getRoomListByUnitId', 'PatientController@getRoomListByUnitId')->name('patients.getRoomListByUnitId');
  Route::get('/getBedListByRoomId', 'PatientController@getBedListByRoomId')->name('patients.getBedListByRoomId');
  Route::get('getRoundingHistory/{id}','PatientController@getRoundingHistory');
  Route::get('getPatientActivityHistory/{id}','PatientController@getPatientActivityHistory');

  Route::resource('precautions','PreCautionController');
  Route::get('precaution','PreCautionController@getColorById')->name('precautions.getColor');

  Route::resource('tablets','TabletController');
  Route::get('/tabletInfo', 'TabletController@edit')->name('tablets.edit');
  Route::put('/tabletInfoUpdate', 'TabletController@update')->name('tablets.update');

  Route::resource('patientPrecautions','PatientPrecautionController');
  Route::resource('locations','LocationController');
  Route::get('/locationInfo', 'LocationController@locationInfoById')->name('locations.locationInfoById');
  Route::put('/locationInfoUpdate', 'LocationController@update')->name('locations.update');

  Route::resource('units','UnitController');
  Route::get('/unitInfo', 'UnitController@unitInfoById')->name('units.unitInfoById');
  Route::put('/unitInfoUpdate', 'UnitController@update')->name('units.update');
  Route::resource('rooms','RoomController');
  Route::get('/roomInfo', 'RoomController@edit')->name('rooms.edit');
  Route::put('/roomInfoUpdate', 'RoomController@update')->name('rooms.update');

  Route::resource('beds','BedController');
  Route::get('/bedInfo', 'BedController@edit')->name('beds.edit');
  Route::put('/bedInfoUpdate', 'BedController@update')->name('beds.update');

  Route::resource('affects','AffectController');
  Route::get('/affectInfo', 'AffectController@affectInfoById')->name('affects.affectInfoById');
  Route::put('/affectInfoUpdate', 'AffectController@update')->name('affects.update');

  Route::resource('behaviors','BehaviorController');
  Route::get('/behaviorInfo', 'BehaviorController@behaviorInfoById')->name('behaviors.behaviorInfoById');
  Route::put('/behaviorInfoUpdate', 'BehaviorController@update')->name('behaviors.update');

  Route::resource('specialties','SpecialtyController');
  Route::get('/specialtyInfo', 'SpecialtyController@edit')->name('specialties.edit');
  Route::put('/specialtyInfoUpdate', 'SpecialtyController@update')->name('specialties.update');

  Route::resource('qualifications','EducationalQualificationController');
  Route::get('/qualificationInfo', 'EducationalQualificationController@edit')->name('qualifications.edit');
  Route::put('/qualificationInfoUpdate', 'EducationalQualificationController@update')->name('qualifications.update');

  Route::resource('notifications','NotificationController');
  Route::get('dataTableNotificationList','NotificationController@dataTableNotificationList');
  Route::get('/notificationsEdit', 'NotificationController@edit')->name('notifications.edit');
  Route::put('/notificationsUpdate', 'NotificationController@update')->name('notifications.update');
  Route::get('countNotification', 'NotificationController@unreadNotificationCount');
  Route::get('updateNotification', 'NotificationController@updateNotification');
  Route::resource('permission','PermissionController');

  Route::resource('activityLogs','ActivityLogController');

});

Auth::routes(['verify' => true]);
Auth::routes();
