document.getElementById('lookup').addEventListener('click', function () {
    const country = document.getElementById('country').value;
    fetch(`world.php?country=${country}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('result').innerHTML = data;
        });
});
