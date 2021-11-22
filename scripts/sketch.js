let matDiv;
let launchTable;
let myMap;
let canvas;
const mappa = new Mappa('Leaflet');

// Lets put all our map options in a single object
const options = {
  lat: 0,
  lng: 0,
  zoom: 4,
  style: "http://{s}.tile.osm.org/{z}/{x}/{y}.png"
}

function setup(){
    launchTable = document.getElementById('launch-table');
    setLabelColors(launchTable);

    mapDiv = document.getElementById('map'); 
    canvas = createCanvas(mapDiv.offsetWidth, mapDiv.offsetWidth / 3); 
    canvas.parent('map');

    // Create a tile map with the options declared
    myMap = mappa.tileMap(options); 
    myMap.overlay(canvas);
}

function draw(){
    clear();
    drawLaunchSites();
}

function drawLaunchSites() {
    var rowLength = launchTable.rows.length;

    for (i = 1; i < rowLength; i++){
        var cells = launchTable.rows.item(i).cells;
        if(cells.item(4).children[0].checked) {
            const site = myMap.latLngToPixel(cells.item(1).innerHTML, cells.item(2).innerHTML); 
            fill(cells.item(3).children[0].style.backgroundColor)
            ellipse(site.x, site.y, 20, 20);        
        }

    }
}

function getColor(current, length) {
    const map = (current) * 360 / (length - 1);
    return `hsl(${map}, 100%, 70%)`;
}

function setLabelColors(table) {
    var rowLength = table.rows.length;

    for (i = 0; i < rowLength; i++){
        var cells = table.rows.item(i).cells;

        var cellLength = cells.length;

        for(var j = 0; j < cellLength; j++){
            if(cells.item(j).classList.contains('map-label')) {
                cells.item(j).children[0].style.backgroundColor = getColor(i, rowLength);
            }
        }
    }
}