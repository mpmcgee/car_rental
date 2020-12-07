var numResults = 0;
var suggestionBoxObj;
var selectBoxObj;
var startDate;
var endDate;
var groupObj;


//initial actions to take when the page load
window.onload = function () {
    //DOM objects
    selectBoxObj = document.getElementById('class');

    suggestionBoxObj = document.getElementById('suggestionDiv');
    selectBoxObj.addEventListener('change', handleOnChange);
    startDate = document.getElementById("start-date");
    endDate = document.getElementById("end-date");


};

function handleOnChange(e){
    //retrieve input from the select box

    var vLine = selectBoxObj.value;
    var classObj = selectBoxObj;



    vLine = vLine.charAt(0).toLowerCase() + vLine.slice(1);
    vLine = vLine.replace('-', '');

    console.log(vLine);
    console.log(groupObj);



    if (vLine && startDate && endDate){

        // create an XHR object
        var xhr = new XMLHttpRequest();

        //open an asynchornous AJAX request
        xhr.open("GET", "vline.php?vline=" + vLine, true);

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
        // console.log(results[i]);
        divContent += "<input type = 'radio' id = " + results[i] + " value = " + results[i] + ">";
    }
    //display the spans in the div block
    suggestionBoxObj.innerHTML = divContent;
    suggestionBoxObj.style.display = 'block';

}