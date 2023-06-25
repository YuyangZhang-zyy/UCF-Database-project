function alertThenReload(msg) 
{
	alert(msg);
	window.location.reload(false);
}

function acceptEventAjax(eid)
{
	ajax = $.ajax({
			url: 'includes/pendingevents-includes.php',
			type: 'POST',
			data: {method: "acceptEvent", eid: eid},
			dataType: 'json',
			success: function(data)
			{
				if (data.status === 'ok')
					alertThenReload("Event accepted.");
				else 
				{
					var errorMessage = data.statusText;
					alertThenReload('Error - ' + errorMessage);
				}
			}
		});
	return;
}

function denyEventAjax(eid)
{
	ajax = $.ajax({
			url: 'includes/pendingevents-includes.php',
			type: 'POST',
			data: {method: "denyEvent", eid: eid},
			dataType: 'json',
			success: function(data)
			{
				if (data.status === 'ok')
					alertThenReload("Event denied.");
				else 
				{
					var errorMessage = data.statusText;
					alertThenReload('Error - ' + errorMessage);
				}
			}
		});
	return;
}

function acceptEvent(eventid)
{
	eid = JSON.stringify(eventid);
	acceptEventAjax(eid);
}

function denyEvent(eventid)
{
	eid = JSON.stringify(eventid);
	denyEventAjax(eid);
}