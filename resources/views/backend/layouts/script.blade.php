<!-- for delete conformation  -->

<script>
    function handleDelete(id) {
        // Trigger SweetAlert2 for confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
             
            if (result.isConfirmed) {
                // Set the form action to the correct delete route
                var form = document.getElementById('deletePostForm-' + id);
 
                // Submit the form
                form.submit();
                 
            }
        });
    }

   
</script>

<script>
 // Show success message only once
@if (session('success'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('success') }}',
        icon: 'success',
        timer: 3000, // Close automatically after 3 seconds
        showConfirmButton: 'Ok'
    }).then(() => {
        // Clear the session flash message
       window.location.reload();
    });
@endif
</script>
<script>
function postcategoryDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.getElementById('deletePostcategoryForm-' + id);
            form.submit();
        }
    });
}


</script>


<script>
    Fancybox.bind("[data-fancybox]", {
        // Custom options here
    });
</script>



{{-- // Handle 'select all' checkbox --}}
<script>
$('#select-all').click(function() {
    $('input[name="selected_rows[]"]').prop('checked', this.checked);
});
</script>
