document.addEventListener('DOMContentLoaded', function() {

    const progressBar = document.getElementById('progress-bar');

    const setProgressBar = () => {
    let scrollDist = document.documentElement.scrollTop || document.body.scrollTop;
    let progressWidth = (scrollDist / (document.body.scrollHeight - document.documentElement.clientHeight)) * 100;
    progressBar.style.width = progressWidth + "%";
    };

    if (progressBar) {
        window.addEventListener('scroll', setProgressBar);
    }

    const postHeader = document.getElementById('post-header');

    if(postHeader){
        if(postHeader.classList.contains('post-header__article')){
            progressBar.style.backgroundColor = "#744835";
        }
        if(postHeader.classList.contains('post-header__chronicle')){
            progressBar.style.backgroundColor = "#42394D";
        }

    }

});