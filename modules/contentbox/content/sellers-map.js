// Initialize and add the map
      const initMap = () => {

        const sheffield = { lat: 53.39, lng: -1.639 };

        const map = new google.maps.Map(document.getElementById("sellers-map"), {
          zoom: 6,
          center: sheffield,
        });

        //initialise markers and the pop-up info
        let markers = [];
        const infoWindow = new google.maps.InfoWindow();

        //get seller data and add as markers to map
        getSellers()
          .then(sellers => {
            sellers.forEach((seller,i) => {
              markers[i] = new google.maps.Marker({
                icon: "/img/marker-icon.png",
                position: seller.location,
                title: seller.title,
                map: map
              });
              markers[i].addListener("click", () => {
                infoWindow.setContent(generateContent(seller))
                infoWindow.open(map, markers[i]);
              });
            })
          });
      }

      const getSellers = async () => {
        //fetch seller IDs
        const response = await fetch('/api/kbsellers?output_format=JSON',{
          headers: {
            "Authorization": "Basic MlJSQ0wxOU44S1BYSFc3TTlWWUtNUTFHWElTVFRCSjc6",
            "Accept": "application/json"
          }
        });

        const result = await response.json();
        const sellerObjects = result.kbsellers;

        //loop through the ids and fetch the seller information
        const sellerRequests = sellerObjects.map( async sellerObject => {
          const id = sellerObject.id;
          
          const response = await fetch(`/api/kbsellers/${id}?output_format=JSON`,{
            headers: {
              "Authorization": "Basic MlJSQ0wxOU44S1BYSFc3TTlWWUtNUTFHWElTVFRCSjc6",
              "Accept": "application/json"
            }
          });
  
          const {seller} = await response.json();

          return seller;
        })

        //wait until all requests are resolved, then return the filtered seller list
        const sellers = await Promise.all(sellerRequests);

        const sellersWithAddresses = sellers.filter(seller => seller.address!= null);

        //create seller addresses (remove in future)
        let sellersWithPossibleLocations = sellersWithAddresses.map(async seller => {
          const response = await fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${seller.address},+UK&key=${config.googleAPIKey}`);
          const result = await response.json();

          if(result.results[0]){
            seller.location = result.results[0].geometry.location;
            return seller;
          }
          else
            return null;
        });

        //wait for locations to resolve and remove null entries
        const sellersWithLocations = (await Promise.all(sellersWithPossibleLocations)).filter(seller => seller != null);
        
        return sellersWithLocations;
      }

      const generateContent = (seller) => {
        const content = 
          `<div class="seller-map-info-container">`+
            `<h4 class="seller-map-info-title">${seller.title}</h4>` +
            `<p class="seller-map-info-phone">${seller.phone_number}</p>` +
            `<p class="seller-map-info-address">${seller.address}</p>` +
            `<a class="seller-map-info-link" href="/sellers?render_type=sellerview&id_seller=${seller.id}">go to store page</a>` +
          `</div>`

        return content;
      }

const toggleSellersMap = () => {
  const sellersMap = document.getElementById("sellers-map");
  const toggleButton = document.getElementById("toggle-map-button");

  if(sellersMap.style.display == "none"){
    sellersMap.style.display = "inherit";
    toggleButton.innerHTML = "Hide map";
  }
  else {
    sellersMap.style.display = "none";
    toggleButton.innerHTML = "Show stores on map";
  }
}

const loadMapScripts = () => {
  const script = document.createElement('script');
  script.src = `https://maps.googleapis.com/maps/api/js?key=${config.googleAPIKey}&libraries=&v=weekly`;
  script.id = 'googleMaps';
  document.body.appendChild(script);
      
  script.onload = () => {
    console.log("map scripts loaded, starting map")
    initMap();
  };
}

if(document.getElementsByClassName("page-heading")[0].innerText=="SELLERS")
  document.getElementsByClassName("page-heading")[0].innerText="STORES";

if(document.getElementsByClassName("page-heading")[0].innerText=="STORES"){
  const locationToInsert = document.getElementById("kblayout-centercol").children[0];

  const mapContainer = document.createElement("div");
  const sellersMap = document.createElement("div");
  const toggleButton = document.createElement("a");

  sellersMap.setAttribute("id", "sellers-map");
  sellersMap.style.display = "inherit";

  mapContainer.append(sellersMap);

  toggleButton.setAttribute("id","toggle-map-button");
  toggleButton.innerHTML = "Hide map";
  toggleButton.className = "seller-map-button";
  toggleButton.onclick = toggleSellersMap;

  mapContainer.append(toggleButton);

  locationToInsert.insertBefore(mapContainer,locationToInsert.children[2]);

  loadMapScripts();
}