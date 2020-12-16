window.onload = function(){
	var id = $.cookie("id");
	//如果用户ID为空
	if (id==""){
		$("#number").val("");
		$(":password").val("");
		$(":chechbox").attr("checked",false);
	}else{
		var password = $.cookie("password");
		$("#number").val(id);
		$(":password").val(password);
		$(":checkbox").attr("checked","checked");
	}
}
function switchToLogin(){
	$(".switchToRegister").removeClass("switch-current");
	$(".register").css("display","none");
	$(".switchToLogin").addClass("switch-current");
	$(".login").css("display","block");
}
function switchToRegister(){
	$(".switchToLogin").removeClass("switch-current");
	$(".login").css("display","none");
	$(".switchToRegister").addClass("switch-current");
	$(".register").css("display","block");
}
function login(){
	//jquery 表单提交
	console.log()
	$.ajax({
		cache:true,
		type:"POST",
		url:'jsp/login.jsp',
		data:$("#login").serialize(),
		async:false,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			console.log(data);
			if (data=="null"){
				alert("用户不存在");
				return false;
			}
			var obj = JSON.parse(data);
			var psw = $(":password").val();
			var isrmbpsw = $(":checkbox").val();
			console.log(obj[1])
			if (psw==obj[1]){
				alert("密码正确");
				if (isrmbpsw){ //勾选了记住密码
					$.cookie("id",obj[0],{expires: 7,path:'/'});
					$.cookie("password",obj[1],{expires: 7,path:'/'});
					$.cookie("username",obj[2],{expires: 7,path:'/'});
				}else{//否则清除密码
					$.removeCookie("id");
					$.removeCookie("password");
					$.removeCookie("username");
				}
				if (obj[0]!="00000000000")
					window.location.href="person.html";
				else
					window.location.href="manager.html";
			}else{
				alert("密码输入错误");
			}
		}
	})
}
function register(){
	var id = $("#register :text:eq(0)").val();
	var username = $("#register :text:eq(1)").val();
	var ps1 = $("#register :password:eq(0)").val();
	var ps2 = $("#register :password:eq(1)").val();
	//检查id是否是11位，是不是以零开头,是不是只有数字
	if (id.length!=11) {
		alert("用户ID必须是11位");
		return;
	}
	var isnum = /^\d+$/.test(id);
	if (!isnum){
		alert("用户ID中不能含有字母");
		return;
	}
	//检查密码,密码最高16位,只能由数字和字母和下划线组成
	if (ps1.length>16){
		alert("密码最高16位");
		return;
	}
	isnum = /^\d+$/.test(ps1);
	if (isnum){
		alert("密码至少由数字和字母组成");
		return;
	}
	var isahp = /^[a-z]+$/.test(ps1);
	if (isahp){
		alert("密码至少由数字和字母组成");
		return;
	}
	var isnoa = /^\w+$/.test(ps1);
	if (!isnoa){
		alert("密码只能由数字，字母，下划线组成");
		return;
	}
	if (ps1!=ps2){
		alert("两次密码不一致");
		return;
	}
	$.ajax({
		cache:true,
		type:"POST",
		url:'jsp/register.jsp',
		data:$("#register").serialize(),
		async:false,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			if (data==0){
				alert("注册成功");
				switchToLogin();
			}else if (data==1){
				var r = confirm("该用户已存在是否立即转到登录");
				if (r){
					switchToLogin();
				}
			}
		}
	})
}