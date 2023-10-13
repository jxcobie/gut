var ConveyThis_Initializer = class{

	static init(params){
		if (typeof params.api_key === 'undefined' || params.api_key.length == 0){
			alert('ConveyThis Error: Api key is not specified');
			return;
		}

		let query = 'api_key=' + params.api_key + '&referer=' + btoa(document.location.href);
		if (typeof params.is_shopify !== 'undefined') {
			query += '&is_shopify=' + params.is_shopify;
		}

		ConveyThis_Initializer.getCode('https://api-proxy.conveythis.com', query, function(response) {
			if (!response) {
				ConveyThis_Initializer.getCode('https://api.conveythis.com', query, function(response) {
					if (response.code) {
						ConveyThis_Initializer.insertCode(response.code);
					}
				});
			}else if(response.code) {
				ConveyThis_Initializer.insertCode(response.code);
			}
		}, 2000);
	}

	static getCode(endpoint, query, callback, timeout = false){
		let xhttp = new XMLHttpRequest();
		xhttp.open( 'GET', endpoint + '/25/website/code/get?'+query, true);
		if (timeout) {
			xhttp.timeout = timeout;
		}

		xhttp.onreadystatechange = function() {
			if(xhttp.readyState == 4 && xhttp.status == 200) {
				if (xhttp.responseText) {
					let response = JSON.parse(xhttp.responseText);
					callback(response);
				}
			}else if (xhttp.status === 0) {
				callback(null);
			}
		}
		xhttp.send(query);
	}

	static insertCode(code){
		let element = document.createElement('div');
		element.innerHTML = code;
		let children = element.childNodes;
		children.forEach(function(child) {
			if(child.nodeName.toUpperCase() == 'SCRIPT'){
				let tempScript = document.createElement('script');
				if(child.src){
					tempScript.src = child.src;
				}else{
					tempScript.innerHTML = child.innerHTML;
				}
				tempScript.type = 'text/javascript';
				document.body.appendChild(tempScript);
			}else{
				if(child.textContent.trim().length > 0 || child.nodeType == 1) {
					document.body.appendChild(child);
				}
			}
		});
	}

};