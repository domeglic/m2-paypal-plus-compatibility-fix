/**
 * If a customer chooses another payment method they cannot place the order. This is because Paypal plus is always set as active
 * so the validation will fail because checkout agreements inside paypal are unchecked. There will not even be an error message.
 *
 * Solution is to use a template that correctly selects active payment method. It also always shown since the iframe will break
 * if hidden.
 */

var config = {
    'map': {
        '*': {
            'Iways_PayPalPlus/template/payment':
                'C4B_PaypalPlusCompatibilityFix/template/payment'
        }
    }
};
