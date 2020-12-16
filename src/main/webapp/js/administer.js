function borrow_book(){
	var isbn = $(".nav li:eq(3) a input").val();
	if (isbn==""){
		alert("ISBN不能为空");
		return;
	}
	$.ajax({
		cache:true,
		type:"POST",
		url:'jsp/borrow_book.jsp',
		data:"isbn="+isbn,
		async:false,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			alert(data);
			window.open("jsp/borrow_log.jsp");
		}
	})
}
function return_book(){
	var isbn = $(".nav li:eq(3) a input").val();
	if (isbn==""){
		alert("ISBN不能为空");
		return;
	}
	$.ajax({
		cache:true,
		type:"POST",
		url:'jsp/return_book.jsp',
		data:"isbn="+isbn,
		async:false,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			alert(data);
			window.open("jsp/borrow_log.jsp");
		}
	})
}
