export class BillClass {
    constructor(data = {}) {
        this.date_due = '';
        this.name = '';
        this.value = 0;
        this.done = false;

        Object.assign(this, data);
    }

    toJSON() {
        return {
            date_due: this.getDateDue(this.date_due),
            name: this.name,
            value: this.getValue(this.value),
            done: this.done
        }
    }

    getDateDue(date_due){
        let dateDueObject = date_due;
        if(!date_due){
            return new Date().toISOString().split('T')[0];
        }else if(!(date_due instanceof Date)) {
            dateDueObject = new Date(date_due.split('/').reverse().join('-')+"T03:00:00");
        }
        return dateDueObject.toISOString().split('T')[0];
    }

    getValue(value) {
        return value.replace(/[^0-9.]/g,'');
    }
};