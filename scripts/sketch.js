let orbitArr;
let launchArr;
let myMap;
let canvas;
let img;

const key = 'pk.eyJ1IjoiZ2FsYXh5ODIiLCJhIjoiY2tkZ2o3aDV0Mjh6MDMwcGd0dGNkemxwNCJ9.4Dhyt_1dEpmgG4UKnS-WQg';
const mappa = new Mappa('MapboxGL', key);
const options = {
  lat: 10,
  lng: 0,
  zoom: 1.2,
  minZoom: 0.8,
  renderWorldCopies: false,
  style: "mapbox://styles/mapbox/satellite-streets-v10"
}


function preload() {
    img = loadImage('./satellite.png');
}

function setup(){
    let mapDiv = document.getElementById('map'); 
    canvas = createCanvas(mapDiv.offsetWidth, mapDiv.offsetHeight); 
    canvas.parent('map');
    imageMode(CENTER);
    angleMode(DEGREES);

    // Create a tile map with the options declared
    myMap = mappa.tileMap(options); 
    myMap.overlay(canvas);

    let orbitTable = document.getElementById('orbit-table');
    let launchTable = document.getElementById('launch-table');

    orbitArr = parseTableToObject(orbitTable);
    setLabelColors(orbitArr);
    cacheGroundTrace(orbitArr);

    launchArr = parseTableToObject(launchTable);
    setLabelColors(launchArr);

    frameRate(10);
}

function draw(){
    clear();
    drawLaunchSites();
    drawOrbits();
}

function drawOrbits() {
    for (let index = 0; index < orbitArr.length; index++) {
        if(orbitArr[index].Display.checked) {
            let groundTrack = orbitArr[index].GroundTrack;

            stroke(orbitArr[index].Color.style.backgroundColor);
            strokeWeight(3);
            noFill();
            for (let i = 0; i < groundTrack.length; i++) {
                if (i < groundTrack.length - 1 && groundTrack[i].y < groundTrack[i + 1].y) {
                    const p1 = myMap.latLngToPixel(groundTrack[i].x, groundTrack[i].y);
                    const p2 = myMap.latLngToPixel(groundTrack[i + 1].x, groundTrack[i + 1].y);
                    line(p1.x, p1.y, p2.x, p2.y);
                }
            }

            const currentLocation = getCurrentLocation(
                new Date(orbitArr[index]['Launch Date']),
                parseFloat(orbitArr[index]['Launch Site Latitude']), 
                parseFloat(orbitArr[index]['Launch Site Longitude']), 
                parseFloat(orbitArr[index].Altitude), 
                parseFloat(orbitArr[index].Inclination));      
                
                const latLong = myMap.latLngToPixel(currentLocation.x, currentLocation.y);
                const zoom = myMap.zoom() + 1;
                image(img, latLong.x, latLong.y, 15 * zoom, 15 * zoom);  
        }
    }
}

function drawLaunchSites() {
    stroke(0);
    strokeWeight(1);
    for (let index = 0; index < launchArr.length; index++) {
        if(launchArr[index].Display.checked) {
            const site = myMap.latLngToPixel(launchArr[index].Latitude, launchArr[index].Longitude);
            fill(launchArr[index].Color.style.backgroundColor);
            ellipse(site.x, site.y, 15, 15);
        }
    }
}

function cacheGroundTrace(arr) {
    for (let index = 0; index < arr.length; index++) {
        let currentOrbit = arr[index];

        console.log(parseFloat(currentOrbit.Inclination));
        currentOrbit['GroundTrack'] = getGroundTrack(
            new Date(currentOrbit['Launch Date']),
            parseFloat(currentOrbit['Launch Site Latitude']), 
            parseFloat(currentOrbit['Launch Site Longitude']), 
            parseFloat(currentOrbit.Altitude), 
            parseFloat(currentOrbit.Inclination));        
    }
}

const orbits = 3; // Number of orbits to calculate
const timeStep = 180; // Amount of steps to calculate per total degrees
const degreesPerSecond = 360 / 86400; // The amount of degrees the earth rotates per second
const R = 6378.1; // Radius of earth

function getGroundTrack(epoch, latitude, longitude, altitude, inclination) {
    const timeSinceLaunch = (new Date() - epoch) / 1000;
    const T = sqrt(pow((altitude + R) * 1000, 3) * 9.907 * pow(10, -14));
    let phase = asin(latitude / inclination);
    const deltaTime = orbits * T / timeStep;
    const earthRotationPerOrbit = T * degreesPerSecond;
    const deltaRotation = earthRotationPerOrbit / timeStep;
    console.log(phase);
    let groundTrack = [];
    let long;
    for (let t = 0; t < orbits * T; t += deltaTime) {
        let lat = inclination * sin((360 / T) * (t + timeSinceLaunch) + phase);
        long = (360 / T) * (t + timeSinceLaunch) + longitude;
        long = long - (360 * floor(long / 360))
        if(long > 180) {
            long -= 360;
        }

        groundTrack.push(createVector(lat, long));

        phase += deltaRotation;
    }

    return groundTrack;
}

function getCurrentLocation(epoch, latitude, longitude, altitude, inclination) {
    const timeSinceLaunch = (new Date() - epoch) / 1000;
    const T = sqrt(pow((altitude + R) * 1000, 3) * 9.907 * pow(10, -14));
    let phase = asin(latitude / inclination);

    let lat = inclination * sin((360 / T) * timeSinceLaunch + (phase));
    long = (360 / T) * timeSinceLaunch + longitude;
    long = long - (360 * floor(long / 360))
    if(long > 180) {
        long -= 360;
    }

    return createVector(lat, long);
}

function parseTableToObject(table) {
    var data = [];

    var rowLength = table.rows.length;

    // Create parameters
    var params = [];
    if(rowLength >= 1) {
        var cells = table.rows.item(0).cells;
        for(param = 0; param < cells.length; param++) {
            params.push(cells.item(param).innerHTML);
        }
    } else {
        return [];
    }

    for (i = 1; i < rowLength; i++){
        var cells = table.rows.item(i).cells;

        var cellLength = cells.length;

        let column = {};
        for(var j = 0; j < cellLength; j++){
            if(cells.item(j).children.length > 0) {
                column[params[j]] = cells.item(j).children[0];
            } else {
                column[params[j]] = cells.item(j).innerHTML;
            }
        }

        data.push(column);
    }

    return data;
}

function getColor(current, length) {
    const map = (current) * 360 / (length - 1);
    return `hsl(${map}, 100%, 70%)`;
}

function setLabelColors(arr) {
    for (let index = 0; index < arr.length; index++) {
        arr[index].Color.style.backgroundColor = getColor(index, arr.length  + 1) 
    }
}