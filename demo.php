<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>function-text</title>
	<script src="clipboard.min.js"></script>
</head>
<body>
    <button class="btn">Copy</button>
	
    <script>
    var clipboard = new Clipboard('.btn', {
        text: function() {
            return 'to be or not to be';
        }
    });

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });

	
    </script>
</body>
</html>
