//Only used when changing character appearance!!!
var CharacterAppearance;

function DrawMainCharacter(){
	$.ajax({
        type: "get",
        url:  "/../game/user-character.php",
        context: $(".appearance"),
        dataType: "json",
        success: function(json)
        {
			CharacterAppearance = json;
            DrawMainCharacterFromJSON("appearance", json);
        }
    });
}

function DrawMainCharacterFromJSON(elem_id, json){
	var canvas = document.getElementById(elem_id);

	DrawFace(json['Gender'], json['Hair_Type'], canvas, function() {
		DrawFeatures(canvas, json);
	});	
	
}

function DrawFace(gender, hair_type, canvas, callback){
	var ctx = canvas.getContext('2d');
	ctx.clearRect(0, 0, canvas.width, canvas.height);
	var Face = new Image();
	Face.src = "..//content//appearance//Hair//"+gender+"_"+hair_type+".png";
	Face.onload = function() {
			Face_Ratio = Face.width/Face.height;
			Face_Height = canvas.height;
			Face_Width = canvas.width*Face_Ratio;
			ctx.drawImage(Face, 0, 0, Face_Width, Face_Height);
	};
	callback();
}

function DrawFeatures(canvas, json){
	var ctx = canvas.getContext('2d');
	var Brows = new Image();
	Brows.src = "..//content//appearance//Brows//"+json['Brows_Type']+'.png';
	Brows.onload = function() {
		Brows_Ratio = Brows.height/Brows.width;
		Brows_Width = canvas.width/2.2;
		Brows_Height = (canvas.height/2.2)*Brows_Ratio;
		if(Object.is(json['Gender'], "Female")){
			ctx.drawImage(Brows, (canvas.width)/3.7, (canvas.height)/2.6, Brows_Width, Brows_Height);
		}
		else{
			ctx.drawImage(Brows, (canvas.width)/3.65, (canvas.height)/3, Brows_Width, Brows_Height);
		}
	};

	var Eyes = new Image();
	Eyes.src = "..//content//appearance//Eyes//"+json['Eyes_Type']+'.png';
	Eyes.onload = function() {
		Eyes_Ratio = Eyes.height/Eyes.width;
		Eyes_Width = canvas.width/2.4;
		Eyes_Height = (canvas.height/2.4)*Eyes_Ratio;
		if(Object.is(json['Gender'], "Female")){
			ctx.drawImage(Eyes, (canvas.width)/3.4, (canvas.height)/2.2, Eyes_Width , Eyes_Height);
		}
		else{
			ctx.drawImage(Eyes, (canvas.width)/3.45, (canvas.height)/2.5, Eyes_Width , Eyes_Height);
		}
	};

	var Mouth = new Image();
	Mouth.src = "..//content//appearance//Mouth//"+json['Mouth_Type']+'.png';
	Mouth.onload = function() {
		if(Object.is(json['Gender'], "Female")){
			Mouth_Ratio = Mouth.height/Mouth.width;
			Mouth_Width = canvas.width/5;
			Mouth_Height = (canvas.height/5)*Mouth_Ratio;
			ctx.drawImage(Mouth, (canvas.width)/2.5, (canvas.height)/1.55, Mouth_Width , Mouth_Height);
		}
		else{
			Mouth_Ratio = Mouth.height/Mouth.width;
			Mouth_Width = canvas.width/4.5;
			Mouth_Height = (canvas.height/4.5)*Mouth_Ratio;
			ctx.drawImage(Mouth, (canvas.width)/2.55, (canvas.height)/1.65, Mouth_Width , Mouth_Height);
		}
	};

	var Nose = new Image();
	Nose.src = "..//content//appearance//Nose//"+json['Nose_Type']+'.png';
	Nose.onload = function() {
		Nose_Ratio = Nose.height/Nose.width;
		if(Object.is(json['Gender'], "Female")){
			Nose_Width = canvas.width/11;
			Nose_Height = (canvas.height/11)*Nose_Ratio;
			ctx.drawImage(Nose, (canvas.width)/2.2, (canvas.height)/1.75, Nose_Width , Nose_Height);
		}
		else{
			Nose_Width = canvas.width/9;
			Nose_Height = (canvas.height/9)*Nose_Ratio;
			ctx.drawImage(Nose, (canvas.width)/2.25, (canvas.height)/1.95, Nose_Width , Nose_Height);
		}		
	};
}

//Opens Character Appearance Form
function ChangeCharacterAppearance(){
	if(Object.is(CharacterAppearance['Gender'], "Male")){
		document.getElementById("gender-switch").checked = true;
	}
	document.getElementById("gender-value").textContent = CharacterAppearance['Gender'];
	openForm('ChangeCharacterAppearance');
	DrawMainCharacterFromJSON('new-appearance', CharacterAppearance);
}

function ChangeCharacterFeature(feature, feature_id){
	feature_full = feature+"_Type";
	CharacterAppearance[feature_full] = feature_id;
	closeForm('ChangeCharacterAppearance');
	ChangeCharacterAppearance();
}

function SwitchGender(){
	if(Object.is(CharacterAppearance['Gender'], "Male")){
		CharacterAppearance['Gender'] = 'Female';
	}
	else{
		CharacterAppearance['Gender'] = 'Male';
	}
	closeForm('ChangeCharacterAppearance');
	ChangeCharacterAppearance();
}

function SaveAppearanceChanges(){
	$.ajax({
        type: "post",
        url:  "/../game/change-appearance.php",
        context: $(".appearance"),
		data: {hair_type: CharacterAppearance['Hair_Type'],
		eyes_type: CharacterAppearance['Eyes_Type'],
		brows_type: CharacterAppearance['Brows_Type'],
		nose_type: CharacterAppearance['Nose_Type'],
		mouth_type: CharacterAppearance['Mouth_Type'],
		gender: CharacterAppearance['Gender'],
		},
        success: function()
        {
            DrawMainCharacterFromJSON("appearance", CharacterAppearance);
        }
    });
}

function ShowFeatureOptions(folder, n_elem){
	result_code = "";
	Gender = "";
	if(Object.is(folder, 'Hair')){
		Gender += CharacterAppearance['Gender'];
		Gender += "_";
	}
	for(var n = 1; n<=n_elem; n++){
		Img_src = ".//content//appearance//"+folder+"//"+Gender+n+".png";
		result_code += '<button class="featuresCards" onclick = "ChangeCharacterFeature('+"'"+ folder +"', "+ n + ')"><img class = "features" src="'+ Img_src + '" alt=' + folder + '_' + n +'></button>'
	}
	$("#FeatureOptions").empty();
	$("#FeatureOptions").append(result_code);
}