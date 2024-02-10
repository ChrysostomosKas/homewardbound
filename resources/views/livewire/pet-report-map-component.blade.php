<div>
    <div id="map" class="h-[600px]"></div>
    @push('scripts')
        <script>
            function initMap() {
                var markers = @json($markers);
                var infowindow;
                var previousMarker;

                const greeceLatLng = {lat: 39.0742, lng: 21.8243};

                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 6,
                    center: greeceLatLng,
                });

                infowindow = new google.maps.InfoWindow();

                // Loop through the markers and add them to the map
                markers.forEach(marker => {
                    addMarker({lat: marker.lat, lng: marker.lng}, marker, map);
                });

                map.addListener('click', function (event) {
                    if (!event.markerId) {
                        if (previousMarker) {
                            previousMarker.setMap(null);
                        }
                        addMarker(event.latLng, null, map);
                    }
                });

                function addMarker(location, markerData, map) {
                    var newMarker = new google.maps.Marker({
                        position: location,
                        map: map
                    });

                    // Check if the marker is existing or new
                    if (markerData) {
                        var assetUrl = "{{ asset('storage/app/public') }}";
                        // Existing marker
                        var contentString = `
                            <div>
                                <p>Contact Phone Number: ${markerData.contact_phone_number}</p>
                                <p>Image: <img src="${assetUrl}/${markerData.image}" alt="Marker Image" style="max-width: 100px;"></p>
                            </div>`;

                        // Set content for infowindow
                        infowindow.setContent(contentString);

                        // Attach click event listener to existing marker
                        newMarker.addListener('click', function () {
                            infowindow.open(map, newMarker);
                        });
                    } else {
                        google.maps.event.addListener(newMarker, 'click', function () {
                            var lat = newMarker.getPosition().lat();
                            var lng = newMarker.getPosition().lng();

                            var contentString = `
                             <div id="content" class="w-full">
                                    <div class="w-full">
                                        <form id="locationForm" class="bg-white rounded-lg min-w-full">
                                            <div>
                                                <label class="text-gray-800 font-semibold block my-3 text-md" for="contact_phone_number">Phone Number:</label>
                                                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="text" name="contact_phone_number" id="contact_phone_number" placeholder="Contact phone number" />
                                                <span id="contact_phone_number_error" class="text-red-500"></span> <!-- Error message placeholder -->
                                            </div>
                                            <div class="mb-2">
                                                <label class="text-gray-800 font-semibold block my-3 text-md" for="image">Image</label>
                                                <input class="w-full bg-gray-100 px-4 py-2 rounded-lg focus:outline-none" type="file" name="image" id="image" />
                                                <span id="image_error" class="text-red-500"></span>
                                            </div>
                                            <button type="button" class="btn bg-pink-500 hover:bg-pink-600 w-full py-2 rounded-lg text-white font-semibold" onclick="saveLocation('${lat}', '${lng}')">Submit</button>
                                        </form>
                                    </div>
                                </div> `;

                            infowindow.setContent(contentString);
                            infowindow.open(map, newMarker);
                        });
                        previousMarker = newMarker;
                    }

                    return newMarker;
                }
            }

            function getCsrfToken() {
                return document.head.querySelector('meta[name="csrf-token"]').content;
            }

            function saveLocation(lat, lng) {
                if (!validateForm()) {
                    return;
                }

                var formData = new FormData(document.getElementById("locationForm"));
                formData.append('_token', getCsrfToken());
                formData.append('lat', lat);
                formData.append('lng', lng);
                const dispatch = function (name, detail) {
                    const event = new CustomEvent(name, {detail});
                    window.dispatchEvent(event);
                };

                fetch('{{ route('save.location') }}', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const dispatch = function (name, detail) {
                            const event = new CustomEvent(name, {detail});
                            window.dispatchEvent(event);
                        }

                        dispatch('notification', {message: __('Your changes have been successfully saved!'), success: true});

                        setTimeout(function () {
                            location.reload();
                        }, 2500);
                    })
                    .catch(error => {
                        console.error(error.response);
                    });
            }

            function validateForm() {
                var phoneNumber = document.getElementById("contact_phone_number").value;
                var image = document.getElementById("image").value;

                var phoneNumberError = document.getElementById("contact_phone_number_error");
                var imageError = document.getElementById("image_error");

                phoneNumberError.textContent = "";
                imageError.textContent = "";

                var isValid = true;

                if (!phoneNumber) {
                    phoneNumberError.textContent = "Phone Number is required.";
                    isValid = false;
                } else if (!/^\d{10}$/.test(phoneNumber)) {
                    phoneNumberError.textContent = "Phone Number must be 10 digits.";
                    isValid = false;
                }

                if (!image) {
                    imageError.textContent = "Image is required.";
                    isValid = false;
                }

                return isValid;
            }
            window.initMap = initMap;
        </script>
    @endpush
</div>
