<script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(".validate").validate({ 
    errorPlacement: function(error, element) {
        if(element.hasClass("select2")){
            error.insertAfter($(element).parent().find(".select2-selection").after());
        }else{
            error.insertAfter(element).addClass('text-danger');
        }
    }
});
$(function () {
    $('.select2').select2();

});
function deleteWithSwal(slug) {
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
    },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = slug;
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire({
            title: "Cancelled",
            text: "Your data is safe :)",
            icon: "error"
            });
        }
    });
    
}

function changeStatus(slug) {
    
    window.location.href = slug;
}


</script>