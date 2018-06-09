<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <p>
      <a href="https://github.com/login/oauth/authorize?scope=user:email&client_id=<?php echo $clientId ?>&redirect_uri=<?php echo $redirectUri ?>">Login with Github</a></a>
    </p>
    <p>
      If that link doesn't work, you can provide your own Client ID and Client secret in .env settings file.<br>
      <a href="https://developer.github.com/apps/building-oauth-apps/creating-an-oauth-app/">https://developer.github.com/apps/building-oauth-apps/creating-an-oauth-app/</a>
    </p>
  </body>
</html>
