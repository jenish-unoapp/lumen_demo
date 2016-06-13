/**
 * Created by jenish on 17-05-2016.
 */

define([
        './module'
        , 'jquery'
    ]
    , function (directives, $) {
        'use strict';
        //noinspection JSUnresolvedFunction
        directives.directive('uniqueEmail', ["commonService", function (commonService) {
            return {
                require: 'ngModel',
                restrict: 'A',
                link: function (scope, el, attrs, ctrl) {

                    //TODO: We need to check that the value is different to the original

                    //using push() here to run it as the last parser, after we are sure that other validators were run
                    ctrl.$parsers.push(function (viewValue) {
                        if (viewValue && validate_email(viewValue)) {
                            commonService.checkUsernameExist({email: viewValue}).then(function (d) {
                                //noinspection JSUnresolvedVariable
                                if (d.payload.user_exist) {
                                    $(el).prop('unique-email', false);
                                } else {
                                    $(el).prop('unique-email', true);
                                }
                            });
                        }
                        return viewValue;
                    });
                }
            };
        }])
    });
