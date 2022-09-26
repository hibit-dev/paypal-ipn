# Paypal IPN: Instant Payment Notification
Instant Payment Notification (IPN) is a message service that notifies you of events related to PayPal transactions. You can use IPN messages to automate back-office and administrative functions, such as fulfilling orders, tracking customers or providing status and other transaction-related information.  
The IPN service triggers a notification when an event occurs that pertains to a transaction. Typically, these events represent various kinds of payments; however, the events may also represent authorizations, Fraud Management Filter actions and other actions, such as refunds, disputes and chargebacks. The notifications are sent to a listener page on your server which receives the messages and performs backend processing based on the message content.  

└ src  
&nbsp;&nbsp;&nbsp;&nbsp;├ Button  
&nbsp;&nbsp;&nbsp;&nbsp;└ Php  
  

## Documentation
You'll find instructions and full documentation on [HiBit](https://www.hibit.dev/posts/68/paypal-ipn-instant-payment-notification). It includes step-by-step guide on how to use the code.

## Credits
- [PayPal API documentation](https://developer.paypal.com/docs/api/orders/v2/#orders-create-request-body)
- [PayPal IPN and PDT variables](https://developer.paypal.com/api/nvp-soap/ipn/IPNandPDTVariables)

## Security
If you discover any security related issues, please email security@hibit.dev instead of using the issue tracker.

## About HiBit
HiBit is a platform made by and for enthusiasts of the IT world. [On our website](https://www.hibit.dev) you can read and comment on technical articles, tutorials, news ... and everything that may interest you in the computing world.

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
