/**
 * Created by jenish on 17-05-2016.
 */

define(['./module'
        , "lodash"
        , 'jquery'
        , 'moment'
    ]
    , function (services, _, $, moment) {
        'use strict';
        //noinspection JSUnresolvedFunction
        services.service('userService'
            , ['rootUrl'
                , '$http'
                , '$cookieStore'
                , function (rootUrl, $http, $cookieStore) {
                    function NoAuthenticationException(message) {
                        //window.console.log('AuthenticationRequired');
                        this.name = 'AuthenticationRequired';
                        this.message = message;
                    }

                    function AuthenticationExpiredException(message) {
                        //window.console.log('AuthenticationExpired');
                        this.name = 'AuthenticationExpired';
                        this.message = message;
                    }

                    function AuthenticationRetrievalException(message) {
                        //window.console.log('AuthenticationRetrieval');
                        this.name = 'AuthenticationRetrieval';
                        this.message = message;
                    }

                    var userData = {
                        isAuthenticated: false,
                        username: '',
                        bearerToken: '',
                        expirationDate: null
                    };

                    function isAuthenticationExpired(expirationDate) {
                        var now = new Date();
                        expirationDate = new Date(expirationDate);
                        return expirationDate - now <= 0;
                    }

                    function saveData() {
                        removeData();
                        $cookieStore.put('auth_data', userData);
                        window.localStorage["auth_data"] = window.JSON.stringify(userData);
                    }

                    function removeData() {
                        $cookieStore.remove('auth_data');
                        window.localStorage.removeItem("auth_data");
                    }

                    function retrieveSavedData() {
                        if (_.isUndefined($cookieStore.get('auth_data'))
                            && !_.isUndefined(window.localStorage["auth_data"])) {
                            $cookieStore.put('auth_data', $.parseJSON(window.localStorage["auth_data"]));
                        }
                        var savedData = $cookieStore.get('auth_data');
                        if (_.isUndefined(savedData)) {
                            throw new AuthenticationRetrievalException('No authentication data exists');
                        } else if (isAuthenticationExpired(savedData.expirationDate)) {
                            throw new AuthenticationExpiredException('Authentication token has already expired');
                        } else {
                            userData = savedData;
                            setHttpAuthHeader();
                        }
                    }

                    function clearUserData() {
                        userData.isAuthenticated = false;
                        userData.username = '';
                        userData.bearerToken = '';
                        userData.expirationDate = null;
                    }

                    function setHttpAuthHeader() {
                        $http.defaults.headers.common.Authorization = '' + userData.bearerToken;
                    }

                    this.isAuthenticated = function () {
                        if (userData.isAuthenticated && !isAuthenticationExpired(userData.expirationDate)) {
                            return true;
                        } else {
                            try {
                                retrieveSavedData();
                            } catch (e) {
                                throw new NoAuthenticationException('Authentication not found');
                            }
                            return true;
                        }
                    };

                    this.getUserData = function () {
                        return userData;
                    };

                    this.removeAuthentication = function () {
                        removeData();
                        clearUserData();
                        $http.defaults.headers.common.Authorization = null;
                    };

                    this.authenticate = function (username, password, successCallback, errorCallback, persistData) {
                        this.removeAuthentication();
                        var config = {
                            method: 'POST',
                            url: rootUrl + '/api/auth/login',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            data: {
                                "email": username,
                                "password": password
                            }
                        };

                        $http(config)
                            .success(function (data) {
                                if (data.code == 200) {
                                    userData.isAuthenticated = true;
                                    userData.username = data.payload.Email;
                                    userData.bearerToken = data.session.Id;
                                    userData.expirationDate = moment(data.session.ExpireAt).toDate();
                                    setHttpAuthHeader();
                                    if (persistData === true) {
                                        saveData();
                                    }
                                    if (typeof successCallback === 'function') {
                                        successCallback();
                                    }
                                } else {
                                    errorCallback(data.message);
                                }
                            })
                            .error(function (data) {
                                if (typeof errorCallback === 'function') {
                                    if (data.message) {
                                        errorCallback(data.message);
                                    } else {
                                        errorCallback('Unable to contact server; please, try again later.');
                                    }
                                }
                            });
                    };
                }]);
    });
