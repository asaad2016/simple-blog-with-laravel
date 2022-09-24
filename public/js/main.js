/*$(".like").on("click",function() {
	var like=$(this).attr("data-like");
	var postid=$(this).attr("data-post");
	$.ajax({
		url:"/like",
		type:"POST",
		data:{like_s: like,post_id : postid ,_token: token},
		success:function(data){
			alert("ok");
		}
	});

});*/