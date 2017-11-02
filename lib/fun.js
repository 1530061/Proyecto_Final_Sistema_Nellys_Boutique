

function logout(){
  	$.get("lib/endSession.php");
  	window.location.href = "index.php"; 
}

function caps(){
	var caps = event.getModifierState && event.getModifierState( 'CapsLock' );
  	console.log( caps ); // true when you press the keyboard CapsLock key
}

