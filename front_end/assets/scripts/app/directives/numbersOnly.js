/**
 * Created by jenish on 17-05-2016.
 */

define([
        './module'
    ]
    , function (directives) {
        'use strict';
        //noinspection JSUnresolvedFunction
        directives.directive('numbersOnly', function () {
            return {
                require: 'ngModel',
                //restrict: 'A',
                link: function (scope, el, attrs, ctrl) {
                    ctrl.$parsers.push(function (inputValue) {
                        // this next if is necessary for when using ng-required on your input.
                        // In such cases, when a letter is typed first, this parser will be called
                        // again, and the 2nd time, the value will be undefined
                        if (inputValue == undefined) return '';
                        var transformedInput = inputValue.replace(/[^0-9]/g, '');
                        if (transformedInput != inputValue) {
                            ctrl.$setViewValue(transformedInput);
                            ctrl.$render();
                        }
                        return transformedInput;
                    });
                }
            };
        })
    });
