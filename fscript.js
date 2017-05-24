/*
Zach Teutsch + Calvin Woods
Full Stack Project
May 2017

~XMLHttpRequest JavaScript~
*/

function fetchData1() {
	//alert("about to request page");
	var data = document.getElementById('b1').value;
	httpGetAsync("http://localhost/fullstack/selectWordsAssociatedWithTeacher.php", processPage, data);
}

function fetchData2() {
	//alert("about to request page");
	var data = document.getElementById('b2').value;
	httpGetAsync("http://localhost/fullstack/selectTeachersAssociatedWithWord.php", processPage, data);
}

function fetchData3() {
	//alert("about to request page");
	var data1 = document.getElementById('b3').value;
	var data2 = document.getElementById('b4').value;
	httpGetAsyncInsert("http://localhost/fullstack/insertPair.php", processPageInsert, data1, data2);
}






//starts a request and then runs the callback method when it is loaded
function httpGetAsync(theUrl, callbackWhenPageLoaded, params)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callbackWhenPageLoaded(xmlHttp.responseText);
    }


    xmlHttp.open("POST", theUrl, true); // true for asynchronous
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send('input=' + encodeURIComponent(params));

		//'name=' + encodeURIComponent(document.getElementById('b1').value)
}



//This callback method is a bit boring as it just prints to the console.
//Add more fun or call another method from inside to do something interesting.
function processPage(responseText) {
	document.getElementById("reportArea").innerHTML = responseText;
	//alert(responseText);
}


function httpGetAsyncInsert(theUrl, callbackWhenPageLoaded, params1, params2)
{
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            callbackWhenPageLoaded();
    }

    xmlHttp.open("POST", theUrl, true); // true for asynchronous
		xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send('inputName=' + encodeURIComponent(params1) + "&inputWord="
		+ encodeURIComponent(params2));

		//'name=' + encodeURIComponent(document.getElementById('b1').value)
}

function processPageInsert() {

	document.getElementById("reportArea").innerHTML = "Database updated successfully.";

}
