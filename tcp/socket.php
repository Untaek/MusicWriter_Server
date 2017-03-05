<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
	    function readTextFile(file) {
			var rawFile = new XMLHttpRequest();
			var allText;
	        rawFile.open("GET", file, false);
	        rawFile.onreadystatechange = function () {
			if(rawFile.readyState === 4)
        	{
				if(rawFile.status === 200 || rawFile.status == 0)
                {
	                  allText = rawFile.responseText;
                      return allText;
				}
			}
			};
			rawFile.send(null);
			return allText;
	    }
		
	var data = readTextFile("a.txt");
	//var ws = new WebSocket('ws://127.0.0.1:15151');
	var ws = new WebSocket('ws://192.168.1.37:15151');

	ws.onopen = function ()
	{
		console.log("connected");		
		setInterval(function(){ws.send(data)}, 10);
	}

	ws.onmessage = function (msg)
	{
		console.log(msg.data);
	}

	ws.onerror = function ()
	{
		console.log("error");
	}

	ws.onclose = function ()
	{
		console.log("close");
	}

</script>
</head>
<body>
zzz
</body>

</html>

