function saveStorageValue(id, field){
	var target = document.getElementById(id);
	var str = target.value;
	//保存数据的方法 key value map
	sessionStorage.setItem(field, str);
}

function loadStorageValue(field){
	//读取数据
	var msg = sessionStorage.getItem(field);
	// target.innerHTML = msg;
	return msg;
}


function saveStorage(id){
	var target = document.getElementById(id);
	var str = target.value;
	//保存数据的方法 key value map
	sessionStorage.setItem("message", str);
}

function loadStorage(id){
	var target = document.getElementById(id);
	//读取数据
	var msg = sessionStorage.getItem("message");
	// target.innerHTML = msg;
	return msg;
}