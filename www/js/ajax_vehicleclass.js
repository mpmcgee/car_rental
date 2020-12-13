var numResults = 0;
var suggestionBoxObj;
var selectBoxObj;
var vLine;

//initial actions to take when the page load
window.onload = function () {
    //DOM objects
    selectBoxObj = document.getElementById('class');
    suggestionBoxObj = document.getElementById('suggestionDiv');
    selectBoxObj.addEventListener('change', handleOnChange);
};

function handleOnChange() {
    //retrieve input from the select box
    vLine = selectBoxObj.value;
    console.log(vLine);

    // create an XHR object
    var xhr = new XMLHttpRequest();

    //open an asynchronous AJAX request
    xhr.open("GET", base_url + "/booking/getVline/" + vLine, true);

    xhr.onload = function () {
        //handle server's responses
        var results = JSON.parse(xhr.responseText);
        console.log(results);

        displayVehicles(results);
    };
    xhr.send(null);
}

function displayVehicles(results) {
    numResults = results.length;

    if (numResults === 0) {
        //hide all suggestions
        suggestionBoxObj.style.display = 'none';
        return false;
    }

    suggestionBoxObj.innerHTML = "";

    for (let i = 0; i < numResults; i++) {
        // console.log(results[i]);
        suggestionBoxObj.innerHTML += "<input type='radio' id=" + results[i].vehicle_id + " value= " + results[i].vehicle_id + " name = pick_car>";
        suggestionBoxObj.innerHTML += "<label for=" + results[i].vehicle_id + ">" + results[i].make + " " + results[i].model +
            " (" + results[i].year +  ") - $" + results[i].price_per_day + "</label>";
        suggestionBoxObj.innerHTML += "<br>";
    }
    //display the spans in the div block
    suggestionBoxObj.style.display = 'block';

}
