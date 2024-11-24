document.addEventListener('DOMContentLoaded', function () {
    // Get references to the input field and button
    const countryInput = document.getElementById('country');
    const lookupButton = document.getElementById('lookup');
    const resultDiv = document.getElementById('result');

    // Add click event listener to the Lookup button
    lookupButton.addEventListener('click', function () {
        // Get the value entered in the search field
        const country = countryInput.value.trim();

        // Perform an AJAX request
        fetch(`world.php?country=${encodeURIComponent(country)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                // Display the results in the result div
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                resultDiv.innerHTML = 'An error occurred while fetching the data.';
            });
    });
});
