$("#insert_form").on("submit",function(e){
		e.preventDefault();
		var name=$("#name").val();
		var email=$("#email").val();
		var password=$("#password").val();
		var pic=$("#pic").val();
		var namecheck=/^[A-Za-z. ]{3,20}$/;
		var emailcheck=/^[A-Za-z_.0-9]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;
		var passwordcheck=/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;	
		var imgcheck=/^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.png)$/;
		if(namecheck.test(name))
		{
			// return true;
		}
		else
		{
			$("#err_name").show();
			$("#err_name").html("**Wrong Name");
			// return false;
		}

		if(emailcheck.test(email))
		{
			// return true;
		}
		else
		{
			$("#err_email").show();
			$("#err_email").html("**Wrong email");
			// return false;
		}

		if(passwordcheck.test(password))
		{
			// return true;
		}
		else
		{
			$("#err_password").show();
			$("#err_password").html("**Wrong Password");
			// return false;
		}

		if(imgcheck.test(pic))
		{
			// return true;
		}
		else
		{
			$("#err_image").show();
			$("#err_image").html("**Wrong File");
			// return false;
		}

		if((namecheck.test(name)) && (emailcheck.test(email)) && (passwordcheck.test(password)) )
		{
			var url=BASE_URL+'Home/insert';
			$.ajax({
				url : url,
				method: 'POST',
				data: new FormData(this),
				contentType:false,
				cache:false,
				processData:false,
				success:function(data)
				{
					alert('Success');
				}
			});
		}
		else
		{
			alert("All Field required");
		}
	});
