if (typeof jQuery != 'undefined') { 
	$(function(){
		var logger = $("#logger").hide();
		$("button#loggerLink").click(function(){
		    logger.toggle();
			return false;
		});
	});
}
else
{
	window.onload = function(){
		var logger = document.getElementById('logger');
		logger.style.display = 'none';
		var link = document.getElementById('loggerLink');
		link.onclick = function(){
			logger.style.display = logger.style.display == 'none' ? '' : 'none';
			return false;
		};
	}
}