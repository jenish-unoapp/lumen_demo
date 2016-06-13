/**
 * Created by jenish on 17-05-2016.
 */

define(['./module'], function (controllers) {
    'use strict';
    //noinspection JSUnresolvedFunction
    controllers
        .controller('logoutCtrl', ['$location', 'commonService', function ($location, commonService) {
            commonService.logoutAndClearAllData();
            $location.path('/login');
        }]);
});