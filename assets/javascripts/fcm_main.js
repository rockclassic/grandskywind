/*
*
*  Push Notifications codelab
*  Copyright 2015 Google Inc. All rights reserved.
*
*  Licensed under the Apache License, Version 2.0 (the "License");
*  you may not use this file except in compliance with the License.
*  You may obtain a copy of the License at
*
*      https://www.apache.org/licenses/LICENSE-2.0
*
*  Unless required by applicable law or agreed to in writing, software
*  distributed under the License is distributed on an "AS IS" BASIS,
*  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
*  See the License for the specific language governing permissions and
*  limitations under the License
*
*/

/* eslint-env browser, es6 */

'use strict';

// const applicationServerPublicKey = 'BI5MrngKqqRnJptRzmKWkykrQuoGkX-6Mba44e82MIzrXAADDrIsbKDmpzM-6Prz1h0DRtQtGR824zsuAsSIJLM';
const applicationServerPublicKey = 'AAAAnitOVLU:APA91bFVcX24vNdo2wmV5ye-7NbirM_J-B93obfkxUe3fxzU9NhH1lSMSNh59--45GdVgVYFZv3W-cr67rgteWGp29jluSeRYoOWUXx5LzsY_w-O0wKzd5MTlCbMsK62FSbyN7kYHzva';

const pushButton = document.querySelector('.js-push-btn');

let isSubscribed = false;
let swRegistration = null;

function urlB64ToUint8Array(base64String) {
  const padding = '='.repeat((4 - base64String.length % 4) % 4);
  const base64 = (base64String + padding)
      .replace(/\-/g, '+')
      .replace(/_/g, '/');

  const rawData = window.atob(base64);
  const outputArray = new Uint8Array(rawData.length);

  for (let i = 0; i < rawData.length; ++i) {
    outputArray[i] = rawData.charCodeAt(i);
  }
  return outputArray;
}

function updateBtn() {
  if (Notification.permission === 'denied') {
    pushButton.textContent = 'Push Messaging Blocked.';
    pushButton.disabled = true;
    updateSubscriptionOnServer(null);
    return;
  }

  if (isSubscribed) {
    pushButton.textContent = 'Disable Push Messaging';
  } else {
    pushButton.textContent = 'Enable Push Messaging';
  }

  pushButton.disabled = false;
}

function updateSubscriptionOnServer(subscription) {
  // TODO: Send subscription to application server

  const subscriptionJson = document.querySelector('.js-subscription-json');
  const subscriptionDetails =
      document.querySelector('.js-subscription-details');

  if (subscription) {
    subscriptionJson.textContent = JSON.stringify(subscription);
    subscriptionDetails.classList.remove('is-invisible');
  } else {
    subscriptionDetails.classList.add('is-invisible');
  }
}

function subscribeUser() {
  const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
  swRegistration.pushManager.subscribe({
    userVisibleOnly: true,
    applicationServerKey: applicationServerKey
  })
      .then(function(subscription) {
        console.log('User is subscribed.');
        console.log('subscription===>');
        console.log(subscription);

        // 업데이트 해야 함...(로그인시 변경)
        updateSubscriptionOnServer(subscription);

        isSubscribed = true;

        updateBtn();
      })
      .catch(function(err) {
        console.log('Failed to subscribe the user: ', err);
        updateBtn();
      });
}

function unsubscribeUser() {
  swRegistration.pushManager.getSubscription()
      .then(function(subscription) {
        if (subscription) {
          return subscription.unsubscribe();
        }
      })
      .catch(function(error) {
        console.log('Error unsubscribing', error);
      })
      .then(function() {
        updateSubscriptionOnServer(null);

        console.log('User is unsubscribed.');
        isSubscribed = false;

        updateBtn();
      });
}

function initializeUI() {
  pushButton.addEventListener('click', function() {
    pushButton.disabled = true;
    console.log("#1");
    if (isSubscribed) {
        console.log("#2");
      unsubscribeUser();
    } else {
        console.log("#3");
      subscribeUser();
    }
  });

  // Set the initial subscription value
  swRegistration.pushManager.getSubscription()
      .then(function(subscription) {
        isSubscribed = !(subscription === null);
        updateSubscriptionOnServer(subscription);

        if (isSubscribed) {
          console.log('User IS subscribed.');
        } else {
          console.log('User is NOT subscribed.');
        }

        updateBtn();
      });
}


if (!('serviceWorker' in navigator)) {
    console.log(' Service Worker isn`t supported on this browser, disable or hide UI.');
}

if (!('PushManager' in window)) {
    console.log(' Push isn`t supported on this browser, disable or hide UI.');

}


if ('serviceWorker' in navigator && 'PushManager' in window) {
  console.log('Service Worker and Push is supported');

  navigator.serviceWorker.register('/assets/javascripts/sw.js')
      .then(function(swReg) {
        console.log('Service Worker is registered##', swReg);

        swRegistration = swReg;
        initializeUI();
      })
      .catch(function(error) {
        console.log('Service Worker Error', error);
      });
} else {
  console.log('Push messaging is not supported');
  pushButton.textContent = 'Push Not Supported';
}