//By Arnanthachai (it_531413016@hotmail.com)
angular.module('wpAjaxService', [])
    .service('$wpAjax', function($http) {
        this.exec = function(data, event, admin_ajax_path, func_success, func_fail) {
            console.log('EXECUTE:', data);

            $http.post(admin_ajax_path + "?action=" + event, data, {
                //                    headers : {
                //                        'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                //                    }
            }).then(function(response) {
                if (response.data.success) {
                    func_success(response.data); //callback
                } else {
                    func_fail(response.data); //callback
                }
            }, function() {
                console.error('No connection!', 'Cannot connect or Error!');
            });
        };
    });
