function fz_search(){
	var fztext = $("#search_input").val();
	console.log(fztext);
	$.ajax({
		cache:true,
		type:"POST",
		url:'jsp/fz_search.jsp',
		data:"q="+fztext,
		async:false,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			localStorage.book = data;
			window.open("search_answer.html");
		}
	})
}
function kw_search(){
	var kwtext = $("#search_input").val();
	$.ajax({
		cache:true,
		type:"POST",
		url:'jsp/kw_search.jsp',
		data:"q="+kwtext,
		async:false,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			localStorage.book = data;
			window.open("search_answer.html");
		}
	})
}
function search(){
	var type = $(".select").val();
	if (type=="模糊查询")
		fz_search();
	else if (type=="关键字查询")
		kw_search();
}
