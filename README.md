# m2-paypal-plus-compatibility-fix
Fixes two issues:
- on checkout success page when using https://github.com/i-ways/magento2-paypal-plus. The checkout session is closed too soon so the order number is not saved. When redirected to success page, there is no order number so the user is redirected to cart.

- In checkout paypal plus form is always set as active. Other payment methods will not work when checkout agreements are set as required.
