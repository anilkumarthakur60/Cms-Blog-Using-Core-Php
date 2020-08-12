// tinymce.init({
//     selector: "textarea"
// });


//to check all and uncheck all
$(document).ready(function() {

    $('#selectAllBoxes').click(function(event) {

        if (this.checked) {

            $('.checkBoxes').each(function() {

                this.checked = true;

            });

        } else {


            $('.checkBoxes').each(function() {

                this.checked = false;

            });


        }

    });



});
//end of check and uncheck script
alert('hello');