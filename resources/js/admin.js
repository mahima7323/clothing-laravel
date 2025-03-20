// Wait for the DOM to be fully loaded before adding the event listener
document.addEventListener('DOMContentLoaded', function() {
    // Select the category dropdown
    document.getElementById('category').addEventListener('change', function() {
        // Get the selected category ID
        var categoryId = this.value;

        // Get the subcategory dropdown
        var subcategorySelect = document.getElementById('subcategory');

        // Clear previous subcategories and set a default option
        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';

        // If a category is selected, fetch the corresponding subcategories
        if (categoryId) {
            fetch('/admin/subcategories/' + categoryId)
                .then(response => {
                    // Check if the response is successful
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // Check if there are subcategories in the response
                    if (data.subcategories && data.subcategories.length > 0) {
                        // Loop through each subcategory and create an option element
                        data.subcategories.forEach(function(subcategory) {
                            var option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategorySelect.appendChild(option);
                        });
                    } else {
                        // No subcategories found
                        var option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'No subcategories available';
                        subcategorySelect.appendChild(option);
                    }
                })
                .catch(error => {
                    // Log any errors to the console
                    console.error('Error fetching subcategories:', error);
                    // Optionally, show a friendly error message in the dropdown
                    var option = document.createElement('option');
                    option.value = '';
                    option.textContent = 'Error fetching subcategories';
                    subcategorySelect.appendChild(option);
                });
        }
    });
});
