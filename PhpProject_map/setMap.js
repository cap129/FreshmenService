/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var mapOptions = {
        center: new google.maps.LatLng(40.4447, -79.9561),
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

    // Try HTML5 geolocation       
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = new google.maps.LatLng(position.coords.latitude,
                    position.coords.longitude);

            map.setCenter(pos);
            var marker = new google.maps.Marker({
                position: pos,
                map: map
            });
            var message = new google.maps.InfoWindow({
                content: "You are here now.",
                maxWidth: 600

            });
            message.open(map, marker);
            map.addOverlay(marker);
        });
    } else {
        var mapOptions = {
            center: new google.maps.LatLng(40.4447, -79.9561),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
                mapOptions);
    }

    directionsDisplay.setMap(map);
}

function setupMap(x, y, content, z) {
    var mapOptions = {
        center: new google.maps.LatLng(x, y),
        zoom: 17,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);
    var marker = new google.maps.Marker({
        position: new google.maps.LatLng(x, y),
        map: map
    });
    var message = new google.maps.InfoWindow({
        content: content,
        maxWidth: 600

    });
    message.open(map, marker); //直接显示信息窗口
    map.addOverlay(marker);
}

function showMarker(BId) {
    if (BId == "1001") {
        showInfo(BId);
        setupMap(40.44433, -79.9531, "Cathedral of Learning", "1001");
    }
    else if (BId == "1002") {
        showInfo(BId);
        setupMap(40.44197, -79.9557, "Barco Law Library", "1002");
    }
    else if (BId == "1003") {
        showInfo(BId);
        setupMap(40.44740, -79.9527, "School of Information Sciences", "1003")
    }
    else if (BId == "1004") {
        showInfo(BId);
        setupMap(40.4426, -79.9542, "Hillman Library", "1004");
    }
}

function serviceMarker(service) {
    showServiceInfo(service);
    if (service == "food") {
        var mapOptions = {
            center: new google.maps.LatLng(40.4447, -79.9561),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
                mapOptions);

        var marker1 = new google.maps.Marker({
            position: new google.maps.LatLng(40.44433, -79.9531),
            map: map,
            title: "Cathedral of Learning"
        });
        google.maps.event.addListener(marker1, 'click', function () {
            setupMap(40.44433, -79.9531, "Cathedral of Learning");
        });

        var marker3 = new google.maps.Marker({
            position: new google.maps.LatLng(40.44740, -79.9527),
            map: map,
            title: "School of Information Sciences"
        });
        google.maps.event.addListener(marker3, 'click', function () {
            setupMap(40.44740, -79.9527, "School of Information Sciences");
        });

        var marker4 = new google.maps.Marker({
            position: new google.maps.LatLng(40.4426, -79.9542),
            map: map,
            title: "Hillman Library"
        });
        google.maps.event.addListener(marker4, 'click', function () {
            setupMap(40.4426, -79.9542, "Hillman Library");
        });

    }
    else if (service == "study") {
        var mapOptions = {
            center: new google.maps.LatLng(40.4447, -79.9561),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
                mapOptions);
    }
    else if (service == "print") {
        var mapOptions = {
            center: new google.maps.LatLng(40.4447, -79.9561),
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
                mapOptions);
    }
}


var xmlHttp;
function showInfo(str)
{
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "getInfo.php"
    url = url + "?q=" + str;
    url = url + "&sid=" + Math.random();
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
    //var content = eval("(<?PHP echo $return;?>)");

}

function showServiceInfo(str) {
    xmlHttp = GetXmlHttpObject();
    if (xmlHttp == null)
    {
        alert("Browser does not support HTTP Request");
        return;
    }
    var url = "getServiceInfo.php";
    url = url + "?q=" + str;
    url = url + "&sid=" + Math.random();
    xmlHttp.onreadystatechange = stateChanged;
    xmlHttp.open("GET", url, true);
    xmlHttp.send(null);
}

function stateChanged()
{
    if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
    {
        document.getElementById("txtHint").innerHTML = xmlHttp.responseText
    }
}

function GetXmlHttpObject()
{
    var xmlHttp = null;
    try
    { // Firefox, Opera 8.0+, Safari
        xmlHttp = new XMLHttpRequest();
    }
    catch (e)
    { //Internet Explorer
        try
        {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
            xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    }
    return xmlHttp;
}






