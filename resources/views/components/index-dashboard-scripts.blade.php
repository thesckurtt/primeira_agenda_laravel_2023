
<script>
    $(window).on('load', () => {
        if ($('.section-mensagens').css('display') == 'block') {
            // var section_mensagens = setInterval(() => {
            //     $('.alert-success').addClass('hidden-mensage-section');
            // }, 1000)
            $('.alert-success').animate({
                opacity: 0,
            }, 5000, () => {
                $('.section-mensagens').css('display', 'none');
            });
        }
    })
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            dom: '',
        });
        $('#customSearchInput').on('input', function() {
            table.search(this.value).draw();
        });
    });

    var btn_edit = document.querySelectorAll(".btn-primary");
    btn_edit.forEach(btn => {
        btn.addEventListener('click', () => {
            var data_id = btn.getAttribute('data-id');
            window.location.href = '{{ route('dashboard.cadastro') }}/' + data_id;

        })
    })

    var btn_delete = document.querySelectorAll('.btn-danger');
    btn_delete.forEach(btn => {
        btn.addEventListener('click', () => {
            var data_id = btn.getAttribute('data-id');
            console.log(data_id);

            // Animação para excluir linha
            $('[data-id="' + data_id + '"]').parent().parent().addClass("hidden-line-table");

            // Excluir registro
            $.ajax({
                url: '<?= route('dashboard.cadastro_excluir') ?>/' + data_id,
                context: document.body
            }).done(function() {
                $('[data-id="' + data_id + '"]').parent().parent().hide()
            });
        })
    });
</script>
<script>
    function startCounting(targetValue, duration, elementId) {
        const element = document.getElementById(elementId);
        const startValue = 0;
        const intervalTime = 20; // intervalo de atualização em milissegundos
        const steps = Math.ceil(duration / intervalTime);
        const increment = (targetValue - startValue) / steps;
        let currentValue = startValue;
        const updateCounter = () => {
            element.textContent = Math.round(currentValue);

            if (currentValue < targetValue) {
                currentValue += increment;
                requestAnimationFrame(updateCounter);
            }
        };
        updateCounter();
    }

    var contadores = setInterval(() => {
        startCounting({{ $contatos_cadastro }}, 1000, 'contatos-cadastro');
        startCounting({{ $contatos_recentes }}, 1000, 'contatos-recentes');
        startCounting({{ $contatos_incompletos }}, 1000, 'contatos-incompletos');
        clearInterval(contadores);
    }, 250);
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
