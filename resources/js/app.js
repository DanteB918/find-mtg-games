import './bootstrap';
import '../css/app.css'; 

/*
*   Global JS file
*/
if ($('.alert-cont').length){
    $('.alert-cont').on("click", function(){
        $(this).css('display', 'none');
    });
}
