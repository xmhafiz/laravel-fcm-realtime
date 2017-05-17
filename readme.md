## Laravel + FCM Example

This project purposely created for [Laratalk #5](https://web.facebook.com/events/1813069609012345/) on Real-time Webapp using [JavaScript Firebase Cloud Messaging API](hhttps://firebase.google.com/docs/cloud-messaging/js/client).

### Setup
- Run `composer install`
- Copy `env.example` to `.env` and add your DB details
- Migrate database `php artisan migrate`
- Go to [Firebase Console](https://console.firebase.google.com/?pli=1) and add new project
- Click on Setting icon > Project Setting > Cloud Message and copy the `Legacy server key` to be added in .env as `FIREBASE_KEY`
- Now your are ready to Go!. Take a look at route `/` for simulating Realtime Dashboard Report and `/report/submit` to add new report.

### License

This project is licensed under the [MIT license](http://opensource.org/licenses/MIT).
