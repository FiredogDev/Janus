define([
], function (_, _c, $, current_page_class){

    Function.prototype.throttle = function (milliseconds, context) {
        var baseFunction = this,
            lastEventTimestamp = null,
            limit = milliseconds;

        return function () {
            var self = context || this,
                args = arguments,
                now = Date.now();

            if (!lastEventTimestamp || now - lastEventTimestamp >= limit) {
                lastEventTimestamp = now;
                baseFunction.apply(self, args);
            }
        };
    };

});