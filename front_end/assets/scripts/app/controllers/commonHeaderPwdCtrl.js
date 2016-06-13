/**
 * Created by jenish on 17-05-2016.
 */

define(['./module'], function (controllers) {
    'use strict';
    controllers.controller('commonHeaderPwdCtrl', ['$scope', 'rootUrl', function ($scope, rootUrl) {
        $scope.root_url = rootUrl;
        $scope.init = function () {
            /* Hamburger menu */
            $('.navigation-hamburger').click(function () {
                if ($('.navigation-hamburger-links').is(':visible')) {
                    $('.navigation-hamburger-links').slideUp();
                } else {
                    $('.navigation-hamburger-links').slideDown();
                }
            });
        };
        $scope.init();
    }]);
});