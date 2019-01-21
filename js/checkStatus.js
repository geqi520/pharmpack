function checkStatus(){
    $.ajax({
		url: "../php/checkStatus.php",
		type: "GET",
		dataType: 'json',
		success: function(result){
			if(!result.type){
				alert(result.msg);
				window.location.href='../index.html';
			}else {
				document.getElementById('admin').innerHTML = result.name;
			}
		}
	});
}