/**
 * Created by jenish on 17-05-2016.
 */

define([
    './module'
    , 'toastr'
], function (controllers, toastr) {
    'use strict';
    //noinspection JSUnresolvedFunction
    controllers
        .controller('loginCtrl', [
            '$scope'
            , '$location'
            , 'userService'
            , 'GlobalConst'
            , function ($scope, $location, userService, GlobalConst) {
                $scope.username = '';
                $scope.password = '';
                $scope.persist = true;


                function onSuccessfulLogin() {
                    $location.path('/secure_page');
                }

                function onFailedLogin(error) {
                    toastr["error"]("" + error, GlobalConst.networkServerErrorTitle);
                }

                $scope.login = function () {
                    userService.authenticate($scope.username, $scope.password, onSuccessfulLogin, onFailedLogin, $scope.persist);
                };
            }]);
});