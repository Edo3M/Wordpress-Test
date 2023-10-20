document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const formMessage = document.querySelector('#form-message');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);
        const formObject = {};
        formData.forEach((value, key) => {
            formObject[key] = value;
        });

        const newURL = custom_vars.ajax_url + '?action=process_form';
        console.log("URL: ", newURL);
        console.log("DATA: ", formData, formObject);

        // Use the Fetch API to send the AJAX request
        fetch(newURL, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            console.log("LOG DATA:", data);
            if (data === 'success') {
                formMessage.innerHTML = 'Form submitted successfully!';
                formMessage.classList.add('text-bg-primary');
                form.reset();
            } else {
                formMessage.innerHTML = 'There was an error. Please try again';
                formMessage.classList.add('text-bg-danger');
                form.reset();
            }
        })
        .catch(error => {
            console.log('AJAX Error:', error);
        });
    });
});
