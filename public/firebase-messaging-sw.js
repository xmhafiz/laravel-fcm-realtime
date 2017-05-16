

function getInitFirebase() {
	// Initialize the Firebase app 
	firebase.initializeApp({
		'messagingSenderId': '138073561013'
	});

	// Retrieve an instance of Firebase Messaging so that it can handle background
	// messages.
	var messaging = firebase.messaging();

	return messaging
}

if (typeof importScripts == "function") {
	importScripts('js/firebase-app.js');
	importScripts('js/firebase-messaging.js');

	var messaging = getInitFirebase()

	messaging.setBackgroundMessageHandler(function(payload) {
		console.log('[firebase-messaging-sw.js] Received background message ', payload);

		// check payload and refresh list based on 'action'
		reloadList()
	});
}
else {

	var messaging = getInitFirebase()

	// listener on message receive forground
	messaging.onMessage(function(payload) {
		console.log("Message received. ", payload);
		reloadList()
	});

	// request permission
	messaging.requestPermission()
	.then(function() {
		console.log('Notification permission granted.');
		// now get firebase instance id and save to our server
		getToken();
	})
	.catch(function(err) {
		console.log('Unable to get permission to notify.', err);
	});


	// Callback fired if Instance ID token is updated.
	messaging.onTokenRefresh(function() {
		messaging.getToken()
		.then(function(refreshedToken) {
			console.log('Token refreshed. ' + refreshedToken);
			submitToken(refreshedToken);
	})
		.catch(function(err) {
			console.log('Unable to retrieve refreshed token ', err);
		});
	});

	// get token
	function getToken() {
		messaging.getToken()
		.then(function(currentToken) {
			if (currentToken) {
				console.log('token generated ' + currentToken);
				submitToken(currentToken);
			} else {
		      // Show permission request.
		      console.log('No Instance ID token available. Request permission to generate one.');
		  }
		})
		.catch(function(err) {
			console.log('An error occurred while retrieving token. ', err);
		});
	}
}