//IDで取得
var v=0;
var random=Math.random()*1400;
var randomtime=Math.random()*10;

var object1 = document.getElementById("rain1");
// var object2 = document.getElementById("rain2");
// var object3 = document.getElementById("rain3");

function move1(){
	object1.style.top=v+"px";
	// console.log(object1.style.top,object1.style.left);
	v+=2;
	if(v>500){
		$(object1).fadeOut(1000);
		if(v>600){
			v=0;
			random=Math.random()*1400;
			randomtime=Math.random()*10;
			object1.style.left=random+"px";
			$(object1).fadeIn(1000);
			if(randomtime==4){
				setTimeout(function() {
    		// ここに5秒後に行う処理を書く   
    	}, 1000);
			}
		}
	}

}




setInterval("move1()",10);
