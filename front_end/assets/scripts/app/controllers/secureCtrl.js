/**
 * Created by jenish on 17-05-2016.
 */

define(['./module'
        , 'toastr']
    , function (controllers
        , toastr) {
        'use strict';
        controllers.controller('secureCtrl', ['$scope', 'rootUrl', function ($scope, rootUrl) {
            $scope.root_url = rootUrl;
            toastr.info('secure page', 'title');
        }]);
    });