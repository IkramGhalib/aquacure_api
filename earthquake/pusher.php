importScripts("https://js.pusher.com/beams/service-worker.js");
<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
<script>
  const beamsClient = new PusherPushNotifications.Client({
    instanceId: '6099415f-ba1b-4439-8d86-7ea166a745d6',
  });

  beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => console.log('Successfully registered and subscribed!'))
    .catch(console.error);
    curl -H "Content-Type: application/json" \
-H "Authorization: Bearer D5A878EB577B68B41E0660231071AB6A7B894E2715D119411582B5E0629BA901" \
-X POST "https://6099415f-ba1b-4439-8d86-7ea166a745d6.pushnotifications.pusher.com/publish_api/v1/instances/6099415f-ba1b-4439-8d86-7ea166a745d6/publishes" \
-d '{"interests":["hello"],"web":{"notification":{"title":"Hello","body":"Hello, world!"}}}'
</script>

