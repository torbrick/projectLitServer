window.onload = function(){

	const readyStateDesc = {
		NOT_INITIALIZED			:	0,
		CONNECTION_ESTABLISHED	:	1,
		REQUEST_RECEIVED		:	2,
		REQUEST_PROCESSING		:	3,
		RESPONSE_READY			:	4,
	}
	const statusDesc = {
		OK				:	200,
		FORBIDDEN		:	403,
		NOT_FOUND		:	404,
		SERVER_ERROR	:	500,
	}
	var currentMsgID = 0;
	var jsonMessages = [];
	var messageArray = [];
	var messageCheckBoxArray = [];
	
	var onOff = false;
	
	//assign variables to html elements
	var onButton = document.getElementById("on_button");
	var offButton = document.getElementById("off_button");
	//var outputBox = document.getElementById("output_box");
	//var usersBox = document.getElementById("users_box");
	//var appendDBButton = document.getElementById("append_db");
	//var readDBButton = document.getElementById("read_db");
	//var deleteDBButton = document.getElementById("delete_db");
	//var usersButton = document.getElementById("get_users");
	//var appendFileButton = document.getElementById("append_file");
	//var deleteFileButton = document.getElementById("delete_messages");
	//var userNote = this.document.getElementById("user_note");
	//var newMessageAlert = document.getElementById("audio_alert");
	
	
	//assign onclicks
	onButton.onclick = turnOn;
	offButton.onclick = turnOff;
	//appendDBButton.onclick = appendDB;
	//readDBButton.onclick = readDB;
	//deleteDBButton.onclick = deleteDB;
	//usersButton.onclick = populateUsers;
	//appendFileButton.onclick = appendFile;
	//deleteFileButton.onclick = deleteFileContents;
	
	
	
	//hide elements
	//hideElement(readDBButton);
	//hideElement(usersButton);
	//hideElement(appendFileButton);
	//hideElement(deleteFileButton);
	//hideElement(usersBox);
	
	//setInterval(function(){readDB()},1000); //reads file every 1 second
	//readDB();
	
	function turnOn(){
		onOff = true;
		appendFile();
	}
	function turnOff(){
		onOff = false;
		appendFile();
	}
	function compareArrays(array1, array2){
		sameArray = true;
		if(array1.length != array2.length)
		{
			//not the same array
			sameArray = false;
		}
		else
		{
			//check that the arrays are the same
			for(var i = 0; i < array1.length; i++){
				if(array1[i] != array2[i])
				{
					sameArray = false;
					break;
				}
			}
		}
		return sameArray;
	}
	function appendFile(){
		var request = new XMLHttpRequest();
		console.log("User Note: "+onOff);
		console.log("attempting to append file");
		request.open("GET" , "appendFile.php?msg=" + onOff, true);
		request.send(null);
		request.onreadystatechange = function () {
			let ready = readyStateDesc.RESPONSE_READY;
			let ok = statusDesc.OK;
			if (request.readyState == ready && request.status == ok) {
				data = request.responseText;
				console.log(data);
				//readFile();
				userNote.value = "";
			}
			//test if fail
			else if (request.readyState == ready && request.status == statusDesc.SERVER_ERROR) {
				console.log("server error");
				return ("fail");
			}
			//else 
			else if (request.readyState == ready && request.status != ok && request.status != statusDesc.SERVER_ERROR ) { 
				console.log("Something went wrong!");
				return ("fail"); }
		}
	}
	function deleteFileContents(){
		var request = new XMLHttpRequest();
		console.log("Deleting User Notes");
		request.open("GET","deleteContents.php",true);
		request.send(null);
		request.onreadystatechange = function () {
			let ready = readyStateDesc.RESPONSE_READY;
			let ok = statusDesc.OK;
			if (request.readyState == ready && request.status == ok) {
				data = request.responseText;
				console.log(data);
				//readFile();
				
			}
			//test if fail
			else if (request.readyState == ready && request.status == statusDesc.SERVER_ERROR) {
				console.log("server error");
				return ("fail");
			}
			//else 
			else if (request.readyState == ready && request.status != ok && request.status != statusDesc.SERVER_ERROR ) { 
				console.log("Something went wrong!");
				return ("fail"); }
		}
	}
	function hideElement(element) {
	  if (element.style.display === "none") {
		element.style.display = "block";
	  } else {
		element.style.display = "none";
	  }
	}
}
