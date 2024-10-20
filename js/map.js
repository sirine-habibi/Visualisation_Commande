const googleMapsApiKey = process.env.GOOGLE_MAPS_API_KEY;
const firebaseConfig = {
  // Utiliser googleMapsApiKey pour la logique de carte
  apiKey: googleMapsApiKey,
  authDomain: "zippy-nexus-421014.firebaseapp.com",
  databaseURL: "https://zippy-nexus-421014-default-rtdb.firebaseio.com",
  projectId: "zippy-nexus-421014",
  storageBucket: "zippy-nexus-421014.appspot.com",
  messagingSenderId: "651072781571",
  appId: "1:651072781571:web:d3be084e24a98dcafcbd36",
};
firebase.initializeApp(firebaseConfig);
var database = firebase.database();

let lat = 0;
let lng = 0;
let path = []; // Array to store the path coordinates
let map, polyline;

// Function to update map and polyline
function updateMap() {
  const position = { lat: lat, lng: lng };

  if (map) {
    map.setCenter(position);
    path.push(position);

    if (!polyline) {
      polyline = new google.maps.Polyline({
        path: path,
        geodesic: true,
        strokeColor: "#FF0000",
        strokeOpacity: 1.0,
        strokeWeight: 2,
      });
      polyline.setMap(map);
    } else {
      polyline.setPath(path);
    }

    const marker = new google.maps.Marker({
      position: position,
      map: map,
      title: "Current Position",
    });
  }
}

// Initialize and add the map
async function initMap() {
  const { Map } = await google.maps.importLibrary("maps");

  const initialPosition = { lat: lat, lng: lng };

  map = new Map(document.getElementById("map"), {
    zoom: 18,
    center: initialPosition,
    mapId: "DEMO_MAP_ID",
  });

  // Initialize polyline with the initial position
  path.push(initialPosition);
  polyline = new google.maps.Polyline({
    path: path,
    geodesic: true,
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 2,
  });
  polyline.setMap(map);
}

database.ref("LAT").on("value", function (snapshot) {
  lat = snapshot.val();
  updateMap();
});

database.ref("LNG").on("value", function (snapshot) {
  lng = snapshot.val();
  updateMap();
});

initMap();
