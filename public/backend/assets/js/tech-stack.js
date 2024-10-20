function getQueryStringParameters() {
    var path = "";
    var bundle = "";
    try {
        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);

        console.log(queryString);

        if (params.get("isp") == 1) { // is single product
            bundle = "";
            path = "https://themeforest.net/item/able-pro-bootstrap-admin-dashboard-template/50170229";
        }
        else {
            bundle = "?viabundle=1";
            path = "https://themeforest.net/item/able-pro-responsive-bootstrap-4-admin-template/19300403?viabundle=1";
        }
    }
    catch (err) {
        bundle = "?viabundle=1";
        path = "https://themeforest.net/item/able-pro-responsive-bootstrap-4-admin-template/19300403?viabundle=1";
    }
    document.addEventListener('DOMContentLoaded', function () {
        var elem = document.querySelectorAll('.btn-buy');
        for (var j = 0; j < elem.length; j++) {
            elem[j].setAttribute('href', path)
        }
    })
    document.addEventListener('DOMContentLoaded', function () {
        var elem = document.querySelectorAll('.technology-block a');
        for (var j = 0; j < elem.length; j++) {
            var dattr = elem[j].getAttribute('href');
            elem[j].setAttribute('href', dattr + bundle);
        }
    })
}

getQueryStringParameters();