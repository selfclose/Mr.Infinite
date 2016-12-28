//By Arnanthachai (it_531413016@hotmail.com)
function wpAjax(data, action, admin_ajax_path, func_success, func_fail) {
    jQuery.ajax({
        url: admin_ajax_path, //admin_url('admin-ajax.php');
        cache: false,
        type: "POST",
        data: {
            data: data, //{id: 0}
            action: action //'load_users'
        },
        dataType: "json",
        success: function (n, textStatus, xhr) {
            if (n.success) {

                console.log("SUCCESS! You buy it");
                func_success(n);
            }
            else {
                console.log("FAIL!", n);
                func_fail(n)
            }
            console.log('pass ok!', xhr);
        },
        error: function (n) {
            console.log(n);
        }
    });
}
