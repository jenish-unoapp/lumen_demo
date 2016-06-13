/**
 * Created by jenish on 17-05-2016.
 */

define(['./module'
        , "moment"
        , 'jquery'
        , 'lodash'
        , 'toastr'
    ]
    , function (services, moment, $, _, toastr) {
        'use strict';
        //noinspection JSUnresolvedFunction
        services.service('commonService'
            , ['rootUrl'
                , '$http'
                , '$q'
                , 'GlobalConst'
                , 'userService'
                , 'commonFactory'
                , function (rootUrl, $http, $q, GlobalConst, userService, commonFactory) {
                    this.logoutAndClearAllData = function () {
                        userService.removeAuthentication();
                        commonFactory.clearDemoArray();
                    }
                }]);
    });
