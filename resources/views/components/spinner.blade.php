<style>
    .cargando_formulario {
        margin: 20px auto 0;
        width: 70px;
        text-align: center;
    }

    .cargando_formulario>div {
        width: 18px;
        height: 18px;
        background-color: #189bb6;

        border-radius: 100%;
        display: inline-block;
        animation: sk-bounce 1.4s infinite ease-in-out both;
    }

    .cargando_formulario .bounce1 {
        animation-delay: -0.32s;
    }

    .cargando_formulario .bounce2 {
        animation-delay: -0.16s;
    }

    @keyframes sk-bounce {
        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }
</style>

<div class="cargando_formulario">
    <div class="bounce1"></div>
    <div class="bounce2"></div>
    <div class="bounce3"></div>
</div>
