function ask_send() {

	var divID= document.getElementById("text-main");
	var question = document.getElementById('question_text').value
	if (question.length > 5 ) {
		divID.innerHTML+='<div class="message-wrapper reverse"><img class="message-pp" src="img/me.jpg" alt="profile-pic"><div class="message-box-wrapper"><div class="message-box">'+
          question+'</div></div></div>';
        request(question);
        document.getElementById('question_text').value = '';
	} else {
		divID.innerHTML+='<div class="message-wrapper"><img class="message-pp" src="img/ai.jpg" alt="profile-pic"><div class="message-box-wrapper"><div class="message-box">请输入详细问题，问题需超过10个字符，避免浪费资源！</div></div></div>';
	}
 			
}

function request(question) {
	$.ajax({
        type:"POST",
        url:"./api.php",
        data:{
            question:question,
            key:'yy99..',
        },
        dataType:"json",
        cache: false,
        async: false,
        success:function(s){
            if (s.status == 200) {
            	var divID= document.getElementById("text-main");
            	divID.innerHTML+='<div class="message-wrapper"><img class="message-pp" src="img/ai.jpg" alt="profile-pic"><div class="message-box-wrapper"><div class="message-box">'+s.msg+'</div></div></div>';
            } else {
            	alert(s.msg);
            }
            
        }
    });
}