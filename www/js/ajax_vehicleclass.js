var numResults = 0;
var vClass = "";
var suggestionBoxObj;
var selectBoxObj;


//initial actions to take when the page load
window.onload = function () {
    //DOM objects
    selectBoxObj = document.getElementById('class').value;
    suggestionBoxObj = document.getElementById('suggestionDiv');
    suggestionBoxObj.addEventListener('select', handleOnSelect);
};

function handleOnSelect(e){
    //retrieve input from the select box

    vClass = document.getElementById("class").value;

    if (vClass != ""){

        // create an XHR object
        var xhr = new XMLHttpRequest();

        //open an asynchornous AJAX request
        xhr.open("GET", "vclass.php?name=" + name, true);

        //handle server's responses
        xhr.onload = function () {

            //retrieve server's response and parse it to a json object
            var results = JSON.parse(xhr.responseText);

            displayVehicles(results);

        }//end of xhr.onload function


    } // end of outer if statement
    xhr.send(null);
}

function displayVehicles(results){
    numResults = results.length;

    if (numResults === 0) {
        //hide all suggestions
        suggestionBoxObj.style.display = 'none';
        return false;
    }

    var divContent = ""
    for (let i=0; i < numResults; i++){
        divContent += "<input type = 'radio' id = " + results[i] + " value = " + results[i];
    }
    //display the spans in the div block
    suggestionBoxObj.innerHTML = divContent;
    suggestionBoxObj.style.display = 'block';

}