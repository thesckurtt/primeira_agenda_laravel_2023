<script>
    $("#cep").on("keyup", () => {
        if ($("#cep").val().length == 8) {
            var cep = $("#cep").val();
            cep.toString();
            $.ajax({
                url: "https://viacep.com.br/ws/" + cep + "/json/",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data.erro !== undefined) {
                        alert("CEP inválido ou não encontrado");
                    } else {
                        console.log(data.logradouro);
                        $("#rua").val(data.logradouro);
                        $("#complemento").val(data.complemento);
                        $("#bairro").val(data.bairro);
                        $("#cidade").val(data.localidade);
                        $("#endereco_estado").val(data.uf);
                    }
                },
                error: function(data) {
                    alert("Algum erro ocorreu, consulte o log.");
                },
            });
        }
    });
    IMask(
        document.getElementById('nome'), {
            mask: /^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/
        }
    );
    IMask(
        document.getElementById('telefone'), {
            mask: '(00) 00000-0000'
        }
    );
    IMask(
        document.getElementById('cep'), {
            mask: '00000000'
        }
    );

    $('.fa-xmark[data-btn-id="close-alert-error"]').click(() => {
        $('.alert-error').hide();
    })
</script>
<script>
    $('#header-menu-top').click(() => {
        $('.menu-dropdown-header').toggleClass('hidden');
    });
    $('.menu-dropdown-header').on('mouseleave', () => {
        $('.menu-dropdown-header').addClass('hidden');
    })
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>
