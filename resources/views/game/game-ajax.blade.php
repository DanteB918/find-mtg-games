<script>
/**
 * All AJAX functions for the Games model
 */

 //Delete
const deleteGame = (id) =>{
    if (window.confirm("Are you sure you'd like to delete that?")){
        ajaxUrl = "/games/" + id + "/delete";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'DELETE',
            url: ajaxUrl,
            success:function(data) {
                console.log(data.msg);
                $('.game-' + String(id)).fadeOut();
            }
        });
    }
}


</script>