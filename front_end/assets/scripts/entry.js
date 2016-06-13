/**
 * Created by jenish on 13-06-2016.
 */
require.config({
    baseUrl: './front_end/js',
    paths: {
        jquery: "vendor/jquery",
        lodash: "vendor/lodash",
        angular: 'vendor/angular',
        angularRoute: 'vendor/angular-route',
        angularUiRoute: 'vendor/angular-ui-router',
        angularCookies: 'vendor/angular-cookies',
        angularResource: 'vendor/angular-resource',
        angularSanitize: 'vendor/angular-sanitize',
        angularBase64: 'vendor/angular-base64',
        loadingBar: 'vendor/loading-bar',
        infiniteScroll: 'vendor/ng-infinite-scroll',
        domReady: 'vendor/domReady',
        toastr: 'vendor/toastr',
        moment: 'vendor/moment',


        bootstrap: 'app/bootstrap',
        app: 'app/app',
        routes: 'app/routes',
        jqInitScript: 'app/extras/script'
    },
    shim: {
        'moment': {
            exports: 'moment'
        },
        'jquery': {
            exports: '$'
        },
        'lodash': {
            exports: '_'
        },
        'domReady': {
            exports: 'domReady'
        },
        'infiniteScroll': {
            deps: ['angular'],
            exports: 'infiniteScroll'
        },
        'angularRoute': {
            deps: ['angular']
        },
        'angularUiRoute': {
            deps: ['angular']
        },
        'angularCookies': {
            deps: ['angular']
        },
        'angularResource': {
            deps: ['angular']
        },
        'angularSanitize': {
            deps: ['angular']
        },
        'angularBase64': {
            deps: ['angular'],
            exports: 'angularBase64'
        },
        'loadingBar': {
            deps: ['angular'],
            exports: 'loadingBar'
        },
        'angular': {
            deps: ['jquery', 'lodash', 'toastr', 'moment'],
            exports: 'angular'
        },
        'jqInitScript': {
            deps: ['jquery']
        },
        'toastr': {
            deps: ['jquery'],
            exports: 'toastr'
        }
    },
    deps: ['bootstrap']
});
