import './styles/app.scss';

require('bootstrap');
// start the Stimulus application
import './bootstrap';
import 'bootstrap-icons/font/bootstrap-icons.css';

document.getElementById("approve").addEventListener("click", addApprove);

function addApprove(e) {
    e.preventDefault();

    const approveLink = e.currentTarget;
    const link = approveLink.href;
    fetch(link)
        .then(res => res.json())
        .then(data => {
            const approveIcon = approveLink.firstElementChild;
            if (data.isApprove) {
                approveIcon.classList.remove("bi-hand-thumbs-up"); // Remove the .bi-heart (empty heart) from classes in <i> element
                approveIcon.classList.add("bi-hand-thumbs-up-fill"); // Add the .bi-heart-fill (full heart) from classes in <i> element
            } else {
                approveIcon.classList.remove("bi-hand-thumbs-up-fill"); // Remove the .bi-heart-fill (full heart) from classes in <i> element
                approveIcon.classList.add("bi-hand-thumbs-up"); // Add the .bi-heart (empty heart) from classes in <i> element
            }
        });
}

