<!DOCTYPE html>
<html>
<head>
    <title>Session Info</title>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($settings['login']); ?></h1>
    <p>Theme: <?= htmlspecialchars($settings['theme']); ?></p>
    <p>Language: <?= htmlspecialchars($settings['language']); ?></p>
</body>
</html>
