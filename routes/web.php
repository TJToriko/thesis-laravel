<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LotController;
use App\Http\Controllers\Admin\PaymentSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DeceasedController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SystemSettingController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* UserController */
Route::controller(UserController::class)->group(function () {  
    Route::get('', 'ViewLandingPage')->name('index');
    Route::get('/Gravesite', 'ViewGravesitePage')->name('grave');
    Route::get('/Contact', 'ViewContactPage')->name('contact');
    Route::get('/Profile', 'ViewProfilePage')->name('profile.user');



    Route::get('/Reserved', 'ViewReservePage')->name('reserve');
    Route::get('/lot-user/session-lot-store/{id}', 'sessionlotstoreuser');

    Route::get('/lot-user/session-lot-remove/{id}', 'sessionlotremoveuser')->name('lotuser.session.remove');

    Route::get('/lot-user/get-payment-details/{paymentType}', 'getPaymentSettingDetails');
    Route::get('/lot-user/get-payment-details1/{paymentType1s}', 'getPaymentSettingDetails1');
    Route::get('/lot-user/get-payment-details2/{paymentType2s}', 'getPaymentSettingDetails2');
    Route::get('/lot-user/get-payment-details3/{paymentType3s}', 'getPaymentSettingDetails3');
    Route::get('/lot-user/get-payment-details4/{paymentType4s}', 'getPaymentSettingDetails4');

    Route::post('/customer-add-lot', 'CustomerAddLot')->name('customeraddlot.store');


    Route::get('/My-Lot', 'ViewMyLotPage')->name('my.lot');
    Route::get('/My-Lot/view/{id}', 'ViewMyLot')->name('my.lot.view');
});

