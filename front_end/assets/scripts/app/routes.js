/**
 * Created by jenish on 17-05-2016.
 */

define(['app'
    , 'angular'
    , 'angularRoute'
    , 'angularCookies'
    , 'angularResource'
    , 'angularSanitize'
], function (app) {
    'use strict';
    return app.config(['$routeProvider', function ($routeProvider) {
        $routeProvider.when('/', {
            templateUrl: 'front_end/js/app/partials/index/index.html',
            controller: 'indexCtrl'
        });

        $routeProvider.when('', {
            templateUrl: 'front_end/js/app/partials/index/index.html',
            controller: 'indexCtrl'
        });

        $routeProvider.when('/login', {
            templateUrl: 'front_end/js/app/partials/login/login.html',
            controller: 'loginCtrl'
        });

        $routeProvider.when('/logout', {
            template: "",
            controller: 'logoutCtrl'
        });

        $routeProvider.when('/secure_page', {
            templateUrl: 'front_end/js/app/partials/secure_page/index.html',
            controller: 'secureCtrl',
            resolve: {
                userService: 'userService',
                authenticationRequired: function (userService) {
                    userService.isAuthenticated();
                }
            }
        });

       /* $routeProvider.when('/forgot_password', {
            templateUrl: 'school_flow/js/app/partials/forgot_password/forgot_password.html',
            controller: 'forgotPwdCtrl'
        });

        $routeProvider.when('/reset_password', {
            templateUrl: 'school_flow/js/app/partials/reset_password/reset_password.html',
            controller: 'resetPwdCtrl'
        });

        $routeProvider.when('/account', {
            templateUrl: 'school_flow/js/app/partials/account/account.html',
            controller: 'accountCtrl',
            resolve: {
                userService: 'userService',
                authenticationRequired: function (userService) {
                    userService.isAuthenticated();
                }
            }
        });

        $routeProvider.when('/faq', {
            templateUrl: 'school_flow/js/app/partials/faq/faq.html',
            controller: 'faqCtrl'
        });

        $routeProvider.when('/support', {
            templateUrl: 'school_flow/js/app/partials/support/support.html',
            controller: 'supportCtrl'
        });

        $routeProvider.when('/register1', {
            templateUrl: 'school_flow/js/app/partials/register/register1.html',
            controller: 'registerCtrl'
        }).when('/register2', {
            templateUrl: 'school_flow/js/app/partials/register/register2.html',
            controller: 'registerCtrl'
        }).when('/register3', {
            templateUrl: 'school_flow/js/app/partials/register/register3.html',
            controller: 'registerCtrl'
        }).when('/register4', {
            templateUrl: 'school_flow/js/app/partials/register/register4.html',
            controller: 'registerCtrl'
        }).when('/register_thank_you', {
            templateUrl: 'school_flow/js/app/partials/register/thank_you.html',
            controller: 'registerCtrl'
        });*/


        $routeProvider.otherwise({
            redirectTo: '/'
        });
    }]);
});