<footer>

</footer>
<script>
//Delete notification on click.
const deleteNotify = (id) =>{
        ajaxUrl = "/notification/" + id + "/delete";
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type : 'DELETE',
            url: ajaxUrl,
            success:function(data) {
                console.log(data);
            }
        });
}
</script>
