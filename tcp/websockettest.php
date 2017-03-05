<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
	var conn = new WebSocket('ws://115.71.236.157:8080/echo');
    conn.onmessage = function(e) { console.log(e.data); };
    conn.send('Hello Me!');

</script>
</head>
<body>
zzz
</body>

</html>

