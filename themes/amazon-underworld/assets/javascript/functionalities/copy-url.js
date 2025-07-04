document.addEventListener("DOMContentLoaded", function () {
    const copy = document.querySelectorAll('.copy');

    if (copy) {

        copy.forEach(function(copy){

            copy.addEventListener('click', (e) => {
                e.preventDefault();
                const content = window.location.href;
                const wrapper = copy.parentElement.parentElement;
                const alert =  wrapper.querySelector('#alert');

                navigator.clipboard.writeText(content)
                    .then(() => {
                       alert.textContent = "Link copied successfully!";
                    })
                    .catch(err => {
                        alert.textContent = "Something went wrong.";
                    });

                alert.classList.remove("hide");
                setTimeout(function () {
                    alert.classList.add("hide");
                    alert.textContent = "";
                }, 1000);
            });
        })
    }
});
