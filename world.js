document.addEventListener('DOMContentLoaded', function () {
    const lookupButton = document.getElementById('lookup');
    const lookupCitiesButton = document.getElementById('lookup-cities');
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');

    // Country Lookup
    lookupButton.addEventListener('click', function () {
        const country = countryInput.value.trim();
        fetch(`world.php?country=${encodeURIComponent(country)}`)
            .then(response => response.text())
            .then(data => resultDiv.innerHTML = data)
            .catch(error => console.error('Error:', error));
    });

    // City Lookup
    lookupCitiesButton.addEventListener('click', function () {
        const country = countryInput.value.trim();
        fetch(`world.php?country=${encodeURIComponent(country)}&lookup=cities`)
            .then(response => response.text())
            .then(data => resultDiv.innerHTML = data)
            .catch(error => console.error('Error:', error));
    });
});
