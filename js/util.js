function get(apiFileName,param,cb){
	var url = 'http://www.xtzero.me/eatwhat/api/'+apiFileName+'.php?uselessparam=useless';
	for(var i in param){
		url += '&'+i+'='+param[i];
	}
	var xhr = new XMLHttpRequest();
	xhr.open("get", url, true);
	xhr.onload = function(res){
		cb && cb(JSON.parse(res.currentTarget.response),res);
	}
	
	xhr.onerror = function(res){
		cb && cb(res);
	};
	
	xhr.send();
}

function post(url,data,cb){
	var form = new FormData();
	for(var i in data){
		form.append(i,data[i]);
	}
	
	var xhr = new XMLHttpRequest();
	
	xhr.open("post", url, true);
	xhr.onload = function(res){
		cb && cb(res.currentTarget.response,res);
	}
	
	xhr.onerror = function(res){
		cb && cb(res);
	};
	
	xhr.send(form);
}

function setCookie(name,value){
	var Days = 30;
	var exp = new Date();
	exp.setTime(exp.getTime() + Days*24*60*60*1000);
	document.cookie = name + "="+ escape (value) + ";expires=" + exp.toGMTString();
}

function getCookie(name){
	var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	if(arr=document.cookie.match(reg))
	return unescape(arr[2]);
	else
	return null;
}

function param(par){
    //获取当前URL
    var local_url = document.location.href; 
    //获取要取得的get参数位置
    var get = local_url.indexOf(par +"=");
    if(get == -1){
        return false;   
    }   
    //截取字符串
    var get_par = local_url.slice(par.length + get + 1);    
    //判断截取后的字符串是否还有其他get参数
    var nextPar = get_par.indexOf("&");
    if(nextPar != -1){
        get_par = get_par.slice(0, nextPar);
    }
    return get_par;
}