let app = angular.module("app", []);

app.controller("login", function($scope,appService) {
    let self = this;
    let glob = $scope;

    self.field = {
        username: "",
        password: ""
    }

    self.back = () => {
        location.href = "../index.php";
    }

    self.confirm = () => {
        $("#LOGIN_ERR").addClass("is-hidden");
        $(".progress").removeClass("is-hidden");
        const data = {
            data: self.field,
            mode: "LOGIN"
        };
        let promise = appService.get(data);
        promise.then (
            (response) => {
                $(".progress").addClass("is-hidden");
                if(response.data.status) {
                    location.href = "index.php?module=page&mode=manage";
                }else {
                    $("#LOGIN_ERR").removeClass("is-hidden");
                }
            }
        ).catch(
            () => {
                console.log("err");
            }
        )
    }
});

app.controller("password", function($scope,appService) {
    let self = this;
    let glob = $scope;
});

app.controller("content", function($scope,appService) {
    let self = this;
    let glob = $scope;

    self.field = {
        username: "",
        password: ""
    }

    self.back = () => {
        location.href = "../index.php";
    }

});

app.service("appService", [
    "$http",
    "$q",
    function($http, $q) {
        var self = this;

        var deferObject,
            serviceMethods = {
                update: function(data) {
                    var promise = $http.post("api/update.php", data),
                        deferObject = deferObject || $q.defer();

                    promise.then(
                        function(answer) {
                            deferObject.resolve(answer);
                        },
                        function(reason) {
                            deferObject.reject(reason);
                        }
                    );
                    return deferObject.promise;
                },
                insert: function(data) {
                    var promise = $http.post("api/insert.php", data),
                        deferObject = deferObject || $q.defer();

                    promise.then(
                        function(answer) {
                            deferObject.resolve(answer);
                        },
                        function(reason) {
                            deferObject.reject(reason);
                        }
                    );
                    return deferObject.promise;
                },
                remove: function(data) {
                    var promise = $http.post("api/remove.php", data),
                        deferObject = deferObject || $q.defer();

                    promise.then(
                        function(answer) {
                            deferObject.resolve(answer);
                        },
                        function(reason) {
                            deferObject.reject(reason);
                        }
                    );
                    return deferObject.promise;
                },
                remove_img: function(url) {
                    var promise = $http.delete(url),
                        deferObject = deferObject || $q.defer();

                    promise.then(
                        function(answer) {
                            deferObject.resolve(answer);
                        },
                        function(reason) {
                            deferObject.reject(reason);
                        }
                    );
                    return deferObject.promise;
                },
                get: function(data) {
                    var promise = $http.post("api/get.php", data),
                        deferObject = deferObject || $q.defer();

                    promise.then(
                        function(answer) {
                            deferObject.resolve(answer);
                        },
                        function(reason) {
                            deferObject.reject(reason);
                        }
                    );
                    return deferObject.promise;
                }
            };
        return serviceMethods;
    }
]);
app.directive('ngOnFinishRender', function($timeout) {
    return {
        restrict: 'A',
        link: function(scope, element, attr) {
            if (scope.$last === true) {
                $timeout(function() {
                    scope.$emit(attr.broadcastEventName ? attr.broadcastEventName : 'ngRepeatFinished');
                });
            }
        }
    };
});
app.directive('appFilereader', function($q) {
    var slice = Array.prototype.slice;

    return {
        restrict: 'A',
        require: '?ngModel',
        link: function(scope, element, attrs, ngModel) {
                if (!ngModel) return;

                ngModel.$render = function() {};

                element.bind('change', function(e) {
                    var element = e.target;

                    $q.all(slice.call(element.files, 0).map(readFile))
                        .then(function(values) {
                            if (element.multiple) ngModel.$setViewValue(values);
                            else ngModel.$setViewValue(values.length ? values[0] : null);
                        });

                    function readFile(file) {
                        var deferred = $q.defer();

                        var reader = new FileReader();
                        reader.onload = function(e) {
                            deferred.resolve(e.target.result);
                        };
                        reader.onerror = function(e) {
                            deferred.reject(e);
                        };
                        reader.readAsDataURL(file);

                        return deferred.promise;
                    }

                }); //change

            } //link
    }; //return
});
app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });

                event.preventDefault();
            }
        });
    };
});