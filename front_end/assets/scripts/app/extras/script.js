/**
 * Created by jenish on 13-06-2016.
 */
var document_ready = function () {
    //console.log('here : ' + $.fn.jquery);
};

var validate_email = function (email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
};

var validate_email_domain = function (email, domain) {
    return email.indexOf("@" + domain) > 0;
};

var validate_credit_card = function (e) {
    var t = {
        visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
        mastercard: /^5[1-5][0-9]{14}$/,
        amex: /^3[47][0-9]{13}$/,
        diners: /^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
        discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
        jcb: /^(?:2131|1800|35\d{3})\d{11}$/
    };
    for (var n in t) {
        if (t[n].test(e)) {
            return n;
        }
    }
};