$(document).ready(() => {
   const paramsUrl = new URLSearchParams(window.location.search)
   const id = paramsUrl.get('id')

   $.ajax({
      url: "/api/tasks/" + id,
   }).done(res => {
      $('#title').val(res.title)
      $('#description').val(res.description)
      $('#status').val(res.status).change()
   }).catch(e => console.log(e))

   $('#formEditarTarefa').on('submit', e => {
      e.preventDefault()

      const obj = {
         title: $('#title').val(),
         description: $('#description').val(),
         status: $('#status').val()
      }

      $.ajax({
         url: "/api/tasks/" + id,
         method: 'PUT',
         data: JSON.stringify(obj),
         contentType: "application/json"
      }).done(() => {
         window.location = '/'
      }).catch(e => console.log(e))
   })
})