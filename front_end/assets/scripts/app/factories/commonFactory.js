/**
 * Created by jenish on 17-05-2016.
 */

define([
    './module'
    , "lodash"
    , 'toastr'
    , 'angular'
], function (factories, _, toastr, angular) {
    'use strict';
    //noinspection JSUnresolvedFunction
    factories
        .factory('commonFactory', [
            'rootUrl'
            , '$http'
            , '$q'
            , 'GlobalConst'
            , '$cookieStore'
            , '$base64'
            , function (rootUrl, $http, $q, GlobalConst, $cookieStore, $base64) {
                var demo_array = [];
                var commonFactory = {};

                commonFactory.clearDemoArray = function () {
                    demo_array = [];
                };

                return commonFactory;
            }]);

});