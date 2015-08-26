$(document).ready(function() { 
 
		$('#submit').click(function() {  
 
			$(".errorTip").hide();
			var hasError = false;
 
		});
	});
	
	
	$(document).ready(function() { 
 
    $('#submit').click(function() {  
 
        $(".errorTip").hide();
        var hasError = false;
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
 
        var emailaddressVal = $("#email_input").val();
        if(emailaddressVal == '') {  	
			$(".field").first().after('<div class="errorTip"><span class="error">請輸入E-mail地址</span><div>');
            hasError = true;        }
 
        else if(!emailReg.test(emailaddressVal)) {			
            $(".field").first().after('<div class="errorTip"><span class="error">請輸入正確的E-mail地址</span><div>');			
            hasError = true;
        }
 
        if(hasError == true) { return false; }
 
    });
});