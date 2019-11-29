<!--<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>-->
<!--<script  src="http://code.jquery.com/jquery-latest.min.js"></script>-->
<!--<script type="text/javascript" src="https://openapi.map.naver.com/openapi/v3/maps.js?clientId=uM2XupCoWF1KRFPpHZkZ&submodules=geocoder"></script>-->
<!--<link href="/assets/toastr/toastr.min.css" media="all" rel="stylesheet" type="text/css" />-->
<!--<script src="/assets/toastr/toastr.min.js" type="text/javascript"></script>-->
<!--<script src="https://www.gstatic.com/firebasejs/5.5.2/firebase.js"></script>-->
<script src="https://www.gstatic.com/firebasejs/5.5.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.5.2/firebase-messaging.js"></script>

<div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-header">

    <!-- Header section containing title -->
    <header class="mdl-layout__header mdl-color-text--white mdl-color--light-blue-700">
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">
            <div class="mdl-layout__header-row mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--8-col-desktop">
                <h3>Firebase Cloud Messaging</h3>
            </div>
        </div>
    </header>

    <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-grid">

            <!-- Container for the Table of content -->
            <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--12-col-tablet mdl-cell--12-col-desktop">
                <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                    <!-- div to display the generated Instance ID token -->
                    <div id="token_div" style="display: none;">
                        <h4>Instance ID Token</h4>
                        <p id="token" style="word-break: break-all;"></p>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                                onclick="deleteToken()">Delete Token</button>
                    </div>
                    <!-- div to display the UI to allow the request for permission to
                         notify the user. This is shown if the app has not yet been
                         granted permission to notify. -->
                    <div id="permission_div" style="display: none;">
                        <h4>Needs Permission</h4>
                        <p id="token"></p>
                        <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored"
                                onclick="requestPermission()">Request Permission</button>
                    </div>
                    <!-- div to display messages received by this app. -->
                    <div id="messages"></div>
                </div>
            </div>

        </div>
    </main>
