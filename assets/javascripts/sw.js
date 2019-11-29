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

/* eslint-env browser, serviceworker, es6 */

'use strict';


self.addEventListener('push', function(event) {
  console.log('[Service Worker] Push Received.');
  console.log(`[Service Worker] Push had this data: "${event.data.text()}"`);
  console.log(event);
  const txt = event.data.text();
  const arr = txt.split('^!^');
  var d = new Date();
  var n = d.getHours()+d.getMinutes()+d.getSeconds()+d.getMilliseconds();
  const title = '[우리가 알림!!]';
  const options = {
    body: arr[0],
    icon: '/assets/images/icon.png',
    badge: '/assets/images/badge.png',
    tag: 'tag',
    // display: "standalone",
    data: arr[1]
  };

  // const title = '[우리가 알림!!]';
  // const options = {
  //   body: arr[0],
  //   icon: '/assets/images/icon.png',
  //   badge: '/assets/images/badge.png',
  //   timestamp: 36037080000000,
  //   vibrate: [200, 100, 200, 100, 200, 100, 400],
  //   display: "standalone",
  //   action: 'reply',
  //
  //   data: arr[1]
  // };

  event.waitUntil(self.registration.showNotification(title, options));
});


self.addEventListener('notificationclick', function(event) {
  console.log('[Service Worker] Notification click Received.');
  const txt = event.notification.data;

  console.log(txt);
  const url = txt;
  event.notification.close();
  event.waitUntil(
      clients.openWindow(url)
  );
});

self.addEventListener('pushsubscriptionchange', function(event) {
  console.log('[Service Worker]: \'pushsubscriptionchange\' event fired.');
  const applicationServerKey = urlB64ToUint8Array(applicationServerPublicKey);
  event.waitUntil(
      self.registration.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey: applicationServerKey
      })
          .then(function(newSubscription) {
            // TODO: Send to application server
            console.log('[Service Worker] New subscription: ', newSubscription);
          })
  );
});
