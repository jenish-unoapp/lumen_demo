/**
 * Created by jenish on 17-05-2016.
 */
define([
    'angular'
    , 'angularRoute'
    , 'angularCookies'
    , 'angularResource'
    , 'angularSanitize'
    , 'angularBase64'
    , 'loadingBar'
    , 'infiniteScroll'

    , '../js/app/controllers/index'
    , '../js/app/factories/index'
    , '../js/app/services/index'
    , '../js/app/directives/index'

    , 'jqInitScript'
    , 'toastr'
], function (ng
    , ngRoute
    , ngCookies
    , ngResource
    , ngSanitize
    , base64
    , loadingBar
    , infiniteScroll
    , controllerIndex
    , factoriesIndex
    , serviceIndex
    , directiveIndex
    , jqInitScript
    , toastr) {
    'use strict';


    //$scope.encoded = $base64.encode('a string');
    //window.console.log(' encoded : ' + $scope.encoded);
    //$scope.decoded = $base64.decode($scope.encoded);
    //window.console.log(' decoded : ' + $scope.decoded);

    //toastr["error"]("this is my message ", "title message ")
    //toastr["info"]("this is my message ", "title message ")
    //toastr["success"]("this is my message ", "title message ")
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    return ng.module('app', [
        , 'ngRoute'
        , 'ngCookies'
        , 'ngResource'
        , 'ngSanitize'
        , 'base64'
        , 'angular-loading-bar'
        , 'infinite-scroll'

        , 'app.controllers'
        , 'app.factories'
        , 'app.services'
        , 'app.directives'
    ])
        .constant('rootUrl', $('#hdnRootUrl').val())
        .constant('GlobalConst', {
            "networkErrorTitle": "Network Error",
            "networkSuccessTitle": "Success",
            "networkServerErrorTitle": "Something went wrong",
            "validationErrorTitle": "Invalid or missing information"
        }).config(['cfpLoadingBarProvider', function (cfpLoadingBarProvider) {
            cfpLoadingBarProvider.includeSpinner = false;
            //cfpLoadingBarProvider.latencyThreshold = 500; // threshold time to invoke loading bar in 500ms
        }])
        .run(function ($rootScope, $route, userService) {
            try {
                if (userService.isAuthenticated()) {
                    window.location.replace('#/balance');
                }
            } catch (e) {
                // do nothing with this error
            }

            $rootScope.$on("$routeChangeSuccess", function (event, next, current) {
                //var current_path = !!current && !!current.$$route ? current.$$route.originalPath : "";
                //var next_path = !!next && !!next.$$route ? next.$$route.originalPath : "";
                document_ready();
            });

            $rootScope.$on('$routeChangeError', function (event, next, current, error) {
                if (error.name == 'AuthenticationRequired') {
                    window.location.replace('#/login');
                }
            });
        });
});