/* login route and logout */
Route::controller(AuthController::class)->group(function () {  
    Route::get('login', 'ViewLogin')->name('login');
    Route::get('signup', 'ViewSignup')->name('signup');
    Route::post('signup', 'CreateCustomer')->name('signup.post');
    Route::get('admin-verification', 'ViewEmailSuccess')->name('signup.success');
    Route::post('login', 'loginAction')->name('login.post');
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

/* admin route */
Route::middleware('auth')->group(function () {

    Route::controller(AdminController::class)->prefix('admin')->group(function () {
        Route::get('', 'ViewDashboard')->name('dashboard');
        Route::get('fetch-registrationnotifications', 'fetchNotifications');
        Route::get('add-payment', 'ViewAddPaymentSettings')->name('apsetting');
        Route::get('map', 'ViewMap')->name('map');
        Route::get('analytics', 'ViewAnalytics')->name('analytics');
        Route::get('reservation', 'ViewReservation')->name('reservation');

        Route::get('transfer-ownership', 'ViewTransfer')->name('transfer');
        Route::get('/get-customer/{id}', 'GetCustomer');
        Route::get('/get-customerwithbeneficiary/{id}', 'GetCustomerWithBeneficiary');
        Route::post('/Transfer-Owner', 'TransferOwnership')->name('transfer.post');
        Route::get('transfer-beneficiary', 'ViewTransferBeneficiary')->name('transferbeneficiary');
        Route::post('post-transfer-beneficiary', 'TransferBeneficiary')->name('transferbeneficiary.post');


        Route::get('collection', 'ViewCollection')->name('collection');
        Route::post('collection', 'SelectedPayments')->name('payment.select');
        Route::delete('collection', 'RestoredPayments')->name('payment.restore');
        Route::post('/process-payment', 'processPayment')->name('process.payment');
        Route::post('/process-first-payment', 'processFirstPayment')->name('process.first.payment');
        Route::post('/reject-payment', 'RejectRequest')->name('reject.request');
    });

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('/{id}', 'ViewProfile')->name('profile');
        Route::put('/{id}', 'updateProfile')->name('profile.update');

        Route::get('/', 'ViewChangePassword')->name('password');
        Route::post('/change-password', 'changePassword')->name('change.password');
    });

    Route::controller(LotController::class)->prefix('lot')->group(function () {
        Route::get('lot-settings', 'ViewLotSettings')->name('lsetting');
        Route::post('/addlottype', 'AddLotType')->name('addlottype.store');
        Route::get('/Get-Lot-Type/{id}', 'GetLotType')->name('fetchlottype.store'); // Fetch lot type data by ID
        Route::put('/Update-Lot-Type/{id}', 'UpdateLotType')->name('updatelottype.store'); // Update lot type data
        Route::delete('delete-lottype', 'DeleteLotType')->name('deletelottype.destroy');

        Route::get('/View-Lot/{id}', 'ViewLot')->name('lot.view');
        Route::POST('/Reset-Lot', 'ResetLot')->name('lot.reset');

        Route::post('/addlotclass', 'AddLotClass')->name('addlotclass.store');
        Route::get('/Get-Lot-Class/{id}', 'GetLotClass')->name('fetchlotclass.store'); // Fetch lot type data by ID
        Route::put('/Update-Lot-Class/{id}', 'UpdateLotClass')->name('updatelotclass.store'); // Update lot type data
        Route::delete('delete-lotclass', 'DeleteLotClass')->name('deletelotclass.destroy');

        Route::get('lots', 'ViewLots')->name('lots');
        Route::get('Add-Lot-Owner', 'ViewAddLotOwner')->name('lotowner');
        Route::post('Store-Lot-Owner', 'AddLotOwner')->name('lotowner.store');

        Route::get('/session-lot-store/{id}', 'sessionlotstore')->name('lot.session.store');

        Route::get('/session-lot-remove/{id}', 'sessionlotremove')->name('lot.session.remove');




        Route::get('/get-lot-details/{lotId}', 'getLotDetails');

        Route::get('/get-payment-type/{lotTypeId}/{lotClassId}', 'getPaymentDetails');
        Route::get('/get-payment-type1/{lotTypeId}/{lotClassId}', 'getPaymentDetails1');
        Route::get('/get-payment-type2/{lotTypeId}/{lotClassId}', 'getPaymentDetails2');
        Route::get('/get-payment-type3/{lotTypeId}/{lotClassId}', 'getPaymentDetails3');
        Route::get('/get-payment-type4/{lotTypeId}/{lotClassId}', 'getPaymentDetails4');

        Route::get('/get-payment-details/{paymentType}', 'getPaymentSettingDetails');
        Route::get('/get-payment-details1/{paymentType1s}', 'getPaymentSettingDetails1');
        Route::get('/get-payment-details2/{paymentType2s}', 'getPaymentSettingDetails2');
        Route::get('/get-payment-details3/{paymentType3s}', 'getPaymentSettingDetails3');
        Route::get('/get-payment-details4/{paymentType4s}', 'getPaymentSettingDetails4');

        Route::get('/map', 'ViewMapAdmin')->name('showmap');

        /* route for getting the city and province */
        Route::get('cities/{provinceCode}', 'getCities');
        Route::get('barangays/{citymunCode}', 'getBarangays');
        Route::get('/getLotDetails', 'getLotDetails');

        Route::post('/update-lot-status', 'updateLotStatus')->name('update.lot.status');
        Route::get('/get-lot-status', 'getLotStatus')->name('get.lot.status');
    });

    Route::controller(PaymentSettingController::class)->prefix('payment')->group(function () {
        Route::get('payment-settings', 'ViewPaymentSettings')->name('psetting');
        Route::get('payment-settings/Add-Payment-Settings', 'ViewAddPaymentSettings')->name('apsetting');
        Route::post('payment-settings/Post-Add-Payment-Settings', 'AddPaymentSetting')->name('apsetting.store');
        Route::delete('delete-payment', 'DeletePaymentSetting')->name('apsetting.destroy');
        Route::get('payment-settings/Edit-Payment-Settings/{id}', 'ViewEditPaymentSetting')->name('apsetting.edit');
        Route::put('payment-settings/Edit-Payment-Settings/{id}', 'UpdatePaymentSetting')->name('apsetting.update');
    });

    Route::controller(DeceasedController::class)->prefix('deceased')->group(function () {
        Route::get('deceased', 'ViewDeceased')->name('deceased');
        Route::get('add-deceased', 'ViewAddDeceased')->name('adddeceased');
        Route::get('add-bone', 'ViewAddBone')->name('addbone');
        Route::get('/get-intered/{lotId}', 'getIntered');
        Route::post('post-deceased', 'AddDeceased')->name('deceased.post');
        Route::post('post-bone', 'AddBone')->name('bone.post');
        Route::delete('delete-deceased', 'DeleteDeceased')->name('deceased.destroy');
        Route::delete('delete-deceased-bone', 'DeleteDeceasedBone')->name('deceasedbone.destroy');
        Route::get('edit-deceased/{id}', 'ViewEditDeceased')->name('deceased.edit');
        Route::put('edit-deceased/{id}', 'UpdateDeceased')->name('deceased.update');

        Route::post('/update-deceased-quantity', 'updateDeceasedQuantity')->name('update.deceasedqty');
        Route::post('/update-bone-quantity', 'updateBoneQuantity')->name('update.boneqty');
    });

    Route::controller(AccountController::class)->prefix('account')->group(function () {
        Route::get('', 'ViewAccount')->name('account');
        Route::get('Collector', 'ViewAddCollector')->name('collector');
        Route::post('Add-Collector', 'AddCollector')->name('collector.store');
        Route::delete('Delete-Collector', 'DeleteCollector')->name('collector.destroy');
        Route::get('Edit-Collector/{id}', 'ViewEditCollector')->name('collector.edit');
        Route::put('Edit-Collector/{id}', 'UpdateCollector')->name('collector.update');
    });

    Route::controller(PaymentController::class)->prefix('payments')->group(function () {
        Route::get('', 'ViewPayment')->name('payment');

        Route::get('/View-Customer-Detail/{id}', 'ViewCustomer')->name('view.customer');
        Route::get('/Customer-Approve/{id}', 'ApproveCustomer')->name('approve.customer');
        Route::get('/Customer-Reject/{id}', 'RejectCustomer')->name('reject.customer');
        Route::get('/View-Payment-Detail/{id}', 'ViewPaymentDetail')->name('paymentsdetail');

        Route::get('/get-due-dates/{lotId}', 'getDueDate');
        Route::get('/get-monthly-price/{paymenttrackerId}', 'getMonthlyPrice');
        Route::get('/get-monthly-price1/{lotId}', 'getMonthlyPrice1');
        Route::get('/get-monthly-price2/{lotId}', 'getMonthlyPrice2');
        Route::get('/get-monthly-price3/{lotId}', 'getMonthlyPrice3');

        Route::get('/get-full-price/{lotId}', 'getFullPrice');
        Route::post('/pay-full-price', 'payFullPrice')->name('payment.full');
        
        Route::get('/get-monthly-monthlyprice/{dueDateId}', 'getPaymentMonthlyPrice');
        Route::post('/pay-monthly-price', 'addPayment')->name('payments.add');

        Route::get('edit-customer-Detail/{id}', 'ViewEditCustomer')->name('customer.edit');
        Route::put('edit-customer-Detail/{id}', 'UpdateCustomer')->name('customer.update');
        Route::delete('delete-customer', 'DeleteCustomer')->name('customer.destroy');


        Route::get('/View-Add-Lot/{id}', 'ViewAddLot')->name('addlot.view');
        Route::post('/add-lot', 'AddLot')->name('addlot.store');

    });

    Route::controller(SystemSettingController::class)->prefix('system')->group(function () {
        Route::get('', 'ViewSystemSetting')->name('system');

        /* carousel routings */
        Route::post('/Add-Carousel', 'AddCarousel')->name('carousel.add');
        Route::get('/Get-Carousel/{id}', 'GetCarousel')->name('carousel.fetch'); // Fetch lot type data by ID
        Route::put('/Update-Carousel/{id}', 'UpdateCarousel')->name('carousel.update'); // Update lot type data
        Route::delete('/Delete-Carousel', 'DeleteCarousel')->name('carousel.destroy');

        /* about us routings */
        Route::put('/Update-Aboutus/{id}', 'UpdateAboutus')->name('about.update');

        /* policy routings */
        Route::post('/Add-Policy', 'AddPolicy')->name('policy.add');
        Route::get('/Get-Policy/{id}', 'GetPolicy')->name('policy.fetch'); // Fetch lot type data by ID
        Route::put('/Update-Policy/{id}', 'UpdatePolicy')->name('policy.update'); // Update lot type data
        Route::delete('/Delete-Policy', 'DeletePolicy')->name('policy.destroy');

        /* service routings */
        Route::post('/Add-Service', 'AddService')->name('service.add');
        Route::get('/Get-Service/{id}', 'GetService')->name('service.fetch'); // Fetch lot type data by ID
        Route::put('/Update-Service/{id}', 'UpdateService')->name('service.update'); // Update lot type data
        Route::delete('/Delete-Service', 'DeleteService')->name('service.destroy');

        /* logo & descriptions routings */
        Route::put('/Update-Logo/{id}', 'UpdateLogo')->name('logo.update');
    });

});