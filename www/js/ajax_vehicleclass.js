window.onload = function(){
    document.getElementById("car").addEventListener("click", selectVclass);
    document.getElementById("suv").addEventListener("click", selectVclass);
    document.getElementById("truck").addEventListener("click", selectVclass);
    document.getElementById("van").addEventListener("click", selectVclass);

};


// //event listener for vehicle class (car, suv, truck, van)

// //event listener for vehicle line)
// document.getElementById("line").addEventListener("click", setClass());



function selectVclass() {
    let Vclass = this.id;
    $( document ).click(function() {
        $(".classes").hide("slide");
    });
    displayLines(Vclass);
    //return Vclass;


    //alert(Vclass);


}

function displayLines(Vclass){
    if (Vclass === "car"){
        var regular = document.createElement("IMG");
        regular.setAttribute('src', 'www/img/vehicles/car.jfif');
        regular.setAttribute("class", "car-lines");
        regular.setAttribute("id", "regular-car");
        document.body.appendChild(regular);
        document.getElementById("regular-car").addEventListener("click", selectRegularLine);

        var luxury = document.createElement("IMG");
        luxury.setAttribute('src', 'www/img/vehicles/car.jfif');
        luxury.setAttribute("class", "car-lines");
        luxury.setAttribute("id", "luxury-car");
        document.body.appendChild(luxury);
        document.getElementById("luxury-car").addEventListener("click", selectLine);

        var exotic = document.createElement("IMG");
        exotic.setAttribute('src', 'www/img/vehicles/car.jfif');
        exotic.setAttribute("class", "car-lines");
        exotic.setAttribute("id", "exotic-car");
        document.body.appendChild(exotic);
        document.getElementById("exotic-car").addEventListener("click", selectLine);

        var sports = document.createElement("IMG");
        sports.setAttribute('src', 'www/img/vehicles/car.jfif');
        sports.setAttribute("class", "car-lines");
        sports.setAttribute("id", "sports-car");
        document.body.appendChild(sports);
        document.getElementById("sports-car").addEventListener("click", selectLine);



    } else if (Vclass === "suv"){
        var compact = document.createElement("IMG");
        compact.setAttribute('src', 'www/img/vehicles/car.jfif')
        compact.setAttribute("class", "lines");
        compact.setAttribute("id", "compact-suv");
        document.body.appendChild(compact);
        document.getElementById("compact-suv").addEventListener("click", selectLine);

        var standard = document.createElement("IMG");
        standard.setAttribute('src', 'www/img/vehicles/car.jfif');
        standard.setAttribute("class", "lines");
        standard.setAttribute("id", "standard-suv");
        document.body.appendChild(standard);
        document.getElementById("standard-suv").addEventListener("click", selectLine);

        var fullsize = document.createElement("IMG");
        fullsize.setAttribute('src', 'www/img/vehicles/car.jfif');
        fullsize.setAttribute("class", "lines");
        fullsize.setAttribute("id", "fullsize-suv");
        document.body.appendChild(fullsize);
        document.getElementById("fullsize-suv").addEventListener("click", selectLine);

        var jeep = document.createElement("IMG");
        jeep.setAttribute('src', 'www/img/vehicles/car.jfif');
        jeep.setAttribute("class", "lines");
        jeep.setAttribute("id", "jeep-suv");
        document.body.appendChild(jeep);
        document.getElementById("jeep-suv").addEventListener("click", selectLine);

    } else if (Vclass === "truck"){
        var small = document.createElement("IMG");
        small.setAttribute('src', 'www/img/vehicles/car.jfif');
        small.setAttribute("class", "lines");
        small.setAttribute("id", "small-truck");
        document.body.appendChild(small);
        document.getElementById("small-truck").addEventListener("click", selectLine);

        var fullsize = document.createElement("IMG");
        fullsize.setAttribute('src', 'www/img/vehicles/car.jfif');
        fullsize.setAttribute("class", "lines");
        fullsize.setAttribute("id", "fullsize-truck");
        document.body.appendChild(fullsize);
        document.getElementById("fullsize-truck").addEventListener("click", selectLine);

    } else if (Vclass === "van"){
        var mini = document.createElement("IMG");
        mini.setAttribute('src', 'www/img/vehicles/car.jfif');
        mini.setAttribute("class", "lines");
        mini.setAttribute("id", "mini-van");
        document.body.appendChild(mini);
        document.getElementById("mini-van").addEventListener("click", selectLine);

        var passenger = document.createElement("IMG");
        passenger.setAttribute('src', 'www/img/vehicles/car.jfif');
        passenger.setAttribute("class", "lines");
        passenger.setAttribute("id", "passenger-van");
        document.body.appendChild(passenger);
        document.getElementById("passenger-van").addEventListener("click", selectLine);
    }

}

function selectRegularLine(){

    $( document ).click(function() {
        $(".car-lines").hide("slide");
    });


    var compact = document.createElement("IMG");
    compact.setAttribute('src', 'www/img/vehicles/car.jfif');
    compact.setAttribute("class", "lines");
    compact.setAttribute("id", "compact-car");
    document.body.appendChild(compact);
    document.getElementById("compact-car").addEventListener("click", selectLine);

    var midsize = document.createElement("IMG");
    midsize.setAttribute('src', 'www/img/vehicles/car.jfif');
    midsize.setAttribute("class", "lines");
    midsize.setAttribute("id", "midsize-car");
    document.body.appendChild(midsize);
    document.getElementById("midsize-car").addEventListener("click", selectLine);

    var fullsize = document.createElement("IMG");
    fullsize.setAttribute('src', 'www/img/vehicles/car.jfif');
    fullsize.setAttribute("class", "lines");
    fullsize.setAttribute("id", "fullsize-car");
    document.body.appendChild(fullsize);
    document.getElementById("fullsize-car").addEventListener("click", selectLine);



}


function selectLine() {
    let lineId = this.id;
    var vehicleType = lineId.split("-")[1];
    var line = lineId.split("-")[0];


    $( document ).click(function() {
        $(".lines, .car-lines").hide("slide");
    });


    request(vehicleType, line);
    return line;
}


//set and send XMLHttp request.
function request(vehicleType, line){

    //set details of vehicle
    let details = String(line) + "," + String(vehicleType);

    //create an XHR object
    let xhr = new XMLHttpRequest();

    //open an asynchronous AJAX request
    xhr.open("GET", "browse_vehicle.php?details=" + details, true);

    //handle the server's responses
    xhr.onload = function () {

        //retrieve server's response an parse it to a json object
        var vehicles = JSON.parse(xhr.responseText);

        //display details of shape object
        console.log("hi");

    }

    xhr.send(null);
}

// function selectLine(){
//     line = this.id;
// }

// function selectVclass(){
//         Vclass = this.id;
//         //alert(Vclass);
//
//     $( document ).click(function() {
//         $(".selections").not("#" + Vclass).toggle("slide");
//         });
//       }

// //open an asynchronous AJAX request
//     xhr.open("GET", "search_movie.php?q=" + query, true);
// //handle server's responses
//     xhr.onload = function () {
// //retrieve server's response and parse it to a json object
//         var titles = JSON.parse(xhr.responseText);
// // display suggested titles in a div block
//         displayTitles(titles);
//     }
// //send the AJAX request
//     xhr.send(null);
