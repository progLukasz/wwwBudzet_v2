
<head>

	<script>
	
		$(document).ready(function() {
			
			
			$("#buttLogin").click(function() {
				var newLogin = $("#loginNew").val();
				$("#messageLogin").load("SettingsPHP.php", {
					changeLogin: newLogin
				});	
			});
			
			$("#buttEmail").click(function() {
				var newEmail = $("#emailNew").val();
				$("#messageEmail").load("SettingsPHP.php", {
					changeEmail: newEmail
				});
			});
		
			$("#buttPass").click(function() {
				var oldPass = $("#passOld").val();
				var newPass1 = $("#passNew1").val();
				var newPass2 = $("#passNew2").val();
				$("#messagePass").load("SettingsPHP.php", {
					changePassOld: oldPass,
					changePassNew1: newPass1,
					changePassNew2: newPass2
				});
			});
			
			$("#buttDel").click(function() {
				window.location.href = "DeleteAccount.php";
			});
			
		});
		
	</script>
</head>

<body>
	<div class="title"><h3>Edytuj dane profilowe</h3></div>
		<div id="setLogin" class="settings">
			<span style="margin-left: 350px;">Zmień login</span><br />
			Podaj nowy login:
			<input type="text" id="loginNew" placeholder="Login" onfocus="this.placeholder=' '" onblur="this.placeholder='Login'"/>
			<button id="buttLogin" class="buttons" style="margin-left: 100px;">Potwierdź zmianę loginu</button>
			<div id="messageLogin" class="message"></div>
		</div><br /> <br />
		<div id="setEmail" class="settings">
			<span style="margin-left: 350px;">Zmień adres email</span><br />
			Podaj nowy adres email:
			<input type="text" id="emailNew" placeholder="Adres email" onfocus="this.placeholder=' '" onblur="this.placeholder='Adres email'"/>
			<button id="buttEmail" class="buttons" style="margin-left: 40px;">Potwierdź zmianę adresu email</button>
			<div id="messageEmail" class="message"></div>
		</div><br /> <br />
		<div id="setPass" class="settings">
			<span style="margin-left: 350px;">Zmień haslo</span><br />
			Podaj stare hasło:
			<input type="password" id="passOld" placeholder="Stare Hasło" onfocus="this.placeholder=' '" onblur="this.placeholder='Stare Hasło'"/> <br /> <br />
			Podaj nowe hasło:
			<input type="password" id="passNew1" placeholder="Nowe Hasło" onfocus="this.placeholder=' '" onblur="this.placeholder='Nowe Hasło'"/> <br /> <br />
			Powtórz nowe hasło:
			<input type="password" id="passNew2" placeholder="Powtórz hasło" onfocus="this.placeholder=' '" onblur="this.placeholder='Powtórz hasło'"/>
			<button id="buttPass" class="buttons" style="margin-left: 80px;">Potwierdź zmianę hasła</button>
			<div id="messagePass" class="message"></div>
		</div><br /> <br />	
		<div id="delAccount" class="settings">
			<button id="buttDel" class="buttons" style="margin-left: 480px; ">Usuń konto</button>
		</div>
	</div>
</body>