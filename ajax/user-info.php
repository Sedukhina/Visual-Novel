<?php
    require_once __DIR__.'\..\boot.php';
?> 
<!DOCTYPE html>
<html>
	<head>
		<script src="/../game.js"></script>
		<script src="/../appearance.js"></script>
		<script src="/ajax/forms.js"></script>
		<div class="userForm" id="ChangeCharacterAppearance">
			<button type="button" class="closeButton" onclick="closeForm('ChangeCharacterAppearance')">x</button>
			<div class = 'row'>
				<div class = 'column'>
					<canvas id = "new-appearance" class = "appearance"></canvas>
					<label class="switch">
  						<input type="checkbox" id = "gender-switch" onchange = 'SwitchGender()'>
  						<span class="slider round"></span>
					</label>
					<span id = "gender-value"></span>
				</div>	
				<div class = 'column'>
					<box>
						<button type="button" value = Hair_Type onclick = "ShowFeatureOptions('Hair', 6)">Hair</button>
						<button type="button" value = Eyes_Type onclick = "ShowFeatureOptions('Eyes', 8)">Eyes</button>
						<button type="button" value = Brows_Type onclick = "ShowFeatureOptions('Brows', 8)">Brows</button>
						<button type="button" value = Nose_Type onclick = "ShowFeatureOptions('Nose', 6)">Nose</button>
						<button type="button" value = Mouth_Type onclick = "ShowFeatureOptions('Mouth', 10)">Mouth</button>
					</box>
				</div>
				<div id = "FeatureOptions"></div>
			</div>
			<button type="button" onclick="SaveAppearanceChanges()">Save</button>
		</div>
	</head>
    <body>
        <?php
		    //Reading users data
		    if (check_auth()) 
		    {
		    	$stmt = pdo_users()->prepare("SELECT * FROM `users` WHERE `user_id` = :user_id");
		    	$stmt->execute(['user_id' => $_SESSION['user_id']]);
		    	$user = $stmt->fetch(PDO::FETCH_ASSOC);
		    }
	    ?>
        <?php if ($user) { ?>
            <div id='user-info' class = "userInfo">
				<div>
                	<div><?=htmlspecialchars($user['Energy'])?></div>
		        	<div><?=htmlspecialchars($user['Money'])?></div>
		        	<form class="topmargin" action="\..\logout.php" method="POST">
                	<button type="submit" class = "logout">Log Out</button>
				</div>
				<canvas id = "appearance" class = "appearance" onclick = "ChangeCharacterAppearance()"></canvas>
				<script>DrawMainCharacter();</script>
                </form>
            </div>
        <?php } else { ?>
			<script>
				$('#user-info').load("/../ajax/user-admission.php");
			</script>	
		<?php } ?>
    </body>
</html>