</div>
<script>
    // Initialize Firebase
    var config = {
        messagingSenderId: "679331386549"
    };
    firebase.initializeApp(config);


    // [START get_messaging_object]
    // Retrieve Firebase Messaging object.
    const messaging = firebase.messaging();
    // [END get_messaging_object]
    // [START set_public_vapid_key]
    // Add the public key generated from the console here.
    messaging.usePublicVapidKey('BA0nAhTJuq62_ccY-TukKOPsvym5nGO35FAB08LmesvbJYvTGCDuZgsgqqZ8rqNLCoZrzMjCIoX89ShgO71zI0k');
    // [END set_public_vapid_key]

    // IDs of divs that display Instance ID token UI or request permission UI.
    const tokenDivId = 'token_div';
    const permissionDivId = 'permission_div';

    // [START refresh_token]
    // Callback fired if Instance ID token is updated.
    messaging.onTokenRefresh(function() {
        messaging.getToken().then(function(refreshedToken) {
            console.log('Token refreshed.');
            // Indicate that the new Instance ID token has not yet been sent to the
            // app server.
            setTokenSentToServer(false);
            // Send Instance ID token to app server.
            sendTokenToServer(refreshedToken);
            // [START_EXCLUDE]
            // Display new Instance ID token and clear UI of all previous messages.
            resetUI();
            // [END_EXCLUDE]
        }).catch(function(err) {
            console.log('Unable to retrieve refreshed token ', err);
            showToken('Unable to retrieve refreshed token ', err);
        });
    });
    // [END refresh_token]

    // [START receive_message]
    // Handle incoming messages. Called when:
    // - a message is received while the app has focus
    // - the user clicks on an app notification created by a service worker
    //   `messaging.setBackgroundMessageHandler` handler.
    messaging.onMessage(function(payload) {
        console.log('Message received. ', payload);
        // [START_EXCLUDE]
        // Update the UI to include the received message.
        appendMessage(payload);
        // [END_EXCLUDE]
    });
    // [END receive_message]

    function resetUI() {
        clearMessages();
        showToken('loading...');
        // [START get_token]
        // Get Instance ID token. Initially this makes a network call, once retrieved
        // subsequent calls to getToken will return from cache.
        messaging.getToken().then(function(currentToken) {
            if (currentToken) {
                sendTokenToServer(currentToken);
                updateUIForPushEnabled(currentToken);
            } else {
                // Show permission request.
                console.log('No Instance ID token available. Request permission to generate one.');
                // Show permission UI.
                updateUIForPushPermissionRequired();
                setTokenSentToServer(false);
            }
        }).catch(function(err) {
            console.log('An error occurred while retrieving token. ', err);
            showToken('Error retrieving Instance ID token. ', err);
            setTokenSentToServer(false);
        });
        // [END get_token]
    }


    function showToken(currentToken) {
        // Show token in console and UI.
        var tokenElement = document.querySelector('#token');
        tokenElement.textContent = currentToken;
    }

    // Send the Instance ID token your application server, so that it can:
    // - send messages back to this app
    // - subscribe/unsubscribe the token from topics
    function sendTokenToServer(currentToken) {
        if (!isTokenSentToServer()) {
            console.log('Sending token to server...');
            // TODO(developer): Send the current token to your server.
            setTokenSentToServer(true);
        } else {
            console.log('Token already sent to server so won\'t send it again ' +
                'unless it changes');
        }

    }

    function isTokenSentToServer() {
        return window.localStorage.getItem('sentToServer') === '1';
    }

    function setTokenSentToServer(sent) {
        window.localStorage.setItem('sentToServer', sent ? '1' : '0');
    }

    function showHideDiv(divId, show) {
        const div = document.querySelector('#' + divId);
        if (show) {
            div.style = 'display: visible';
        } else {
            div.style = 'display: none';
        }
    }

    function requestPermission() {
        console.log('Requesting permission...');
        // [START request_permission]
        messaging.requestPermission().then(function() {
            console.log('Notification permission granted.');
            // TODO(developer): Retrieve an Instance ID token for use with FCM.
            // [START_EXCLUDE]
            // In many cases once an app has been granted notification permission, it
            // should update its UI reflecting this.
            resetUI();
            // [END_EXCLUDE]
        }).catch(function(err) {
            console.log('Unable to get permission to notify.', err);
        });
        // [END request_permission]
    }

    function deleteToken() {
        // Delete Instance ID token.
        // [START delete_token]
        messaging.getToken().then(function(currentToken) {
            messaging.deleteToken(currentToken).then(function() {
                console.log('Token deleted.');
                setTokenSentToServer(false);
                // [START_EXCLUDE]
                // Once token is deleted update UI.
                resetUI();
                // [END_EXCLUDE]
            }).catch(function(err) {
                console.log('Unable to delete token. ', err);
            });
            // [END delete_token]
        }).catch(function(err) {
            console.log('Error retrieving Instance ID token. ', err);
            showToken('Error retrieving Instance ID token. ', err);
        });

    }

    // Add a message to the messages element.
    function appendMessage(payload) {
        const messagesElement = document.querySelector('#messages');
        const dataHeaderELement = document.createElement('h5');
        const dataElement = document.createElement('pre');
        dataElement.style = 'overflow-x:hidden;';
        dataHeaderELement.textContent = 'Received message:';
        dataElement.textContent = JSON.stringify(payload, null, 2);
        messagesElement.appendChild(dataHeaderELement);
        messagesElement.appendChild(dataElement);
    }

    // Clear the messages element of all children.
    function clearMessages() {
        const messagesElement = document.querySelector('#messages');
        while (messagesElement.hasChildNodes()) {
            messagesElement.removeChild(messagesElement.lastChild);
        }
    }

    function updateUIForPushEnabled(currentToken) {
        showHideDiv(tokenDivId, true);
        showHideDiv(permissionDivId, false);
        showToken(currentToken);
    }

    function updateUIForPushPermissionRequired() {
        showHideDiv(tokenDivId, false);
        showHideDiv(permissionDivId, true);
    }

    resetUI();
</script>
