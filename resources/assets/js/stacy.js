document.addEventListener("DOMContentLoaded", () => {

    const formEditar = document.getElementById("formEditar");
    const msg = document.getElementById("mensaje");

    
    const showMessage = (type = "info", text = "") => {
        if (!msg) return;

        const titles = {
            success: "Éxito",
            danger: "Error",
            warning: "Atención",
            info: "Información"
        };

        msg.className = `alert alert-${type}`;
        msg.innerHTML = `<strong>${titles[type]}</strong> ${text}`;
        msg.style.display = "";

        setTimeout(() => {
            msg.style.display = "none";
        }, 3000);
    };


    if (formEditar) {

        formEditar.addEventListener("submit", async (e) => {
            e.preventDefault();

            const fd = new FormData(formEditar);

            try {
                const resp = await fetch(formEditar.action, {
                    method: "POST",
                    body: fd,
                    headers: {
                        "X-Requested-With": "XMLHttpRequest",
                        "Accept": "application/json",
                    }
                });

                const data = await resp.json();

                if (resp.status === 422) {
                    showMessage("danger", "Debe completar todos los campos.");
                    return;
                }

                if (!data.ok) {
                    showMessage("danger", data.message || "Error desconocido");
                    return;
                }

                showMessage("success", data.message);

                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 2500);

            } catch (error) {
                console.error(error);
                showMessage("danger", "Error de conexión.");
            }

        });
    }

});
