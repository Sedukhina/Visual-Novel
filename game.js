function LoadGame(){
	$.ajax({
        type: "get",
        url:  "/../game/get-players-game-progress.php",
		dataType: "json",
        success: function(GameProgress)
        {
            if(GameProgress != ""){
				var game = document.getElementById("Game");
    			game.style.width = window.innerWidth;
    			game.style.height = window.innerHeight;
				var gcanvas = document.getElementById("GameCanvas");
    			gcanvas.width = window.innerWidth*0.9;
    			gcanvas.height = window.innerHeight*0.7;
				var ctx = gcanvas.getContext('2d');
				ctx.clearRect(0, 0, gcanvas.width, gcanvas.height);
				if(Object.is(GameProgress["CurrentEpisode"], null)){
					LoadEpisodeMenu();
				}
				else{
					if(Object.is(GameProgress["CurrentDialogue"], "") || (Object.is(GameProgress["CurrentDialogue"], null))){
						if(!Object.is(GameProgress["CurrentLocation"], "")){
							console.log("Cue loc: ", GameProgress["CurrentLocation"])
							document.body.style.backgroundImage = "url(./content/locations/"+ GameProgress["CurrentLocation"] + ".png)";
							$.ajax({
								type: "post",
								url:  "/../game/get-available-directions.php",
								data: {CurrentLocation: GameProgress["CurrentLocation"]},
								dataType: "json",
								success: function(DirectionsArray)
								{
									LoadNavigation(DirectionsArray);
								}
							});
						}
					}
					else{
						$.ajax({
							type: "post",
							url:  "/../game/get-episode.php",
							data: {Episode_num: GameProgress["CurrentEpisode"]},
							dataType: "json",
							success: function(Episode)
							{
								let dialogue = Episode["dialogue_"+GameProgress["CurrentDialogue"]];
								let cue = dialogue["Cues_"+GameProgress["CurrentCue"]];
								LoadCues(cue['Players_Cues'], cue['Characters'], gcanvas);
							}
						});
					}
				}
			}
        }
    });
}

function LoadCues(Players_Cues, Characters, canvas){
	$('#PlayersCues').empty();
	$('#CharactersCues').empty();
	for(var Cue in Players_Cues) {
		$('#PlayersCues').append("<button class = 'textLink width100' onClick = 'NextCue("+'"'+ Players_Cues[Cue]["Next"] +'"'+ ")'>" + Players_Cues[Cue]["Cue"] + "</button>");
	}
	var ctx = canvas.getContext('2d');
	for(var Character in Characters) {
		$('#CharactersCues').append("<b><font color='orange'>" + Character +": </font></b>"+ Characters[Character]['Cue'] +"<br>");
		var CharacterImg = new Image();
		CharacterImg.src = "..//content//characters//"+Character+"//"+Characters[Character]['Emotion']+'.png';
		CharacterImg.onload = function() {
			Character_Ratio = CharacterImg.width/CharacterImg.height;
			Character_Height = canvas.height;
			Character_Width = Character_Height * Character_Ratio;
			ctx.drawImage(CharacterImg, 0, 0, Character_Width, Character_Height);
		}
	}
	document.getElementById('CharactersCues').style.display = "block";
	document.getElementById('PlayersCues').style.display = "block";
}

function NextCue(Next){
	if(Next.includes("Cues_")){
		$.ajax({
			type: "post",
			url:  "/../game/next-cue.php",
			data: {Next_Cue: Next.replace("Cues_", "")},
			success: function()
			{
				LoadGame();
			}
		})
	}
	else if(Next.includes("dialogue_")){
		document.getElementById('CharactersCues').style.display = "none";
		document.getElementById('PlayersCues').style.display = "none";
		EndDialogue(Next.replace("dialogue_", ""));
	}
	else{
		document.getElementById('CharactersCues').style.display = "none";
		document.getElementById('PlayersCues').style.display = "none";
		EndEpisode();
	}
}

function EndEpisode(){
	$.ajax({
		type: "post",
		url:  "/../game/end-episode.php",
		success: function()
		{
			LoadGame();
		}
	});
}

function EndDialogue(Next){
	$.ajax({
		type: "post",
		url:  "/../game/end-dialogue.php",
		data: {Next_Dialogue: Next},
		success: function()
		{
			LoadGame();
		}
	});
}

function LoadEpisodeMenu(){
	$.ajax({
		type: "post",
		url:  "/../game/get-episode-menu.php",
		dataType: "html",
		success: function(html)
		{
			console.log("sdfsd");
			$('#EpisodeMenu').empty();
			$('#EpisodeMenu').append(html);
			document.getElementById('EpisodeMenu').style.display = "block";
		}
	});
}

function LoadNavigation(DirectionArray){
	console.log(DirectionArray);
	if(!(Object.is(DirectionArray["ForwardLocation"], null))){
		document.getElementById('MoveForward').style.display = "block";
	}
	else{
		document.getElementById('MoveForward').style.display = "none";
	}

	if(!(Object.is(DirectionArray["BackLocation"], null))){
		document.getElementById('MoveBack').style.display = "block";
	}
	else{
		document.getElementById('MoveBack').style.display = "none";
	}

	if(!(Object.is(DirectionArray["LeftLocation"], null))){
		document.getElementById('MoveLeft').style.display = "block";
	}
	else{
		document.getElementById('MoveLeft').style.display = "none";
	}

	if(!(Object.is(DirectionArray["RightLocation"], null))){
		document.getElementById('MoveRight').style.display = "block";
	}
	else{
		document.getElementById('MoveRight').style.display = "none";
	}
}

function Move(Direction){
	$.ajax({
        type: "post",
        url:  "/../game/move.php",
		data: {Direction: Direction},
		dataType: "text",
        success: function(loc)
        {
			LoadGame();
			StartDialogueIfPosssible(loc);
			$('#user-info').load("/ajax/user-info.php");
		}          
    });
}

function StartDialogueIfPosssible(loc){
	$.ajax({
		type: "post",
		url:  "/../game/get-next-dialogue.php",
		dataType: "text",
		success: function(dialogue_id)
		{
			$.ajax({
				type: "post",
				url:  "/../game/get-dialogue-location.php",
				data: {dialogue_id: dialogue_id},
				success: function(location){
					if(!Object.is(location, loc)){
						$.ajax({
							type: "post",
							url:  "/../game/start-dialogue.php",
							data: {dialogue_id: dialogue_id},
						})
						console.log(location);
						LoadGame();
						LoadNavigation({"ForwardLocation": null, "BackLocation" : null, "RightLocation": null, "LeftLocation": null});
					}
				}
			})
		}
	})
}