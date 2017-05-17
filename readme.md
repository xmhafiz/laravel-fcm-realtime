## Laravel + FCM Example

This project purposely created for [Laratalk #5](https://web.facebook.com/events/1813069609012345/) on Real-time Webapp using [JavaScript Firebase Cloud Messaging API](hhttps://firebase.google.com/docs/cloud-messaging/js/client). Refer the [Preseentation here](http://bit.ly/laratalks5-realtime-app)

It is basically a simple report monitoring with maps. So, user will submit the report and the page will autmatically updated.

### Requirement
- PHP 5.6.4+ for Laravel 5.4
- WebPush API only working on Chrome: 50+, Firefox: 44+, Opera Mobile: 37+ (supports [Service worker](https://developers.google.com/web/fundamentals/getting-started/primers/service-workers#you_need_https))

### Setup
- Run `composer install`
- Copy `env.example` to `.env` and add your DB details
- Migrate database `php artisan migrate`
- Go to [Firebase Console](https://console.firebase.google.com/?pli=1) and add new project
- Click on Setting icon > Project Setting > Cloud Message and copy the `Legacy server key` to be added in .env as `FIREBASE_KEY`. Also update `messagingSenderId` in `public/firebase-messaging-sw.js`
- Now you are ready to Go!. Take a look at route `/` for simulating Realtime Dashboard Report and `/report/submit` to add new report.

## Todo
- Js code refactor
- Implement tests

### License
This project is licensed under the [MIT license](http://opensource.org/licenses/MIT).
