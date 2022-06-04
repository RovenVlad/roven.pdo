const vendor = document.getElementById('vendors-select');
const category = document.getElementById('category-select');
const rangeFrom = document.getElementById('range-from');
const rangeTo = document.getElementById('range-to');
const button = document.querySelector('button');

const listVendor = document.getElementById('list-vendor');
const listCategory = document.getElementById('list-category');
const listRange = document.getElementById('list-range');

const send = async function(data, text = false) {
    return await fetch('/controllers/controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then((response) => { 
        return text ? response.text() : response.json()
    });
}

vendor.onchange = async function() {
    await send({ 'event': 'vendor', 'id': this.value })
    .then(value => listVendor.innerHTML = value);
}

category.onchange = async function() {
    await send({ 'event': 'category', 'id': this.value }, true)
    .then(str => new window.DOMParser().parseFromString(str, "text/xml"))
    .then(data => listCategory.innerHTML = data['activeElement']['innerHTML']);
}

button.onclick = async function() {
    if (rangeFrom.value.trim() == '' || 
        rangeTo.value.trim() == '' || 
        isNaN(rangeTo.value) || 
        isNaN(rangeFrom.value)) return;
    
    await send({ 'event': 'range', 'from': rangeFrom.value, 'to': rangeTo.value }, true)
    .then(value => listRange.innerHTML = value);
}