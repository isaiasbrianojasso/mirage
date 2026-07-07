<template>
    <div class="relative w-full">
        <input 
            type="text" 
            ref="inputRef" 
            :placeholder="placeholder"
            :class="inputClass"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
        <div v-if="withMap && currentLat && currentLng" class="mt-3 w-full h-48 bg-gray-200 rounded-md overflow-hidden relative">
            <div ref="mapRef" class="w-full h-full"></div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: 'Empezar a escribir la dirección...'
    },
    inputClass: {
        type: String,
        default: 'w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500'
    },
    withMap: {
        type: Boolean,
        default: false
    },
    initialLat: {
        type: [String, Number],
        default: null
    },
    initialLng: {
        type: [String, Number],
        default: null
    }
});

const emit = defineEmits([
    'update:modelValue',
    'addressSelected',
    'update:lat',
    'update:lng'
]);

const inputRef = ref(null);
const mapRef = ref(null);

let autocomplete = null;
let map = null;
let marker = null;

const currentLat = ref(props.initialLat);
const currentLng = ref(props.initialLng);

function initAutocomplete() {
    if (!window.google || !window.google.maps || !window.google.maps.places) {
        console.error('Google Maps Places API is not loaded.');
        return;
    }

    autocomplete = new window.google.maps.places.Autocomplete(inputRef.value, {
        fields: ['address_components', 'geometry', 'formatted_address', 'name'],
        types: ['address'],
    });

    autocomplete.addListener('place_changed', onPlaceChanged);

    if (props.withMap) {
        initMap();
    }
}

function initMap() {
    if (!mapRef.value || !currentLat.value || !currentLng.value) return;
    
    const pos = { lat: parseFloat(currentLat.value), lng: parseFloat(currentLng.value) };
    map = new window.google.maps.Map(mapRef.value, {
        center: pos,
        zoom: 15,
        mapTypeControl: false,
        streetViewControl: false,
    });
    
    marker = new window.google.maps.Marker({
        map: map,
        position: pos,
        draggable: true
    });

    marker.addListener('dragend', () => {
        const position = marker.getPosition();
        currentLat.value = position.lat();
        currentLng.value = position.lng();
        emit('update:lat', currentLat.value);
        emit('update:lng', currentLng.value);
    });
}

function onPlaceChanged() {
    const place = autocomplete.getPlace();

    if (!place.geometry) {
        return;
    }

    emit('update:modelValue', place.formatted_address || place.name);
    
    const locationData = {
        formatted: place.formatted_address || place.name,
        address: '',
        city: '',
        state: '',
        zip: '',
        country: '',
        lat: place.geometry.location.lat(),
        lng: place.geometry.location.lng(),
    };

    let streetNumber = '';
    let route = '';

    for (const component of place.address_components) {
        const type = component.types[0];
        
        if (type === 'street_number') {
            streetNumber = component.long_name;
        } else if (type === 'route') {
            route = component.long_name;
        } else if (type === 'locality' || type === 'postal_town') {
            locationData.city = component.long_name;
        } else if (type === 'administrative_area_level_1') {
            locationData.state = component.long_name;
        } else if (type === 'country') {
            locationData.country = component.long_name;
        } else if (type === 'postal_code') {
            locationData.zip = component.long_name;
        }
    }
    
    locationData.address = `${route} ${streetNumber}`.trim();
    if (!locationData.address && place.name) {
        locationData.address = place.name;
    }

    currentLat.value = locationData.lat;
    currentLng.value = locationData.lng;

    if (props.withMap) {
        if (!map) {
            // Need to wait for next tick for DOM element to render
            setTimeout(() => {
                initMap();
            }, 100);
        } else {
            const pos = { lat: locationData.lat, lng: locationData.lng };
            map.setCenter(pos);
            marker.setPosition(pos);
        }
    }

    emit('update:lat', locationData.lat);
    emit('update:lng', locationData.lng);
    emit('addressSelected', locationData);
}

onMounted(() => {
    // If google maps is already loaded
    if (window.google && window.google.maps && window.google.maps.places) {
        initAutocomplete();
    } else {
        // Wait for it
        window.addEventListener('google-maps-loaded', initAutocomplete);
    }
});

onUnmounted(() => {
    window.removeEventListener('google-maps-loaded', initAutocomplete);
    if (autocomplete) {
        window.google.maps.event.clearInstanceListeners(autocomplete);
    }
    if (marker) {
        window.google.maps.event.clearInstanceListeners(marker);
    }
});
</script>
