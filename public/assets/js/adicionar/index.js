$(document).ready(() => {
   $('#formAdicionarTarefa').on('submit', e => {
      e.preventDefault()

      const obj = {
         title: $('#title').val(),
         description: $('#description').val(),
         status: $('#status').val()
      }

      $.ajax({
         url: "/api/tasks",
         method: 'POST',
         data: JSON.stringify(obj),
         contentType: "application/json"
      }).done(() => {
         window.location = '/'
      }).catch(e => console.log(e))
   })
})