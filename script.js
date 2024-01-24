$(document).ready(function () {

    $("form").submit(function(e){
        e.preventDefault();

        var url = $('#urlInput').val();
        var generated = $('#resultOutput').val();
        var os = $('#osSelect').val();


        if(url.trim() == ''){
          return false; 
        }

        if(generated.trim() !== ''){
          url = generated.trim();
        }

        $.ajax({
            type: 'POST',
            url: 'generate.php',
            data: {url: url, os: os},
            success: function (result) {
                $('#resultOutput').val(result);
            }
        });

        return false;
    });

    $('#clearBtn').click(function () {
        $('#resultOutput');
        $('#resultOutput').val('');
    });

});



// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'
  
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')
  
    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
  
        form.classList.add('was-validated')
      }, false)
    })
  })()