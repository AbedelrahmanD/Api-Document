var telSeparator = "-";
var telLength = 11;
var telCountryCode = "961";

var formRules = {
    text: function (value, element = null) {
        return value.trim() != "";
    },
    email: function (value, element = null) {
        return validator.isEmail(value);
    },
    number: function (value, element = null) {
        return validator.isNumeric(value);
    },
    alpha: function (value, element = null) {
        return validator.isAlpha(value);
    },
    password: function (value, element = null) {
        return validator.isStrongPassword(value, {
            minLength: 8,
            minLowercase: 1,
            minUppercase: 1,
            minNumbers: 1,
            minSymbols: 0,
            returnScore: false,
            pointsPerUnique: 1,
            pointsPerRepeat: 0.5,
            pointsForContainingLower: 10,
            pointsForContainingUpper: 10,
            pointsForContainingNumber: 10,
            pointsForContainingSymbol: 10
        });
    },
    checkbox: function (value, element = null) {
        return value == 1;
    },
    radio: function (value, element = null) {
        return value == 1;
    },
    url: function (value, element = null) {
        return validator.isURL(value);
    },
    json: function (value, element = null) {
        return validator.isJSON(value);
    },
    ip: function (value, element = null) {
        return validator.isIP(value);
    },
    date: function (value, element = null) {
        return validator.isDate(value);
    },
    base64: function (value, element = null) {
        return validator.isBase64(value);
    },
    tel: function (value, element = null) {

        if (value == "") {
            return true;
        }
        if (value.includes(telSeparator) && value.length == telLength) {
            value += " ";
        }
        value = value.replace(telSeparator, "");

        let valuetelCountryCode = value.substring(0, telCountryCode.length);
        return valuetelCountryCode == telCountryCode && telLength == value.length;
    }
};






let telInputs = document.querySelectorAll("[data-type=tel]")


function onFocusOutTel(el) {
    let value = el.value;

    if (!formRules["tel"](value, el) || value == "") {
        return;
    }
    if (!value.includes(telSeparator)) {
        el.value = value.substr(0, telCountryCode.length) + telSeparator + parseInt(value.substr(telCountryCode.length));
    }
}

function onFocusInTel(el) {
    let value = el.value;
    let telParts = value.split(telSeparator);
    if (telParts.length < 2) {
        return;
    }
    let telCountryCode = telParts[0];
    let phoneNumber = telParts[1];
    if (telLength != (telCountryCode.length + phoneNumber.length)) {
        phoneNumber = `0${phoneNumber}`;
    }
    el.value = telCountryCode + phoneNumber;
}
telInputs.forEach(el => {
    onFocusOutTel(el);
    el.addEventListener('focusout', () => {
        onFocusOutTel(el);
    });

    el.addEventListener('focusin', () => {
        onFocusInTel(el);
    });


})