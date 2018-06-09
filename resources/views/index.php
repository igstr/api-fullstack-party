<!DOCTYPE html>
<html>
  <head>
  </head>
  <body>
    <p>API routes:</p>
    <p>
      <ul>
        <?php $params = [ 'access_token' => $accessToken ] ?>
        <?php foreach ([ 'repo', 'issues', 'issue', 'issue_comments' ] as $route) : ?>
        <?php $link = route($route, $params ) ?>
        <li><a href="<?php echo $link ?>"><?php echo $link ?></a></li>
        <?php endforeach ?>
      </ul>
    </p>
  </body>
</html>