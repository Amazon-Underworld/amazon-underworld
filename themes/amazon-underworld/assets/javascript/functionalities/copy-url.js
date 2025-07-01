document.addEventListener("DOMContentLoaded", function () {
    const copy = document.querySelectorAll('.copy');

    if (copy) {

        copy.forEach(function(copy){

            copy.addEventListener('click', (e) => {
                e.preventDefault();
                const content = window.location.href;
                const wrapper = copy.parentElement.parentElement;

                console.log(wrapper);
                navigator.clipboard.writeText(content)
                    .then(() => {
                        wrapper.querySelector('#alert').textContent = "Link copied successfully!";
                    })
                    .catch(err => {
                        document.getElementById('alert').textContent = "Something went wrong.";
                    });

                document.getElementById('alert').classList.remove("hide");
                setTimeout(function () {
                    document.getElementById('alert').classList.add("hide");
                    document.querySelector('#alert').textContent = "";
                }, 1000);
            });
        })
    }
});
