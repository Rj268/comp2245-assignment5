document.getElementById('lookup').addEventListener('click', function () {
    // Get the value from the input field
    const country = document.getElementById('country').value;

    // Create an AJAX request
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `world.php?country=${country}`, true);

    // Define what happens when the request is complete
    xhr.onload = function () {
        if (xhr.status === 200) {
            // Insert the response into the 'result' div
            document.getElementById('result').innerHTML = xhr.responseText;
        } else {
            console.error('Request failed.');
        }
    };

    // Send the request
    xhr.send();
});
