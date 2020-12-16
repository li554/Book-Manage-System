window.onload = function(){
	filter();
}
function filter(){
	var filter_book = $("#manager-nav header input:eq(1)").val();
	var filter_user = $("#manager-nav header input:eq(0)").val();
	var filter_type = $("#manager-nav header select:eq(0)").val();
	if (filter_user=="") 
		filter_user = "%";
	if (filter_book=="")
		filter_book = "%";
	var mode = $("#manager-nav header select:eq(1)").val();
	$.ajax({
		url:"jsp/m_borrow_log.jsp",
		method:"post",
		data:"id="+filter_user+"&ISBN="+filter_book+"&mode="+mode+"&type="+filter_type,
		error:function(err){
			console.log(err);
		},
		success:function(data){
			console.log(data);
			$("#manager-nav section").html(data);
		}
	})
}