$(function(){
	

	$("form").click(function(){
		var type= $("[name='type']").val();
		if(type=="Student"){
			$("#nonstudent").hide();
			$("#student").show();
			$("#student select").attr('name','category');
			$("#nonstudent select").attr('name','none');
		};
		if(type=="Non Student"){
			$("#nonstudent").show();
			$("#student").hide();
			$("#nonstudent select").attr('name','category');
			$("#student select").attr('name','none');;
		};
	});
});