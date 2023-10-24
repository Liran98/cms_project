$(document).ready(function () {
  $('#summernote').summernote({
    height: '200px'
  });
});



$(document).ready(function () {
  $('#selectAllBoxes').click(function (e) {
    if (this.checked) {
      $('.checkBoxes').each(function () {
        this.checked = true;
      });
    } else {
      $('.checkBoxes').each(function () {
        this.checked = false;
      });
    }
  });

  const div_box = "<div id='load-screen'><div id='loading'></div></div>";
  $("body").prepend(div_box);
  $("#load-screen").delay(300).fadeOut(200, function () {
    $(this).remove();
  })








});


$('.link').click(function (e) {

  const btn = e.target.closest('.link');
  const id = btn.dataset.get;

  console.log(id);
  console.log(btn);

  Swal.fire({

    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    cancelButtonColor: '#d33',
    confirmButtonColor: '#ff1',
    confirmButtonText: `<a style='text-decoration:none' class='link' href='posts.php?delete=${id}'>yes delete it</a>`,
  });
});

// const mainbox = document.getElementById('selectAllBoxes');
// const otherboxes = document.querySelector('.checkBoxes');

// mainbox.addEventListener('click', function (e) {
//   if (this.checked) {
//     console.log(this.checked);
//     otherboxes.forEach(function () {
//       this.checked = true;
//     });
//   }else{
//     console.log(this.checked);
//     otherboxes.forEach(function () {
//       this.checked = false;
//     });
//   }
// });

////////////////////////////////////////////////////
// function loadusersonline () {
//   $.get("functions.php?onlineusers=result", function(data) {
//     $(".usersonline").text(data);
//   });
// }

const loadusersonline = function () {
  fetch("functions.php?onlineusers=result")
    .then(function (res) {
      return res.json();
    })
    .then(function (data) {
      const all_users = document.querySelector('.usersonline');
      all_users.textContent = data;
      return data;
    })
}

const onlinePosts = function () {
  fetch("index.php?onlineposts")
    .then(function(res) {
      return res.json();
    })
    .then(function(data) {
      const postonline = document.querySelector('.posts_online');
      postonline.textContent = data;
      return data;
    })
}

setInterval(function () {
  loadusersonline();
  onlinePosts();
}, 500);

//adding new changes soon 