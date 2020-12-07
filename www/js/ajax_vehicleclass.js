var numResults = 0;
var vClass = [];
var suggestionBoxObj;
var selectBoxObj;
var startDate;
var endDate;


//initial actions to take when the page load
window.onload = function () {
    //DOM objects
    selectBoxObj = document.getElementById('class');
    suggestionBoxObj = document.getElementById('suggestionDiv');
    selectBoxObj.addEventListener('change', handleOnChange);
    startDate = document.getElementById("start-date").value;
    endDate = document.getElementById("end-date").value;


};

function handleOnChange(e){
    //retrieve input from the select box

    vClass = document.getElementById("class").value;


    if (vClass != "" && startDate != "" && endDate != ""){

        // create an XHR object
        var xhr = new XMLHttpRequest();

        //open an asynchornous AJAX request
        xhr.open("GET", "vclass.php?vClass=" + vClass, true);

        //handle server's responses
        xhr.onload = function () {

            //retrieve server's response and parse it to a json object
            var results = JSON.parse(xhr.responseText);

            displayVehicles(results);
            console.log(results[0]);

        }//end of xhr.onload function

        xhr.send(null);


    } // end of outer if statement


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
        console.log(results[i]);
        divContent += "<input type = 'radio' id = " + results[i] + " value = " + results[i] + ">";
    }
    //display the spans in the div block
    suggestionBoxObj.innerHTML = divContent;
    suggestionBoxObj.style.display = 'block';

}