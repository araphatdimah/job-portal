document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById("uploadBookModal");
    const btn = document.getElementById("uploadBookButton");
    const span = document.getElementsByClassName("upload-close-button")[0];

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

document.addEventListener('DOMContentLoaded', (event) => {
    const modal = document.getElementById("editProfileModal");
    const btn = document.getElementById("editProfileButton");
    const span = document.getElementsByClassName("profile-close-button")[0];

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
//Modal for editing a book
function editBook(id)
    {
    const modal = document.getElementById(`editBookModal${id}`);
    const span = document.getElementsByClassName(`book-edit-close-button${id}`)[0];

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

//Function for updating a book
function editBookSubmit(id)
{
document.getElementById(`editBookForm${id}`).addEventListener('submit', function(event){
    event.preventDefault();
    const editBookBody = new FormData(this);
    fetch(`/user/book/${id}`,  {
        method: 'POST',
        body: editBookBody,
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

//Function for updating a user's profile
function editProfileSubmit(portalId)
{
    document.getElementById('editProfileForm').addEventListener('submit', function(event){
        event.preventDefault();
        const editProfileBody = new FormData(this);
        fetch(`/portal-profile-edit/${portalId}`, {
            method: 'POST',
            body: editProfileBody,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            }
        }).then(response => response.json()).then(data => {
            if(data.success)
            {
                alert(data.success);
                window.location.reload();
            }else if(data.status)
            {
                alert(data.status);
            }
        }).catch(error => {
            alert(error);
            console.log(error);
        });
    });
}

//Function for updating a user's profile
function passwordChangeSubmit(portalId)
{
    document.getElementById('passwordSettingForm').addEventListener('submit', function(event){
        event.preventDefault();
        const passwordSettingBody = new FormData(this);
        fetch(`/portal-password-change/${portalId}`, {
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

function profileEditClose()
{
    document.getElementById("editProfileModal").style.display = "none";
    window.location.href='/portal';
}