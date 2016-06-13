/**
 * Created by jenish on 17-05-2016.
 */

define(['./module'], function (factories) {
    'use strict';
    //noinspection JSUnresolvedFunction
    factories
        .factory('$exceptionHandler', function () {
            return function (exception, cause) {

                var formatted = '';
                var properties = '';
                formatted += 'Exception: "' + exception.toString() + '"\n';
                formatted += 'Caused by: ' + cause + '\n';

                properties += (exception.message) ? 'Message: ' + exception.message + '\n' : ''
                properties += (exception.fileName) ? 'File Name: ' + exception.fileName + '\n' : ''
                properties += (exception.lineNumber) ? 'Line Number: ' + exception.lineNumber + '\n' : ''
                properties += (exception.stack) ? 'Stack Trace: ' + exception.stack + '\n' : ''

                if (properties) {
                    formatted += properties;
                }
                window.console.log(formatted);
                //throw exception;
            };
        })
    ;

});