//Modal for editing admin's profile
document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById("editProfileModal");
    const btn = document.getElementById("editProfileButton");
    const span = document.getElementsByClassName("profile-edit-close-button")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

//Modal for new job
document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById("newJobModal");
    const btn = document.getElementById("addJobButton");
    const span = document.getElementsByClassName("new-job-close-button")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

//DOM Modal for password
document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById("passwordSettingModal");
    const btn = document.getElementById("passwordSettingButton");
    const span = document.getElementsByClassName("password-close-button")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});

//DOM Modal for editing a job
function newJobEdit(id)
    {
    const modal = document.getElementById(`newJobEditModal${id}`);
    const span = document.getElementsByClassName(`job-edit-close-button${id}`)[0];

        modal.style.display = "block";

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

//Function for updating a job
function jobUpdateSubmit(id)
{
document.getElementById(`jobUpdateForm${id}`).addEventListener('submit', function(event){
    event.preventDefault();
    const jobUpdateBody = new FormData(this);
    fetch(`/user/book/${id}`,  {
        method: 'POST',
        body: jobUpdateBody,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    }).then(response => response.json()).then(data => {
        alert(data.status);
    }).catch(error => {
        alert(error);
        console.log(error);
    });
  });
}

//Function for adding a job
function newJobSubmit()
{
    document.getElementById('newJobForm').addEventListener('submit', function(event){
        event.preventDefault();
        const newJobBody = new FormData(this);
        fetch('/new-job-opportunity', {
            method: 'POST',
            body: newJobBody,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        }).then(response => response.json()).then(data => {
            alert(data.status);
            document.getElementById('newJobForm').reset();
        }).catch(error => {
            alert(error);
            console.log(error);
        });
    });
}

//Function for updating a admin's password
function passwordChangeSubmit(employerId)
{
    document.getElementById('passwordSettingForm').addEventListener('submit', function(event){
        event.preventDefault();
        const passwordSettingBody = new FormData(this);
        fetch(`/employer-password-change/${employerId}`, {
            method: 'POST',
            body: passwordSettingBody,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        }).then(response => response.json()).then(data => {
            alert(data.status);
        }).catch(error => {
            alert(error);
            console.log(error);
        });
    });
}