Vue.filter('statusGeneralPay', (value) => {
    if(value === false){
        return "No bill registered";
    }

    if(!value){
        return "No bill to pay";
    }else{
        return (value > 1) ? "There are "+value+" bills to pay" : "There is "+value+" bill to pay";
    }
});

Vue.filter('statusGeneralReceive', (value) => {
    if(value === false){
        return "No bill registered";
    }

    if(!value){
        return "No bill to receive";
    }else{
        return (value > 1) ? "There are "+value+" bills to receive" : "There is "+value+" bill to receive";
    }
});

Vue.filter('numberFormat', {
    read(value, locale) {
        let number = 0;
        if(value && typeof value !== 'undefined') {
            let numberRegex = value.toString().match(/\d+(\.{1}\d{1,2}){0,1}/g)
            number = numberRegex ? numberRegex[0] : 0;
        }
        return new Intl.NumberFormat(locale, {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
            style: 'currency',
            currency: 'BRL'
        }).format(number);
    },
    write(value) {
        let number = 0;
        if(value.length > 0) {
            number = value.replace(/[^\d\,]/g, '')
                          .replace(/\,/g, '.');
            number = isNaN(number) ? 0 : parseFloat(number);
        }
        return number;
    }
});

Vue.filter('dateFormat', {
    read(value, locale) {
        if(value && typeof value !== 'undefined') {
            if(!(value instanceof Date)){
                let dateRegex = value.match(/\d{4}\-\d{2}\-\d{2}/g);
                let dateString = dateRegex ? dateRegex[0] : dateRegex;
                if(dateString) {
                    value = new Date(dateString+"T03:00:00");
                }else {
                    return value;
                }
            }
            return new Intl.DateTimeFormat(locale).format(value).split(' ')[0];
        }
        return value;
    },
    write(value) {
        let dateRegex = value.match(/\d{2}\/\d{2}\/\d{4}/g);
        if(dateRegex) {
            let dateString = dateRegex[0];
            let date = new Date(dateString.split('/').reverse().join('-')+"T03:00:00");
            if(!isNaN(date.getTime())){
                return date;
            }
        }
        return value;
    }
});

Vue.filter('stringUpperLowerCase', {
    read(value) {
        if(value && typeof value !== 'undefined') {
            return value.toUpperCase();
        }
        return value;
    },
    write(value) {
        return value.toLowerCase();
    }
});