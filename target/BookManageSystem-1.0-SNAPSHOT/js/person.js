window.onload = function(){
	$(".nav li:eq(2) a").click(function(){
		$.ajax({
			cache:true,
			type:"GET",
			url:'jsp/show_self.jsp',
			async:false,
			error:function(err){
				console.log(err);
			},
			success:function(data){
				var obj = $.parseJSON(data);
				$(".self_info div:eq(0)").text("账号："+obj[0]);
				$(".self_info div:eq(1)").text("昵称："+obj[2]);
				$("#change_self input[type='text']").val(obj[2]);
				$(".self_info div:eq(2)").text("剩余可借数目："+obj[3]);
			}
		})
		$(".self_info").css("display","flex");
		$(".self_info").mouseleave(function(){
			$(".self_info").hide(500);
		})
	})
	$(".nav li:eq(3) a").click(function(){
		$("#change_self").css("display","flex");
		$(".close_self").click(function(){
			$("#change_self").hide(500);
		})
	})
	$(".nav li:eq(4) a").click(function(){
		$("#change_ps").css("display","flex");
		$(".close_ps").click(function(){
			$("#change_ps").hide(500);
		})
	})
}
function change_self(){
	console.log($("#change_self input[type='text']").val());
	$.ajax({
		cache:true,
		type:"POST",
		url:'jsp/change_self.jsp',
		data:"name="+$("#change_self input[type='text']").val(),
		async:false,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			alert(data);
			$.cookie("username",$("#change_self input[type='text']").val(),{expires:7,path:'/'});
		}
	})
}
function change_myps(){
	var old_ps = $("#change_ps :password:eq(0)").val();
	if (old_ps!=$.cookie("password")){
		alert("原密码输入错误");
		return;	
	}
	var ps1 = $("#change_ps :password:eq(1)").val();
	var ps2 = $("#change_ps :password:eq(2)").val();
	if (ps1.length>16){
		alert("密码最高16位");
		return;
	}
	var isnum = /^\d+$/.test(ps1);
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
	var postdata = "id="+$.cookie("id")+"&new_ps="+ps1;
	console.log(postdata);
	$.ajax({
		cache:true,
		type:"POST",
		url:"jsp/change_ps.jsp",
		data:postdata,
		async:false,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			$.cookie("password",ps1,{expires:7,path:'/'});
			alert(data);
			$("#change_ps").hide(500);
			$("#change_ps :password:eq(0)").val("");
			$("#change_ps :password:eq(1)").val("");
			$("#change_ps :password:eq(2)").val("");
		}
	})
}