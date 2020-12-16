$(function(){
	jQuery(".slideBox").slide({mainCell:".bd ul",effect:"leftLoop",autoPlay:true});
	
	
	jQuery(".picScroll-left").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"leftLoop",autoPlay:true,vis:4});
});


function test1()
{
	var tempStr=document.getElementById('test').value;
	if(tempStr=="*请您详细描述上述需求或建议：")
	{
		document.getElementById('test').value="";
	}
}
function test2()
{
	var tempStr=document.getElementById('test').value;
	if(tempStr=="")
	{
		document.getElementById('test').value="*请您详细描述上述需求或建议：";
	}
}




































