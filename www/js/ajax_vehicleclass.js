var numResults = 0;
var suggestionBoxObj;
var selectBoxObj;
var startDate;
var endDate;
var carClass;
var vLine;
var splitString;
var query;
var results;

//initial actions to take when the page load
window.onload = function () {
    //DOM objects
    startDate = document.getElementById('start-date');
    endDate = document.getElementById('end-date');
    selectBoxObj = document.getElementById('class');
    suggestionBoxObj = document.getElementById('suggestionDiv');
    selectBoxObj.addEventListener('change', handleOnChange);
};

function handleOnChange() {
    //retrieve input from the select box
    splitString = (selectBoxObj.value).split(" ");
    vLine = splitString[1];
    carClass= splitString[0];
    console.log(vLine);
    console.log(carClass)

    query = carClass + "-" + vLine;
    console.log(query);

    // create an XHR object
    var xhr = new XMLHttpRequest();

    //open an asynchronous AJAX request
    xhr.open("GET", base_url + "/booking/getVline/" + query, true);

    xhr.onload = function () {
        //handle server's responses
        if (xhr.responseText == false) {
            results = "No available vehicles";
            displayVehicles(results);
        } else {
            results = JSON.parse(xhr.responseText);
            console.log(results);

            displayVehicles(results);
        }

    }
    xhr.send(null);
}

function displayVehicles(results) {
    numResults = results.length;
    suggestionBoxObj.innerHTML = "";
    
    if (numResults === 0) {
        //hide all suggestions
        suggestionBoxObj.style.display = 'none';
        return false;
    }

if (typeof (results) == "string") {
        suggestionBoxObj.innerHTML = "<h3>Available \""+vLine+" "+ carClass+"s\"<h3>";
        suggestionBoxObj.innerHTML += "<p>"+ results +"</p>";
    } else {
        suggestionBoxObj.innerHTML = "<h3>Available \"" + vLine + " " + carClass + "s\"<h3>";
        for (let i = 0; i < numResults; i++) {
            // console.log(results[i]);
            suggestionBoxObj.innerHTML += "<input type='radio' id=" + results[i].vehicle_id + " value= " + results[i].vehicle_id + " name = pick_car>";
            suggestionBoxObj.innerHTML += "<label for=" + results[i].vehicle_id + ">" + results[i].make + " " + results[i].model +
                " (" + results[i].year + ") - $" + results[i].price_per_day + "</label>";
            suggestionBoxObj.innerHTML += "<br>";
        }
    }
    //display the spans in the div block
    suggestionBoxObj.style.display = 'block';

}
   
